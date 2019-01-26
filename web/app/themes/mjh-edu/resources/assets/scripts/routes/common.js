export default {
	init() {

		//cache DOM elements
		var $body 			= $('body'),
			$hamburger 		= $('.hamburger');



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

		// init hamburger navigation icon
		$hamburger.on('click', function() {
			$(this).toggleClass('is-active');
			$('.social-channels a').toggleClass('nav-active');
			$('.account-link').toggleClass('nav-active');
			$('.logo svg').toggleClass('nav-active');
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
			$('.overlay-nav').css({ 'height': $(document).height() }).fadeToggle();
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

		//add animsition-link class to menu items
		/*$('#menu-main-navigation a').each(function() {
			$( this ).addClass('animsition-link');
		});*/

		//wrap video embeds with elastic container to make them responsive
		jQuery('.entry-content, .page-content, .page')
			.find( "iframe, object, embed" )
			.wrap( "<div class='video-container'></div>" );


	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};	