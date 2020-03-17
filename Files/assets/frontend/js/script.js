(function($) {
	
	"use strict";
	
	$(document).ready(function() {
	
		
		var nav_offset_top = $('header').height() + 100; 
    
		//* Navbar Fixed  
		function navbarFixed(){
			if ( $('header').length ){ 
				$(window).on('scroll', function() {
					var scroll = $(window).scrollTop();   
					if (scroll >= nav_offset_top) {
						$("header").addClass("navbar_fixed");
					} else {
						$("header").removeClass("navbar_fixed");
					}
				});
			};
		};
		navbarFixed();
		
	
		//Counter-JS
        $('.count').counterUp({
            delay: 100,
            time: 2000
        });

        // Back to top
        $.scrollUp({
            scrollText: '<i class="ti ti-arrow-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900,
            animation: 'fade'
        });




        // Room Gallary
         // SLICK
         $('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
          slidesToShow: 8,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          dots: false,
          prevArrow: false,
          nextArrow: false,
          focusOnSelect: true
        });





        /* ---------------------------------------------
         portfolio filtering
         --------------------------------------------- */

        var $portfolio = $('.portfolio');
        if ($.fn.imagesLoaded && $portfolio.length > 0) {
            imagesLoaded($portfolio, function () {
                $portfolio.isotope({
                    itemSelector: '.portfolio-item',
                    filter: '*'
                });
                $(window).trigger("resize");
            });
        }

        $('.portfolio-filter').on('click', 'a', function (e) {
            e.preventDefault();
            $(this).parent().addClass('active').siblings().removeClass('active');
            var filterValue = $(this).attr('data-filter');
            $portfolio.isotope({filter: filterValue});
        });


        /*---------------------------------------------
         Portfolio popup
         ---------------------------------------------*/

        $(".portfolio-gallery").each(function () {
            $(this).find(".popup-gallery").magnificPopup({
                type: "image",
                gallery: {
                    enabled: true
                }
            });
        }); 

        $('.video-popup').magnificPopup({
            type: 'iframe',
        });

		
    });


        // Testimonials Slider
        $('.testimonials').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 1
                },
                1170: {
                    items: 1
                }
            }
        });

        // Blog Slider
        $('.blog-slider').owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            smartSpeed: 1500,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });


	//Faq area Accordion
	$('.accordion > li:eq(0) a').addClass('active').next().slideDown();

	$('.accordion a').on( 'click',function(j) {
		var dropDown = $(this).closest('li').find('p');

		$(this).closest('.accordion').find('p').not(dropDown).slideUp();

		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
		} else {
			$(this).closest('.accordion').find('a.active').removeClass('active');
			$(this).addClass('active');
		}

		dropDown.stop(false, true).slideToggle();

		j.preventDefault();
	});


	/*

	//Google Map
	function basicmap() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 15,
            scrollwheel: false,
            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(23.8748, 90.3858), // New York
            // This is where you would paste any style found on Snazzy Maps.
            styles: [
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#6195a0"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": "0"
            },
            {
                "saturation": "0"
            },
            {
                "color": "#f5f5f2"
            },
            {
                "gamma": "1"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "all",
        "stylers": [
            {
                "lightness": "-3"
            },
            {
                "gamma": "1.00"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#bae5ce"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#fac9a9"
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#4e4e4e"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#787878"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "labels.icon",
        "stylers": [
            {
                "hue": "#0a00ff"
            },
            {
                "saturation": "-77"
            },
            {
                "gamma": "0.57"
            },
            {
                "lightness": "0"
            }
        ]
    },
    {
        "featureType": "transit.station.rail",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#43321e"
            }
        ]
    },
    {
        "featureType": "transit.station.rail",
        "elementType": "labels.icon",
        "stylers": [
            {
                "hue": "#ff6c00"
            },
            {
                "lightness": "4"
            },
            {
                "gamma": "0.75"
            },
            {
                "saturation": "-68"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#eaf6f8"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#c7eced"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "lightness": "-49"
            },
            {
                "saturation": "-53"
            },
            {
                "gamma": "0.79"
            }
        ]
    }
]
        };
        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(23.8748, 90.3858),
            map: map,
            title: 'Cryptox'
        });
    }
    if ($('#map').length != 0) {
        google.maps.event.addDomListener(window, 'load', basicmap);
    }	
		*/
	//Wow js active
    new WOW().init();	

    // Preloader Js
    $(window).on('load', function(){
      $('.preloader').fadeOut(1000); // set duration in brackets    
    });

	
})(jQuery);