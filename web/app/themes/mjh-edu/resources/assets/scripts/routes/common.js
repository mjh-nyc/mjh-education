export default {
	init() {
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
			element: jQuery('.sticky')[0],
			offset: -1,
		})
		sticky.options.enabled = true;


		jQuery(".animsition").animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 1500,
            outDuration: 800,
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
          jQuery(".parallax-mirror").fadeIn("slow");
        });

	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};	