(function ($, Drupal, window, document, undefined) {
	// Checks that selector exists.
	$.fn.exists = function () {
		return this.length > 0;
	};

	Drupal.behaviors.affixHeader = {
		attach: function (context, settings) {
			// Navbar.
			var navbar = $('#navbar');

			// Applies max-height CSS styles to navbar menu to make it gracefully scrollable for mobile phones.
			var apply_navbar_menu_max_height = function () {
				navbar.find('.navbar-collapse').css('max-height', $(window).height() - navbar.outerHeight());
				navbar.find('.navbar-collapse .expand-wrapper-outer').css('max-height', $(window).height() - navbar.outerHeight() - $('.region-region-page-top').outerHeight());
			};
			// Applies top CSS styles to navbar.
			var apply_navbar_top = function () {
				navbar.css("top", offset_target.outerHeight());
			};
			// Applies affix on load.
			var apply_affix_load = function () {
				navbar.affix({offset: {top: offset_target.outerHeight()}});
			};
			// Reapplies affix on resize.
			var apply_affix_resize = function () {
				navbar.data('bs.affix').options.offset.top = offset_target.outerHeight();
			};

			// Stick header to the top of screen with Dynamic offset = region_page_top height.
			var offset_target = $('.region-region-page-top');

			$(window).load(function () {
				apply_affix_load();
				apply_navbar_top();
				apply_navbar_menu_max_height();
				$(this).trigger('navbar_initialized');
			});
			$(window).resize(function () {
				apply_affix_resize();
				apply_navbar_top();
				apply_navbar_menu_max_height();
			});

			// Hide/show header on scroll top/down.
			var lastScrollTop = 0;
			$(window).on('navbar_initialized', function () {
				// To be sure that these actions performed when navbar has already been affixed.
				$(window).scroll(function () {
					var st = $(this).scrollTop();
					if (st < lastScrollTop) {
						// Scrolled Up.
						navbar.show();
					} else if (st > lastScrollTop) {
						// If we don't have at least one navbar submenu opened and navbar is affixed - hide navbar on scroll down.
						// ALSO if user menu is collapsed.
						var mobile_user_menu_collapsed = $('.nice-user-menu-mobile').hasClass('mobile-menu-collapse');
						if (!navbar.find("li.dropdown.open").exists() && !navbar.find('.navbar-collapse').hasClass('in') && navbar.hasClass("affix") && mobile_user_menu_collapsed) {
							// Scrolled Down.
							navbar.hide();
						}
					}
					lastScrollTop = st;
				});
			});
		}
	};
})(jQuery, Drupal, this, this.document);