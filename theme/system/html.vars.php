<?php
/**
 * @file
 * html.vars.php
 *
 * @see html.tpl.php
 */

/**
 * Implements hook_preprocess_html().
 */
function _default_himss17_preprocess_html(&$variables) {
  // Fonts.
  // todo here we need the new font names defined
  drupal_add_html_head(array(
    '#type' => 'markup',
    '#weight' => -200,
    '#markup' => "
      <script>
        WebFontConfig = {
          custom: {
            families: [
              'proxima-nova',
              'proxima-nova-bold',
              'proxima-nova-light'
              ],
              urls: ['" . url(path_to_theme() . '/fonts/fonts.css') . "']
            }
        };

        (function() {
          var wf = document.createElement('script');
          wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1.5.6/webfont.js';
          wf.type = 'text/javascript';
          wf.async = 'true';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(wf, s);
        })();
      </script>"
  ), 'webfont');

  // Detect domain name.
  $variables['classes_array'][] = 'site-' . core_get_sitecode();

	// Add CSS.
	himss17_add_css();
}

if (!function_exists("himss17_preprocess_html")) {
	function himss17_preprocess_html(&$variables) {
		_default_himss17_preprocess_html($variables);
	}
}