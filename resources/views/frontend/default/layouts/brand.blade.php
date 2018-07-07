@php $links = get_links('tieu-chi',$lang); @endphp
<section class="service-section ptb-60">
    <div class="container">
        <div class="row">
            @forelse($links as $link)
            <div class="single-service col-md-3 col-sm-6 col-xs-6 mb-30">
                <div class="service-icon">
                    {!! $link->icon !!}
                </div>
                <div class="service-title">
                    <h3> {{ $link->title }} </h3>
                    <p> {{ $link->description }} </p>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</section>