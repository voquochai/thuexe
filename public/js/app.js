/**
Core script to handle the entire theme and core functions
**/
var App = function() {

    // IE mode
    var isRTL = false;
    var isIE8 = false;
    var isIE9 = false;
    var isIE10 = false;

    var resizeHandlers = [];

    // initializes main settings
    var handleInit = function() {

        if ($('body').css('direction') === 'rtl') {
            isRTL = true;
        }

        isIE8 = !!navigator.userAgent.match(/MSIE 8.0/);
        isIE9 = !!navigator.userAgent.match(/MSIE 9.0/);
        isIE10 = !!navigator.userAgent.match(/MSIE 10.0/);

        if (isIE10) {
            $('html').addClass('ie10'); // detect IE10 version
        }

        if (isIE10 || isIE9 || isIE8) {
            $('html').addClass('ie'); // detect IE10 version
        }
    };

    // runs callback functions set by App.addResponsiveHandler().
    var _runResizeHandlers = function() {
        // reinitialize other subscribed elements
        for (var i = 0; i < resizeHandlers.length; i++) {
            var each = resizeHandlers[i];
            each.call();
        }
    };

    // handle the layout reinitialization on window resize
    var handleOnResize = function() {
        var resize;
        if (isIE8) {
            var currheight;
            $(window).resize(function() {
                if (currheight == document.documentElement.clientHeight) {
                    return; //quite event since only body resized not window.
                }
                if (resize) {
                    clearTimeout(resize);
                }
                resize = setTimeout(function() {
                    _runResizeHandlers();
                }, 50); // wait 50ms until window resize finishes.                
                currheight = document.documentElement.clientHeight; // store last body client height
            });
        } else {
            $(window).resize(function() {
                if (resize) {
                    clearTimeout(resize);
                }
                resize = setTimeout(function() {
                    _runResizeHandlers();
                }, 50); // wait 50ms until window resize finishes.
            });
        }
    };

    

    var handleAlerts = function() {
        $('body').on('click', '[data-close="alert"]', function(e) {
            $(this).parent('.alert').hide();
            $(this).closest('.note').hide();
            e.preventDefault();
        });

        $('body').on('click', '[data-close="note"]', function(e) {
            $(this).closest('.note').hide();
            e.preventDefault();
        });

        $('body').on('click', '[data-remove="note"]', function(e) {
            $(this).closest('.note').remove();
            e.preventDefault();
        });
    };

    // Handle textarea autosize 
    var handleTextareaAutosize = function() {
        if (typeof(autosize) == "function") {
            autosize(document.querySelector('textarea.autosizeme'));
        }
    }

    // Fix input placeholder issue for IE8 and IE9
    var handleFixInputPlaceholderForIE = function() {
        //fix html5 placeholder attribute for ie7 & ie8
        if (isIE8 || isIE9) { // ie8 & ie9
            // this is html5 placeholder fix for inputs, inputs with placeholder-no-fix class will be skipped(e.g: we need this for password fields)
            $('input[placeholder]:not(.placeholder-no-fix), textarea[placeholder]:not(.placeholder-no-fix)').each(function() {
                var input = $(this);

                if (input.val() === '' && input.attr("placeholder") !== '') {
                    input.addClass("placeholder").val(input.attr('placeholder'));
                }

                input.focus(function() {
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });

                input.blur(function() {
                    if (input.val() === '' || input.val() == input.attr('placeholder')) {
                        input.val(input.attr('placeholder'));
                    }
                });
            });
        }
    };

    // handle group element heights
    var handleHeight = function() {
        $('[data-auto-height]').each(function() {
            var parent = $(this);
            var items = $('[data-height]', parent);
            var height = 0;
            var mode = parent.attr('data-mode');
            var offset = parseInt(parent.attr('data-offset') ? parent.attr('data-offset') : 0);

            items.each(function() {
                if ($(this).attr('data-height') == "height") {
                    $(this).css('height', '');
                } else {
                    $(this).css('min-height', '');
                }

                var height_ = (mode == 'base-height' ? $(this).outerHeight() : $(this).outerHeight(true));
                if (height_ > height) {
                    height = height_;
                }
            });

            height = height + offset;

            items.each(function() {
                if ($(this).attr('data-height') == "height") {
                    $(this).css('height', height);
                } else {
                    $(this).css('min-height', height);
                }
            });

            if(parent.attr('data-related')) {
                $(parent.attr('data-related')).css('height', parent.height());
            }
        });       
    }

    var handleToastr = function(){
        $('.tooltips').tooltip();
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }

    // Handles counterup plugin wrapper
    var handleCounterup = function() {
        if (!$().counterUp) {
            return;
        }

        $("[data-counter='counterup']").counterUp({
            delay: 5,
            time: 1500
        });
    };

    // Places
    var handlePlaces = function(){

        var simpleProvince = $('.simple-province').attr('data-key');
        var simpleDistrict = $('.simple-district').attr('data-key');
        if(simpleProvince){
            $('.simple-province').html(province[simpleProvince].name);
            $('.simple-district').html(district[simpleProvince][simpleDistrict].name);
        }
        var listProvince = ['<option value="0"> -- Chọn Tỉnh / Thành phố --</option>'];
        var curProvince = $('select.province').val();
        var curDistrict = $('select.district').val();
        $.each( province, function( key, val ) {
            listProvince.push('<option value="'+key+'" '+ ( key == curProvince ? 'selected' : '' ) +'>'+val.name+'</option>');
        });
        $('select.province').html(listProvince.join("")).on('change', function(){
            var province_id = $(this).val();
            var listDistrict = ['<option value="0"> -- Chọn Quận / Huyện --</option>'];
            $.each( district[province_id], function( key, val ) {
                listDistrict.push('<option value="'+key+'" '+ ( key == curDistrict ? 'selected' : '' ) +'>'+val.name+'</option>');
            });
            $('select.district').html(listDistrict.join(""));
        }).change();

    }

    var handGetCookie = function (cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
        }
        return "";
    }

    var handleCart = function (){
        var countCart = $('.countCart');
        var sumCartPrice = $('.sumCartPrice');
        var sumOrderPrice = $('.sumOrderPrice');
        var miniCart = $('.mini-cart .cart-items');
        $.ajax({
            type: 'GET',
            url : Laravel.baseUrl+'/gio-hang/load',
        }).done(function(response){
            countCart.html(response.countCart);
            sumCartPrice.html(response.sumCartPrice);
            sumOrderPrice.html(response.sumOrderPrice);
            miniCart.html(response.miniCart);
        });

        $('body').on('click', '#add-to-cart', function(e){
            e.preventDefault();
            var btn = $(this);
            var qty = $('.product-quantity input').val();
            if( typeof qty === 'undefined' ) qty = 1;

            var color = $('.color-list .active').attr('data-id');
            if( typeof color === 'undefined' ) color = 0;

            var size = $('.size-list .active').attr('data-id');
            if( typeof size === 'undefined' ) size = 0;

            var dataAjax = btn.data('ajax').replace(/\|/g,'&')+'&qty='+qty+'&color='+color+'&size='+size+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/gio-hang/add',
                data: dataAjax,
                beforeSend: function(){
                    btn.button('loading');
                }
            }).done(function(response){
                btn.button('reset');
                countCart.html(response.countCart);
                sumCartPrice.html(response.sumCartPrice);
                sumOrderPrice.html(response.sumOrderPrice);
                miniCart.html(response.miniCart);
                toastr[response.type](response.message, response.title);
            });
        });

        $('body').on('click', '.add-to-cart', function(e){
            e.preventDefault();
            var btn = $(this);
            var qty = 1;
            var color = 0;
            var size = 0;
            var dataAjax = btn.data('ajax').replace(/\|/g,'&')+'&qty='+qty+'&color='+color+'&size='+size+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/gio-hang/add',
                data: dataAjax,
                beforeSend: function(){
                    btn.find('i').removeClass().addClass('fa fa-spinner fa-pulse');
                }
            }).done(function(response){
                btn.find('i').removeClass().addClass('fa fa-shopping-cart');
                countCart.html(response.countCart);
                sumCartPrice.html(response.sumCartPrice);
                sumOrderPrice.html(response.sumOrderPrice);
                miniCart.html(response.miniCart);
                toastr[response.type](response.message, response.title);
            });
        });

        $('body').on('click', '.delete-cart', function(e){
            e.preventDefault();
            var btn = $(this);
            var dataAjax = btn.data('ajax').replace(/\|/g,'&')+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/gio-hang/delete',
                data: dataAjax,
                beforeSend: function(){
                }
            }).done(function(response){
                if(response.type == 'success'){
                    $('.pro-key-'+response.key).remove();
                }
                countCart.html(response.countCart);
                sumCartPrice.html(response.sumCartPrice);
                sumOrderPrice.html(response.sumOrderPrice);
                miniCart.html(response.miniCart);
                App.alert({
                    container: $('#result-coupon'), // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'append', // "append" or "prepend" in container
                    type: response.coupon.type, // alert's type
                    message: response.coupon.message, // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: false, // auto scroll to the alert after shown
                    closeInSeconds: 0, // auto close after defined seconds
                    icon: response.coupon.icon // put icon before the message
                });
                toastr[response.type](response.message, response.title);
            });
        });

        $('body').on('change', '.update-cart', function(e){
            e.preventDefault();
            var btn = $(this);
            var qty = btn.val();
            var dataAjax = btn.data('ajax').replace(/\|/g,'&')+'&qty='+qty+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/gio-hang/update',
                data: dataAjax,
                beforeSend: function(){
                }
            }).done(function(response){
                $('.pro-key-'+response.key+' .sumProPrice').html( response.sumProPrice );
                countCart.html(response.countCart);
                sumCartPrice.html(response.sumCartPrice);
                sumOrderPrice.html(response.sumOrderPrice);
                miniCart.html(response.miniCart);
                App.alert({
                    container: $('#result-coupon'), // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'append', // "append" or "prepend" in container
                    type: response.coupon.type, // alert's type
                    message: response.coupon.message, // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: false, // auto scroll to the alert after shown
                    closeInSeconds: 0, // auto close after defined seconds
                    icon: response.coupon.icon // put icon before the message
                });
                toastr[response.type](response.message, response.title);
            });
        });

        /*-- Product Quantity --*/
        $('.product-quantity').append('<span class="dec qtybtn"><i class="fa fa-angle-left"></i></span><span class="inc qtybtn"><i class="fa fa-angle-right"></i></span>');
        $('.qtybtn').on('click', function() {
            var $button = $(this);
            var $input = $button.parent().find('input');
            var oldValue = $input.val();

            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue == 1) return;
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $input.val(newVal);
            $input.trigger('change');
        });

        $('.cart-coupon').on('click', 'button', function(e){
            e.preventDefault();
            var $button = $(this);
            var $input = $('.cart-coupon').find('input');

            if( $input.val() === ''){
                App.alert({
                    container: $('#result-coupon'), // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'append', // "append" or "prepend" in container
                    type: 'danger', // alert's type
                    message: 'Bạn chưa nhập mã coupon', // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: false, // auto scroll to the alert after shown
                    closeInSeconds: 5, // auto close after defined seconds
                    icon: 'warning' // put icon before the message
                });
                return fasle;
            }

            var dataAjax = 'code='+$input.val()+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/gio-hang/coupon',
                data: dataAjax,
                beforeSend: function(){
                }
            }).done(function(response){
                if(response.type == 'success'){
                    sumOrderPrice.html(response.sumOrderPrice);
                }
                App.alert({
                    container: $('#result-coupon'), // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'append', // "append" or "prepend" in container
                    type: response.type, // alert's type
                    message: response.message, // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: false, // auto scroll to the alert after shown
                    closeInSeconds: 0, // auto close after defined seconds
                    icon: response.icon // put icon before the message
                });
            });
        });

        $('.color-list').on('click', 'button', function(){
            var $button = $(this);
            if ($button.hasClass('active')) {
                $button.removeClass('active');
                return;
            }
            $('.color-list button').removeClass('active');
            $button.addClass('active');
        });

        $('.size-list').on('click', 'button', function(){
            var $button = $(this);
            if ($button.hasClass('active')) {
                $button.removeClass('active');
                return;
            }
            $('.size-list button').removeClass('active');
            $button.addClass('active');
        });
    }

    var handleWishList = function(){
        $('body').on('click', '.add-to-wishlist', function(e){
            e.preventDefault();
            var btn = $(this);
            var dataAjax = btn.data('ajax').replace(/\|/g,'&')+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/wishlist/add',
                data: dataAjax,
                beforeSend: function(){
                    btn.button('loading');
                }
            }).done(function(response){
                btn.button('reset');
                toastr[response.type](response.message, response.title);
            });
        });

        $('body').on('click', '.delete-wishlist', function(e){
            e.preventDefault();
            var btn = $(this);
            var dataAjax = btn.data('ajax').replace(/\|/g,'&')+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/wishlist/delete',
                data: dataAjax,
                beforeSend: function(){
                }
            }).done(function(response){
                if(response.type == 'success'){
                    $('.pro-key-'+response.key).remove();
                }
                toastr[response.type](response.message, response.title);
            });
        });
    }

    var handleComment = function(){
        $('.comment-list').on('click','.reply', function(e){
            e.preventDefault();
            var btn = $(this);
            var container = btn.closest('.timeline-body');
            if( container.find('.comment-form').length > 0 ) return false;
            var parentID = parseInt(btn.attr('data-parent'));
            var productID = parseInt(btn.attr('data-product'));
            var postID = parseInt(btn.attr('data-post'));
            // var form = $('.comment-form.main-form').clone().removeClass('main-form').addClass('display-hide');
            var form = $('<form action="#" method="post" class="comment-form display-hide">'+
                    '<input type="hidden" name="score" value="1">'+
                    '<input type="hidden" name="parent" value="'+parentID+'">'+
                    '<input type="hidden" name="product_id" value="'+productID+'">'+
                    '<input type="hidden" name="post_id" value="'+postID+'">'+
                    '<div class="form-group"><textarea name="description" class="form-control" rows="6"></textarea></div>'+
                    '<div class="form-group"><button type="submit" class="btn btn-site btn-ajax" data-ajax="act=reply|type=default"> Trả lời </button></div>'+
                '</form>');

            $('.comment-list .comment-form').slideUp('fast', function(){
                $(this).remove();
            });
            form.insertAfter(container);
            form.slideDown('fast', function(){
                App.scrollTo(form);
            });
        });
        $('.comment-form .rating .fa-star').hover(function(e){
            var rate = $(this).attr('data-rate');
            for(var i=0; i<=4; i++){
                if(i<rate) $('.comment-form .rating .fa').eq(i).addClass('active');
                else $('.comment-form .rating .fa').eq(i).removeClass('active');
            }
        }, function(e){
            $('.comment-form .rating .fa').removeClass('active');
        });

        $('.comment-form .rating').on('click', '.fa-star', function(e){
            var rate = $(this).attr('data-rate');
            $('.comment-form input[name="score"]').val(rate);
            for(var i=0; i<=4; i++){
                if(i<rate) $('.comment-form .rating .fa').eq(i).addClass('selected');
                else $('.comment-form .rating .fa').eq(i).removeClass('selected');
            }
        });
    }

    var handleRegister = function(){
        $('body').on('click', '.btn-ajax', function(e){
            e.preventDefault();
            var btn = $(this);
            var frm = btn.parents('form');
            var dataAjax = frm.serialize()+'&'+btn.data('ajax').replace(/\|/g,'&')+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/ajax',
                data: dataAjax,
                beforeSend: function(){
                    btn.button('loading');
                }
            }).done(function(response){
                btn.button('reset');
                if( typeof response.redirect !== 'undefined'){
                    window.location.href=response.redirect;
                }
                if(response.type == 'success'){
                    frm.find('*:not([type="hidden"])').val('');
                }
                App.alert({
                    container: frm, // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'prepend', // "append" or "prepend" in container
                    type: response.type, // alert's type
                    message: response.message, // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: false, // auto scroll to the alert after shown
                    closeInSeconds: 5, // auto close after defined seconds
                    icon: response.icon // put icon before the message
                });
                if( typeof response.remove_element !== 'undefined'){
                    frm.find('*:not(.alert, .fa, .close)').remove();
                }
            });
        });

        $('body').on('click', '.btn-login', function(e){
            e.preventDefault();
            var btn = $(this);
            var frm = btn.parents('form');
            var dataAjax = frm.serialize()+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/login',
                data: dataAjax,
                beforeSend: function(){
                    btn.button('loading');
                }
            }).fail(function(status){
                App.alert({
                    container: frm, // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'prepend', // "append" or "prepend" in container
                    type: 'danger', // alert's type
                    message: status.responseJSON[Object.keys(status.responseJSON)[0]], // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: false, // auto scroll to the alert after shown
                    closeInSeconds: 5, // auto close after defined seconds
                    icon: 'warning' // put icon before the message
                });
            }).done(function(response){
                console.log(response);
            }).always(function(){
                btn.button('reset');
            });
        });

        $('body').on('click', '.btn-register', function(e){
            e.preventDefault();
            var btn = $(this);
            var frm = btn.parents('form');
            var dataAjax = frm.serialize()+'&_token='+Laravel.csrfToken;
            $.ajax({
                type: 'POST',
                url : Laravel.baseUrl+'/register',
                data: dataAjax,
                beforeSend: function(){
                    btn.button('loading');
                }
            }).fail(function(status){
                App.alert({
                    container: frm, // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'prepend', // "append" or "prepend" in container
                    type: 'danger', // alert's type
                    message: status.responseJSON[Object.keys(status.responseJSON)[0]], // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: false, // auto scroll to the alert after shown
                    closeInSeconds: 5, // auto close after defined seconds
                    icon: 'warning' // put icon before the message
                });
            }).done(function(response){
                if(response.type == 'success'){
                    frm.find('*:not([type="hidden"])').val('');
                }
                App.alert({
                    container: $('#ajax-modal-login form'), // alerts parent container(by default placed after the page breadcrumbs)
                    place: 'prepend', // "append" or "prepend" in container
                    type: response.type, // alert's type
                    message: response.message, // alert's message
                    close: true, // make alert closable
                    reset: true, // close all previouse alerts first
                    focus: false, // auto scroll to the alert after shown
                    closeInSeconds: 5, // auto close after defined seconds
                    icon: response.icon // put icon before the message
                });
                $('#ajax-modal-register').modal('hide').on('hidden.bs.modal', function (e) {
                    $('#ajax-modal-login').modal('show');
                });
            }).always(function(){
                btn.button('reset');
            });
        });
    }
    
    //* END:CORE HANDLERS *//

    return {

        //main function to initiate the theme
        init: function() {
            //IMPORTANT!!!: Do not modify the core handlers call order.

            //Core handlers
            handleInit(); // initialize core variables
            handleOnResize(); // set and handle responsive
            handleAlerts(); // set and handle responsive
            //Handle group element heights
            this.addResizeHandler(handleHeight); // handle auto calculating height on window resize
            // Hacks
            handleFixInputPlaceholderForIE(); //IE8 & IE9 input placeholder issue fix
            handleToastr();
            handleCounterup();
            handlePlaces();
            handleCart();
            handleWishList();
            handleComment();
            handleRegister();
        },

        //main function to initiate core javascript after ajax complete
        initAjax: function() {
        },

        //init main components 
        initComponents: function() {
            this.initAjax();
        },

        //public function to add callback a function which will be called on window resize
        addResizeHandler: function(func) {
            resizeHandlers.push(func);
        },

        //public functon to call _runresizeHandlers
        runResizeHandlers: function() {
            _runResizeHandlers();
        },

        // wrApper function to scroll(focus) to an element
        scrollTo: function(el, offeset) {
            var pos = (el && el.length > 0) ? el.offset().top : 0;

            if (el) {
                if ($('body').hasClass('page-header-fixed')) {
                    pos = pos - $('.page-header').height();
                } else if ($('body').hasClass('page-header-top-fixed')) {
                    pos = pos - $('.page-header-top').height();
                } else if ($('body').hasClass('page-header-menu-fixed')) {
                    pos = pos - $('.page-header-menu').height();
                }
                pos = pos + (offeset ? offeset : -1 * el.height());
            }

            $('html,body').animate({
                scrollTop: pos
            }, 'slow');
        },

        initSlimScroll: function(el) {
            $(el).each(function() {
                if ($(this).attr("data-initialized")) {
                    return; // exit
                }

                var height;

                if ($(this).attr("data-height")) {
                    height = $(this).attr("data-height");
                } else {
                    height = $(this).css('height');
                }

                $(this).slimScroll({
                    allowPageScroll: true, // allow page scroll when the element scroll is ended
                    size: '7px',
                    color: ($(this).attr("data-handle-color") ? $(this).attr("data-handle-color") : '#bbb'),
                    wrapperClass: ($(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : 'slimScrollDiv'),
                    railColor: ($(this).attr("data-rail-color") ? $(this).attr("data-rail-color") : '#eaeaea'),
                    position: isRTL ? 'left' : 'right',
                    height: height,
                    alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                    railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
                    disableFadeOut: true
                });

                $(this).attr("data-initialized", "1");
            });
        },

        destroySlimScroll: function(el) {
            $(el).each(function() {
                if ($(this).attr("data-initialized") === "1") { // destroy existing instance before updating the height
                    $(this).removeAttr("data-initialized");
                    $(this).removeAttr("style");

                    var attrList = {};

                    // store the custom attribures so later we will reassign.
                    if ($(this).attr("data-handle-color")) {
                        attrList["data-handle-color"] = $(this).attr("data-handle-color");
                    }
                    if ($(this).attr("data-wrapper-class")) {
                        attrList["data-wrapper-class"] = $(this).attr("data-wrapper-class");
                    }
                    if ($(this).attr("data-rail-color")) {
                        attrList["data-rail-color"] = $(this).attr("data-rail-color");
                    }
                    if ($(this).attr("data-always-visible")) {
                        attrList["data-always-visible"] = $(this).attr("data-always-visible");
                    }
                    if ($(this).attr("data-rail-visible")) {
                        attrList["data-rail-visible"] = $(this).attr("data-rail-visible");
                    }

                    $(this).slimScroll({
                        wrapperClass: ($(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : 'slimScrollDiv'),
                        destroy: true
                    });

                    var the = $(this);

                    // reassign custom attributes
                    $.each(attrList, function(key, value) {
                        the.attr(key, value);
                    });

                }
            });
        },

        // function to scroll to the top
        scrollTop: function() {
            App.scrollTo();
        },

        startPageLoading: function(options) {
            if (options && options.animate) {
                $('.page-spinner-bar').remove();
                $('body').append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
            } else {
                $('.page-loading').remove();
                $('body').append('<div class="page-loading"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif"/>&nbsp;&nbsp;<span>' + (options && options.message ? options.message : 'Loading...') + '</span></div>');
            }
        },

        stopPageLoading: function() {
            $('.page-loading, .page-spinner-bar').remove();
        },

        alert: function(options) {

            options = $.extend(true, {
                container: "", // alerts parent container(by default placed after the page breadcrumbs)
                place: "append", // "append" or "prepend" in container 
                type: 'success', // alert's type
                message: "", // alert's message
                close: true, // make alert closable
                reset: true, // close all previouse alerts first
                focus: true, // auto scroll to the alert after shown
                closeInSeconds: 0, // auto close after defined seconds
                icon: "" // put icon before the message
            }, options);

            var id = App.getUniqueID("App_alert");

            var html = '<div id="' + id + '" class="custom-alerts alert alert-' + options.type + ' fade in">' + (options.close ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' : '') + (options.icon !== "" ? '<i class="fa-lg fa fa-' + options.icon + '"></i>  ' : '') + options.message + '</div>';

            if (options.reset) {
                $('.custom-alerts').remove();
            }

            if (!options.container) {
                if ($('.page-fixed-main-content').length === 1) {
                    $('.page-fixed-main-content').prepend(html);
                } else if (($('body').hasClass("page-container-bg-solid") || $('body').hasClass("page-content-white")) && $('.page-head').length === 0) {
                    $('.page-title').after(html);
                } else {
                    if ($('.page-bar').length > 0) {
                        $('.page-bar').after(html);
                    } else {
                        $('.page-breadcrumb, .breadcrumbs').after(html);
                    }
                }
            } else {
                if (options.place == "append") {
                    $(options.container).append(html);
                } else {
                    $(options.container).prepend(html);
                }
            }

            if (options.focus) {
                App.scrollTo($('#' + id));
            }

            if (options.closeInSeconds > 0) {
                setTimeout(function() {
                    $('#' + id).remove();
                }, options.closeInSeconds * 1000);
            }

            return id;
        },
        //public function to get a paremeter by name from URL
        getURLParameter: function(paramName) {
            var searchString = window.location.search.substring(1),
                i, val, params = searchString.split("&");

            for (i = 0; i < params.length; i++) {
                val = params[i].split("=");
                if (val[0] == paramName) {
                    return unescape(val[1]);
                }
            }
            return null;
        },

        // check for device touch support
        isTouchDevice: function() {
            try {
                document.createEvent("TouchEvent");
                return true;
            } catch (e) {
                return false;
            }
        },

        // To get the correct viewport width based on  http://andylangton.co.uk/articles/javascript/get-viewport-size-javascript/
        getViewPort: function() {
            var e = window,
                a = 'inner';
            if (!('innerWidth' in window)) {
                a = 'client';
                e = document.documentElement || document.body;
            }

            return {
                width: e[a + 'Width'],
                height: e[a + 'Height']
            };
        },

        getUniqueID: function(prefix) {
            return 'prefix_' + Math.floor(Math.random() * (new Date()).getTime());
        },

        getResponsiveBreakpoint: function(size) {
            // bootstrap responsive breakpoints
            var sizes = {
                'xs' : 480,     // extra small
                'sm' : 768,     // small
                'md' : 992,     // medium
                'lg' : 1200     // large
            };

            return sizes[size] ? sizes[size] : 0; 
        }
    };

}();

$(document).ready(function() {    
   App.init(); // init metronic core componets
});