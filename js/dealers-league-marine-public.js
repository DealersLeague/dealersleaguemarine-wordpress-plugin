(function($){

    $('.anchor-scroll').on('click', function(evt){
        evt.preventDefault(); //prevents hash from being append to the url
        evt.stopPropagation();
        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 800);

    });

    $(document).on('change', '#enquiry-subject', function(event) {
        if ( $(this).val() == 'request_survey' ) {
            $('#message-wrapper').css('display', 'none');
            $('#survey-wrapper').css('display', 'block');
        } else {
            $('#message-wrapper').css('display', 'block');
            $('#survey-wrapper').css('display', 'none');
        }
    });

    // TODO
    $('#form_send_enquiry_btn').click( function() {
         
        //selectize.setValue('something', false);
    })

    // Enquiry
    $(document).on('submit', '#form_send_enquiry', function(event) {
        event.preventDefault();
        event.stopPropagation();
        var form = $(this);
        var submitButton = form.find('.btn-send-enquiry');
        submitButton.attr('disabled', true);
        var formData = form.serialize() + '&action=dealers-league-marine_send_enquiry';

        $.ajax({
            url : dealers_league_marine_params.ajaxurl, // AJAX handler
            data : formData,
            type : 'POST',
            success : function( data ){
                console.log(data);
                if ( data.status === 'NOK') {
                    form.find('div.success').css('display', 'none')
                    form.find('div.error').html(data.message).css('display', 'block');
                } else {
                    form.find('div.error').css('display', 'none');
                    form.trigger('reset');
                    form.find('div.success').html(data.message).css('display', 'block').delay(10000).fadeOut();
                }

            },
            complete: function( data ) {
                submitButton.attr('disabled', false);
            }
        });

        return '';
    });
 
    //  Selectize


    
        $("[data-enable-search=true]").each(function(){
            $(this).selectize({
                onDropdownOpen: dropdownOpen,
                onDropdownClose: dropdownClose,
                allowEmptyOption: false
            });
        });
    
        var searchform = $("#advanced-searchform select");
        searchform.selectize({
            onDropdownOpen: dropdownOpen,
            onDropdownClose: dropdownClose,
            allowEmptyOption: true,
        });
	
		var sorting = $("#sorting");
        sorting.selectize({
            onDropdownOpen: dropdownOpen,
            onDropdownClose: dropdownClose,
            allowEmptyOption: true,
        });
	
		var newboat = $(".newboat select");
        newboat.selectize({
            onDropdownOpen: dropdownOpen,
            onDropdownClose: dropdownClose,
            allowEmptyOption: true,
        }); 

        $(document).on( 'change', '#sorting', function(event) {
            var value = $(this).val();
            window.location.href = value;
        });
    
        function dropdownOpen($dropdown){
            $dropdown.addClass("opening");
        }
        function dropdownClose($dropdown){
            $dropdown.removeClass("opening");
        }
    
    
    //  Disable inputs in the non-active tab
    
        $(".form-slide:not(.active) input, .form-slide:not(.active) select, .form-slide:not(.active) textarea").prop("disabled", true);
    
    //  Change tab button
    
    
        $("select.change-tab").each(function(){
            var _this = $(this);
            if( $(this).find(".item").attr("data-value") !== "" ){
                changeTab( _this );
            }
        });
    
        $(".change-tab").on("change", function() {
            changeTab( $(this) );
        });
    
        $(".box").each(function(){
            if( $(this).find(".background .background-image").length ) {
                $(this).css("background-color","transparent");
            }
        });
    
    //  Star Rating
    
        $(".rating").each(function(){
            for( var i = 0; i <  5; i++ ){
                if( i < $(this).attr("data-rating") ){
                    $(this).append("<i class='active fa fa-star'></i>")
                }
                else {
                    $(this).append("<i class='fa fa-star'></i>")
                }
            }
        });
    
    //  Button for class changing
    
        $(".change-class").on("click", function(e){
            e.preventDefault();
            var parentClass = $( "."+$(this).attr("data-parent-class") );
            parentClass.removeClass( $(this).attr("data-change-from-class") );
            parentClass.addClass( $(this).attr("data-change-to-class") );
            $(this).parent().find(".change-class").removeClass("active");
            $(this).addClass("active");
            readMore();
        });
    
        if( $(".masonry").length ){
            $(".items.masonry").masonry({
                itemSelector: ".item",
                transitionDuration: 0
            });
        }
    
        $(".ribbon-featured").each(function() {
            var thisText = $(this).text();
            $(this).html("");
            $(this).append(
                "<div class='ribbon-start'></div>" +
                "<div class='ribbon-content'>" + thisText + "</div>" +
                "<div class='ribbon-end'>" +
                    "<figure class='ribbon-shadow'></figure>" +
                "</div>"
            );
        });
    
    //  File input styling
    
        if( $("input[type=file].with-preview").length ){
            $("input.file-upload-input").MultiFile({
                list: ".file-upload-previews"
            });
        }
    
        $(".single-file-input input[type=file]").change(function() {
            previewImage(this);
        });
    
        $(".has-child a[href='#'].nav-link").on("click", function (e) {
            e.preventDefault();
           if( !$(this).parent().hasClass("hover") ){
               $(this).parent().addClass("hover");
           }
           else {
               $(this).parent().removeClass("hover");
           }
        })
    
        if( $(".owl-carousel").length ){
            var galleryCarousel = $(".gallery-carousel");
    
            galleryCarousel.owlCarousel({
                loop: false,
                margin: 0,
                nav: true,
                items: 1,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                autoHeight: true,
                dots: false
            })
    
            $(".tabs-slider").owlCarousel({
                loop: false,
                margin: 0,
                nav: false,
                items: 1,
                autoHeight: true,
                dots: false,
                mouseDrag: true,
                touchDrag: false,
                pullDrag: false,
                freeDrag: false
            })
            
            var fullWidthCarousel = $(".full-width-carousel")
            fullWidthCarousel.owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 3,
                lazyLoad:true,
                lazyLoadEager:1,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                autoHeight: false,
                center: true,
                dots: false,
                autoWidth:true,
                responsive: {
                    768: {
                        items: 3
                    },
                    0 : {
                        items: 1,
                        center: false,
                        margin: 0,
                        autoWidth: false
                    }
                }
            })

            fullWidthCarousel.on('initialized.owl.carousel', function(event) {
              isSlidePortrait();
            })

            fullWidthCarousel.on('loaded.owl.lazy', function(event) {
                isSlidePortrait();
            })
    
            $(".gallery-carousel-thumbs").owlCarousel({
                loop: false,
                margin: 20,
                nav: false,
                dots: true,
                items: 5,
                URLhashListener: true
            });
    
            $("a.owl-thumb").on("click", function () {
                $("a.owl-thumb").removeClass("active-thumb");
                $(this).addClass("active-thumb");
            });
    
            galleryCarousel.on('translated.owl.carousel', function() {
                var hash = $(this).find(".active").find("img").attr("data-hash");
                $(".gallery-carousel-thumbs").find("a[href='#" + hash + "']").trigger("click");
            });
 
        }

        // shortcode slider 
        $(".archive-carousel").owlCarousel({
            loop:true,
            margin:10, 
            
            lazyLoad:true,
            lazyLoadEager: 1,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true, 
            responsive:{
                0:{
                    items:1,
                    stagePadding: 25
                },
                750:{
                    items:2,
                    stagePadding: 50
                },
                1000:{
                    items:3,
                    stagePadding: 100
                },
                1280:{
                    items:4
                },
                1500:{
                    items:5
                }
            }
        })

        function isSlidePortrait() {
            var images = $( '.owl-item .item img' )
            images.each( function() {
                var h = $( this ).height()
                var w = $( this ).width()

                if ( h >= w ) {
                    $( this ).addClass( 'portrait-item-image' )
                    $( this ).parent( '.item' ).addClass( 'portrait-item' )
                }
            })
        }
 
    //  Bootstrap tooltip initialization
    
        $('[data-toggle="tooltip"]').tooltip();
    
    //  iCheck
    
        $("input[type=checkbox], input[type=radio]").iCheck();
    
        var framedInputRadio = $(".framed input[type=radio]");
        framedInputRadio.on('ifChecked', function(){
            $(this).closest(".framed").addClass("active");
        });
        framedInputRadio.on('ifUnchecked', function(){
            $(this).closest(".framed").removeClass("active");
        });
    
    //  "img" into "background-image" transfer
    
        $("[data-background-image]").each(function() {
            $(this).css("background-image", "url("+ $(this).attr("data-background-image") +")" );
        });
    
        $(".background-image").each(function() {
            $(this).css("background-image", "url("+ $(this).find("img").attr("src") +")" );
        });
    
    //  Custom background color
    
        $("[data-background-color]").each(function() {
            $(this).css("background-color", $(this).attr("data-background-color") );
        });
     
    //  No UI Slider -------------------------------------------------------------------------------------------------------
    
        if( $('.ui-slider').length > 0 ){
    
            $.getScript( "assets/js/jquery.nouislider.all.min.js", function() {
                $('.ui-slider').each(function() {
                    if( $("body").hasClass("rtl") ) var rtl = "rtl";
                    else rtl = "ltr";
    
                    var step;
                    if( $(this).attr('data-step') ) {
                        step = parseInt( $(this).attr('data-step') );
                    }
                    else {
                        step = 10;
                    }
                    var sliderElement = $(this).attr('id');
                    var element = $( '#' + sliderElement);
                    var valueMin = parseInt( $(this).attr('data-value-min') );
                    var valueMax = parseInt( $(this).attr('data-value-max') );
                    $(this).noUiSlider({
                        start: [ valueMin, valueMax ],
                        connect: true,
                        direction: rtl,
                        range: {
                            'min': valueMin,
                            'max': valueMax
                        },
                        step: step
                    });
                    if( $(this).attr('data-value-type') == 'price' ) {
                        if( $(this).attr('data-currency-placement') == 'before' ) {
                            $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ prefix: $(this).attr('data-currency'), decimals: 0, thousand: '.' }));
                            $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ prefix: $(this).attr('data-currency'), decimals: 0, thousand: '.' }));
                        }
                        else if( $(this).attr('data-currency-placement') == 'after' ){
                            $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ postfix: $(this).attr('data-currency'), decimals: 0, thousand: ' ' }));
                            $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ postfix: $(this).attr('data-currency'), decimals: 0, thousand: ' ' }));
                        }
                    }
                    else {
                        $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ decimals: 0 }));
                        $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ decimals: 0 }));
                    }
                });
            });
        }
    
    //  Read More
    
        readMore(); 

    // Accordion
        var allPanels = $('.listing-accordion > .listing-details-grid').hide()
        
        $('.listing-accordion > h2').click(function() {
            allPanels.not( $(this).next('.listing-details-grid') ).slideUp()
            $(this).next('.listing-details-grid').slideDown()
            return false
        });

    setTimeout(
        function () {
            $(document).find(".background-image").each(function () {
                var bg_img = $(this).css('background-image');
                if (bg_img && bg_img.indexOf("undefined") >= 0) {
                    bg_img = "url('" + $(this).attr('data-img') + "')";
                    $(this).css('background-image', bg_img);
                }
            });
        }, 1000);

      
    })(jQuery)
      
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Functions
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      
    // Change Tab
    
    function changeTab(_this){
        var parameters = _this.data("selectize").items[0];
        var changeTarget = $("#" + _this.attr("data-change-tab-target"));
        var slide = changeTarget.find(".form-slide");
        if( parameters === "" ){
            slide.removeClass("active");
            slide.first().addClass("default");
            changeTarget.find("input").prop("disabled", true);
            changeTarget.find("select").prop("disabled", true);
            changeTarget.find("textarea").prop("disabled", true);
        }
        else {
            slide.removeClass("default");
            slide.removeClass("active");
            changeTarget.find("input").prop("disabled", true);
            changeTarget.find("select").prop("disabled", true);
            changeTarget.find("textarea").prop("disabled", true);
            changeTarget.find( "#" + parameters ).addClass("active");
            changeTarget.find( "#" + parameters + " input").prop("disabled", false);
            changeTarget.find( "#" + parameters + " textarea").prop("disabled", false);
            changeTarget.find( "#" + parameters + " select").prop("disabled", false);
        }
    }
    
    // Read More
    
    function readMore() {
        jQuery(".read-more").each(function(){
            var readMoreLink = jQuery(this).attr("data-read-more-link-more");
            var readLessLink = jQuery(this).attr("data-read-more-link-less");
            var collapseHeight = jQuery(this).find(".item:first").height() + parseInt( jQuery(this).find(".item:first").css("margin-bottom"), 10 );
            jQuery(".read-more").readmore({
                moreLink: '<div class="center"><a href="#" class="btn btn-primary btn-rounded btn-framed">' + readMoreLink + '</a></div>',
                lessLink: '<div class="center"><a href="#" class="btn btn-primary btn-rounded btn-framed">' + readLessLink + '</a></div>',
                collapsedHeight: 500
            });
        });
    }
       
    function previewImage(input) {
        var ext = $(input).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) === -1) {
            alert('invalid extension!');
        }
        else {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).parents(".profile-image").find(".image").attr("style", "background-image: url('" + e.target.result + "');" );
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
    
    // Viewport ------------------------------------------------------------------------------------------------------------
    
    var viewport = (function() {
        var viewPorts = ['xs', 'sm', 'md', 'lg'];
    
        var viewPortSize = function() {
            return window.getComputedStyle(document.body, ':before').content.replace(/"/g, '');
        };
    
        var is = function(size) {
            if ( viewPorts.indexOf(size) === -1 ) throw "no valid viewport name given";
            return viewPortSize() === size;
        };
    
        var isEqualOrGreaterThan = function(size) {
            if ( viewPorts.indexOf(size) === -1 ) throw "no valid viewport name given";
            return viewPorts.indexOf(viewPortSize()) >= viewPorts.indexOf(size);
        };
    
        // Public API
        return {
            is: is,
            isEqualOrGreaterThan: isEqualOrGreaterThan
        }
    
    })(); 