export default {
	init() {

		



		


	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired

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


		//Navigation
		/**********************/
		//If making code changes, be sure to replicate to education site nav, as it pulls its navigation from the main site.
        var $open_menu = 'id'; //temp before it gets set below;
        //primary navigation
        var topMenuClick = function(event) {
          event.preventDefault();
          //close any open menus unless there's a 3rd level 
          if($open_menu!=jQuery(this).parent().attr('id')) {
            jQuery('#' + $open_menu).removeClass('open').find('ul').css('display','none');
          }
          //open selected menu
          jQuery(this).parent().toggleClass('open').find('ul').slideToggle(100);
          //set as current
          $open_menu = jQuery(this).parent().attr('id');
          setTimeout(adjustMenuHeight,500);
        }
        //adjust menu hight if a 3rd level nav is present and we're on a child page
        //gotta do this on a timer above
        var adjustMenuHeight = function() {
          //open the 3rd level menu if we're on the page that's a child
          var thirdLevelIsCurrent = jQuery('#menu-primary-navigation .menu-item-has-children .has-submenu .current-menu-ancestor');
          if(thirdLevelIsCurrent.length > 0) {
            thirdLevelIsCurrent.find('a').first().click();
          }
        }


        var $open_sub_menu = 'id'; //temp before it gets set below;
        var secondaryMenuClick = function(event) {
          event.preventDefault();
          var thisParent = jQuery(this).parent();
          var thisSubMenu = thisParent.find('.sub-menu-container');
          var thisMainParent = jQuery(this).parent().parent();
          if($open_sub_menu!=thisParent.attr('id')) {
            jQuery('#' + $open_sub_menu).removeClass('current-menu-item');
            jQuery('#' + $open_sub_menu).find('.sub-menu-container').removeClass('open');
          }
          thisParent.addClass('current-menu-item');
          $open_sub_menu = thisParent.attr('id');
          thisSubMenu.addClass('open');
          //adjust parent height
          //get height of the submenu
          var submenu_height = thisSubMenu.find('.sub-menu').height();
          if(submenu_height >  thisMainParent.height()) {
            thisMainParent.height(submenu_height);
          } else {
            thisMainParent.css('height','auto');
          }
        }

        jQuery('#menu-primary-navigation .menu-item-has-children > a, #menu-collapsible-sidenavigation .menu-item-has-children > a').bind('click', topMenuClick);
        //wrap submenus
        jQuery('.menu-primary-navigation-container .sub-menu').wrap('<div class="sub-menu-container"></div>');

        //if there are 3rd level items, add class
        jQuery('.menu-primary-navigation-container .sub-menu .sub-menu').parent().parent().parent().addClass('has-submenu');
        jQuery('.menu-primary-navigation-container .sub-menu .menu-item-has-children > a').unbind('click', topMenuClick);
        jQuery('.menu-primary-navigation-container .sub-menu .menu-item-has-children > a').bind('click', secondaryMenuClick);
      
        //open the 3rd level menu if we're on the page that's a child
        var thirdLevelIsCurrent = jQuery('#menu-primary-navigation .menu-item-has-children .has-submenu .current-menu-ancestor');
        if(thirdLevelIsCurrent.length > 0) {
          thirdLevelIsCurrent.find('a').first().click();
        }

        // JavaScript to be fired on all pages in tablet and mobile views
        jQuery('#primary-nav-toggle').bind('click', function(event) {
            event.preventDefault();
            jQuery(this).toggleClass('open');
            jQuery('.overlay-nav').css({ 'height': jQuery(document).height() }).fadeToggle();
            jQuery("html, body").animate({ scrollTop: 0 });
            //position the close button aprparent ent over the menu button
            var offset = jQuery('#primary-nav-toggle').offset();
            var close_btn_offset = $(window).width() - offset.left - jQuery('#primary-nav-toggle').width();
            jQuery('.overlay-nav .overlay-toggle').css('right',close_btn_offset+'px');
        })
        jQuery('#primary-nav-close').bind('click', function(event) {
            event.preventDefault();
            jQuery('.overlay-nav').fadeOut();
            jQuery('#primary-nav-toggle').removeClass('open');
            jQuery('#menu-overlay-navigation .open').removeClass('open').find('ul').hide();
        })
        jQuery('#menu-overlay-navigation .menu-item-has-children > a').bind('click', function(event) {
            event.preventDefault();
            jQuery(this).parent().toggleClass('open').find('ul').slideToggle();
            //adjust overlay height
            //becuase we're animating the navigation items down, we have to wait for the animation to complete
            setTimeout(function () {
                jQuery('.overlay-nav').css({ 'height': jQuery(document).height() });
                 jQuery(".subPageNav").trigger("sticky_kit:recalc");
            }, 1000);


        })
        //automatically expand parent if we're on a subpage
        jQuery('#menu-overlay-navigation .current-menu-parent').toggleClass('open').find('ul').slideToggle();


        //init sticky header
		var Waypoint = window.Waypoint;
		var sticky = new Waypoint.Sticky({
			element: jQuery('.sticky')[0],
		})
		sticky.options.enabled = true;

		var $miniSearchOpen = jQuery('#menu-mini-top-search--open');
		var $miniSearchClose = jQuery('#menu-mini-top-search--close');
		var $miniSearchForm = jQuery('#menu-mini-top-search--form');

		$miniSearchOpen.on( "click", function(event) {
			event.preventDefault();
			$miniSearchForm.slideToggle(100);
			//focus
			$miniSearchForm.find('.search-field').focus();
		});
		$miniSearchClose.on( "click", function(event) {
			event.preventDefault();
			$miniSearchForm.slideToggle(100);
		});

        //END navigation **********/




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
			//$(".parallax-mirror").fadeIn("slow");
		}).one('animsition.outStart', function(){
			//$(".parallax-mirror").fadeOut("fast");
		});

		/*if(jQuery(".parallax-window").attr('alt')){
            jQuery(".parallax-mirror img").attr("alt",jQuery(".parallax-window").attr('alt'));
		}*/

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