@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section pt-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row contact-info ">
            <div class="col-md-4 col-xs-6 col-xs-wide mb-40">
                <div>
                    <span class="pe-7s-headphones"></span>
                    <p>
                        <a href="tel:326578912">+145987565</a> <br> <a href="tel:326578912">+145987565</a>
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-xs-6 col-xs-wide mb-40">
                <div>
                    <span class="pe-7s-map-2"></span>
                    <p>
                        28 Green Tower, Street Name, New York City, USA
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-xs-6 col-xs-wide mb-40">
                <div>
                    <span class="pe-7s-mail"></span>
                    <p>
                        <a href="mailto:support@khowebonline.com">support@khowebonline.com</a>
                        <br>
                        <a href="mailto:support@khowebonline.com">support@khowebonline.com</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="row contact-form">
            <div class="col-xs-12">
                <h3>{{ __('site.contact_form') }}</h3>
                <form id="contact-form" action="mail.php#" method="post">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="name">{{ __('site.name') }}</label>
                                <input id="name" name="name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email">
                            </div>
                            <div class="form-group">
                                <label for="subject">{{ __('site.subject') }}</label>
                                <input id="subject" name="subject" type="text">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="message">{{ __('site.message') }}</label>
                                <textarea name="message" id="message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-ajax" data-ajax="act=contact|type=contact"> {{ __('site.send') }} </button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="form-messege"></p>
            </div>
        </div>
    </div>
    <div class="contact-map">
        <div>
            <input id="origin-input" class="controls" type="text" placeholder="Enter an origin location">
            {{--<input id="destination-input" class="controls" type="text" placeholder="Enter a destination location">--}}
            <div id="mode-selector" class="controls">
                <input type="radio" name="type" id="changemode-walking" checked="checked">
                <label for="changemode-walking">Walking</label>

                <input type="radio" name="type" id="changemode-transit">
                <label for="changemode-transit">Transit</label>

                <input type="radio" name="type" id="changemode-driving">
                <label for="changemode-driving">Driving</label>
            </div>
            <div id="google-map"></div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
@endsection

@section('custom_css')
<style>
.controls {margin-top: 10px;border: 1px solid transparent;border-radius: 2px 0 0 2px;box-sizing: border-box;-moz-box-sizing: border-box;height: 32px;outline: none;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#origin-input,
#destination-input {background-color: #fff;font-size: 15px;font-weight: 300;margin-left: 12px;padding: 0 11px 0 13px;text-overflow: ellipsis;width: 400px;
}
#origin-input:focus,
#destination-input:focus {border-color: #4d90fe;}
#mode-selector {color: #fff;background-color: #4d90fe;margin-left: 12px;padding: 5px 11px 0px 11px;}
#mode-selector label {font-size: 13px;font-weight: 300;}
</style>
@endsection

@section('custom_script')
@php
if(@config('settings.google_coordinates')){
    $coordinates = str_replace(['(',')'],'',config('settings.google_coordinates'));
    $coordinates = explode(', ',$coordinates);
}else{
    $coordinates = explode(', ',config('siteconfig.general.google_coordinates'));
}
@endphp
<script>
    function initMap() {
        var coordinates = { 'lat':{{$coordinates[0]}}, 'lng':{{$coordinates[1]}} };
        var map = new google.maps.Map(document.getElementById('google-map'), {
            mapTypeControl: false,
            center: coordinates,
            zoom: 13,
            scrollwheel: false,
        });
        var marker = new google.maps.Marker({
            position: coordinates,
            map: map
        });
        var infowindow = new google.maps.InfoWindow({
            content: 'Laravel Shop'
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
        infowindow.open(map,marker);

        new AutocompleteDirectionsHandler(map);
    }

    /**
    * @constructor
    */
    function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = 'ChIJNzoTviAqdTERjSKuU09WIiI';
        this.travelMode = 'DRIVING';
        var originInput = document.getElementById('origin-input');
        var destinationInput = document.getElementById('destination-input');
        var modeSelector = document.getElementById('mode-selector');
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);

        var originAutocomplete = new google.maps.places.Autocomplete(originInput, {placeIdOnly: true});
        var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput, {placeIdOnly: true});

        this.setupClickListener('changemode-walking', 'WALKING');
        this.setupClickListener('changemode-transit', 'TRANSIT');
        this.setupClickListener('changemode-driving', 'DRIVING');

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
    }

    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    AutocompleteDirectionsHandler.prototype.setupClickListener = function(id, mode) {
        var radioButton = document.getElementById(id);
        var me = this;
        radioButton.addEventListener('click', function() {
            me.travelMode = mode;
            me.route();
        });
    };

    AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.place_id) {
                window.alert("Please select an option from the dropdown list.");
                return;
            }
            if (mode === 'ORIG') {
                me.originPlaceId = place.place_id;
            } else {
                me.destinationPlaceId = place.place_id;
            }
            me.route();
        });

    };

    AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
            return;
        }
        var me = this;
        this.directionsService.route({
            origin: {'placeId': this.originPlaceId},
            destination: {'placeId': this.destinationPlaceId},
            travelMode: this.travelMode
        }, function(response, status) {
            if (status === 'OK') {
                me.directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    };

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmtm5XL4qL8zyjf6lGxz6-9hkeu45-UiI&libraries=places&callback=initMap"></script>
@endsection