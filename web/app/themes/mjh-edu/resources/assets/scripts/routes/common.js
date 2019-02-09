export default {
	init() {

		



		


	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired

		//https://coderwall.com/p/q19via/jquery-dom-cache-object
		var DOMCACHESTORE = {};
		var DOMCACHE = {
			get: function(selector, force) {
				if (DOMCACHESTORE[selector] !== undefined && force === undefined) {
					return DOMCACHESTORE[selector];
				}
				DOMCACHESTORE[selector] = $(selector);
				return DOMCACHESTORE[selector];
			},
		};

		//cache DOM elements we'll be using in script below
		var $body 					= DOMCACHE.get('body'),
			$hamburger 				= DOMCACHE.get('.hamburger'),
			$social_channel_links	= DOMCACHE.get('.social-channels a'),
			$account_link			= DOMCACHE.get('.account-link'),
			$logo_SVG				= DOMCACHE.get('.logo svg'),
			$overlay_nav			= DOMCACHE.get('.overlay-nav');
		// Add image loazy load
		//Lazy load images and background images where class lazy has been added
		$('.lazy').unveil({
			offset: 100,
		});
		
		// Initiate Typekit Fonts
		window.WebFontConfig = {
			typekit: {
				id: 'gzh5wlp',
			},
		};
		(function(d) {
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);

		//init sticky header
		var Waypoint = window.Waypoint;
		var sticky = new Waypoint.Sticky({
			element: $('.sticky')[0],
			offset: -1,
		})
		sticky.options.enabled = true;

		//cache DOM
		// init hamburger navigation icon
		$hamburger.on('click', function() {
			$(this).toggleClass('is-active');
			$social_channel_links.toggleClass('nav-active');
			$account_link.toggleClass('nav-active');
			$logo_SVG.toggleClass('nav-active');
			if ($body.hasClass('nav_open')) {
				$body.removeClass('nav_open').addClass('nav_closed');
			} else {
				$body.removeClass('nav_closed').addClass('nav_open');
			}
		});
		//on initial load, set body class
		$body.addClass('nav_closed');
		
		//navigation overlay
		$hamburger.bind('click', function(event) {
			resetMenuSize (event);
		});
		
		var resetMenuSize = function (event) {
			event.preventDefault();
			$overlay_nav.css({ 'height': $(document).height() }).fadeToggle();
			$("html, body").animate({ scrollTop: 0 });
		};

		$('#menu-main-navigation .menu-item-has-children > a').bind('click', function(event) {
			event.preventDefault();
			$(this).parent().toggleClass('open').find('ul').slideToggle();
			//adjust overlay height
			//becuase we're animating the navigation items down, we have to wait for the animation to complete
			setTimeout(function () {
				$('.overlay-nav').css({ 'height': $(document).height() });
			}, 1000);
		})
		//automatically expand parent if we're on a subpage
		$('#menu-main-navigation .current-menu-parent').toggleClass('open').find('ul').slideToggle();


		//Set autocomplete off for the search form
		$('.search-form').attr('autocomplete','off');

		$(".animsition").animsition({
			inClass: 'fade-in',
			outClass: 'fade-out',
			inDuration: 500,
			outDuration: 400,
			linkElement: '.animsition-link',
			// e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
			loading: true,
			loadingParentElement: 'body', //animsition wrapper element
			loadingClass: 'animsition-loading',
			loadingInner: '', // e.g '<img src="loading.svg" />'
			timeout: false,
			timeoutCountdown: 5000,
			onLoadEvent: true,
			browser: ['animation-duration', '-webkit-animation-duration'],
			// "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
			// The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
			overlay: false,
			overlayClass: 'animsition-overlay-slide',
			overlayParentElement: 'body',
			transition: function(url) { window.location.href = url; },
		}).one('animsition.inStart', function(){
			$(".parallax-mirror").fadeIn("slow");
		}).one('animsition.outStart', function(){
			$(".parallax-mirror").fadeOut("fast");
		});

		if(jQuery(".parallax-window").attr('alt')){
            jQuery(".parallax-mirror img").attr("alt",jQuery(".parallax-window").attr('alt'));
		}

		//add animsition-link class to menu items
		/*$('#menu-main-navigation a').each(function() {
			$( this ).addClass('animsition-link');
		});*/

		//wrap video embeds with elastic container to make them responsive
		jQuery('.entry-content, .page-content, .page')
			.find( "iframe, object, embed" )
			.wrap( "<div class='video-container'></div>" );

		// Set acf tables to presentation role for accessibility
		if(jQuery( ".acf-table" ).length > 0){
			jQuery( ".acf-table" ).each(function( ) {
				$( this ).attr('role','presentation');
			});
		}
	},
};	