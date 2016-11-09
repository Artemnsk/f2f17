(function ($, Drupal, window, document, undefined) {
	Drupal.behaviors.SmoothScrollSpy = {
		attach: function (context, settings) {
			$("a").on('click', function (event) {
				// Make sure this.hash has a value before overriding default behavior
				if (this.hash !== "") {
					// Make sure link is active which means that we are on needed page and can scroll.
					if ($(this).hasClass('active')) {
						var hash = this.hash;
						// Prevent default anchor click behavior
						event.preventDefault();
						$('html, body').animate({scrollTop: $(hash).offset().top}, 600, function () {
							// Add hash (#) to URL when done scrolling (default click behavior)
							window.location.hash = hash;
						});
					}
				}
			});
		}
	};
})(jQuery, Drupal, this, this.document);