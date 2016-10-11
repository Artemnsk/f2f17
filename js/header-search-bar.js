(function ($, Drupal, window, document, undefined) {
	Drupal.behaviors.headerSearchBar = {
		attach: function (context, settings) {
			// Search bar.
			var search_block = $('#navbar .block-view-exposed-block');
			search_block.find('.views-submit-button').click(function (e) {
				if (!search_block.hasClass('open-search-block')) {
					e.preventDefault();
					search_block.addClass('open-search-block');
					$(document).mouseup(function (e) {
						if (!search_block.is(e.target)
							&& search_block.has(e.target).length === 0) {
							search_block.removeClass('open-search-block');
						}
					});
				}
			});
		}
	};
})(jQuery, Drupal, this, this.document);