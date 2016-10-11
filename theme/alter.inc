<?php
/**
 * @file
 * alter.inc
 * Contains various implementations of hook_*_alter().
 */

function himss17_add_css() {
	if ($sitecode = core_get_sitecode()) {
		drupal_add_css(path_to_theme() . '/css/style-' . $sitecode . '.css');
	}
}

/**
 * Implements hook_css_alter().
 */
function himss17_css_alter(&$css) {
  // Add Bootstrap CDN file and overrides.
  $bootstrap_cdn = theme_get_setting('bootstrap_cdn');

  // Bootstrap not loaded and we load it from local.
  if (!$bootstrap_cdn) {
    // Boostrap CSS.
    $bootstrap_version = theme_get_setting('bootstrap_version');
    $bootstrap_css = url(libraries_get_path('bootstrap-' . $bootstrap_version) . '/css/bootstrap.min.css', array(
      'absolute' => TRUE,
    ));
    $css[$bootstrap_css] = array(
      'data' => $bootstrap_css,
      'type' => 'external',
      'every_page' => TRUE,
      'media' => 'all',
      'preprocess' => FALSE,
      'group' => CSS_THEME,
      'browsers' => array('IE' => TRUE, '!IE' => TRUE),
      'weight' => -2,
    );

    // Add overrides.
    $theme_path = drupal_get_path('theme', 'bootstrap');
    $override = $theme_path . '/css/overrides.css';
    $css[$override] = array(
      'data' => $override,
      'type' => 'file',
      'every_page' => TRUE,
      'media' => 'all',
      'preprocess' => TRUE,
      'group' => CSS_THEME,
      'browsers' => array('IE' => TRUE, '!IE' => TRUE),
      'weight' => -1,
    );
  }
}

/**
 * Implements hook_js_alter().
 */
function himss17_js_alter(&$js) {
	if ($sitecode = core_get_sitecode()) {
		// TODO: make it independent of current theme. Maybe theme_get_setting('name')?
		$theme_path = drupal_get_path('theme', 'himss17');
		// Default JS.
		$files = file_scan_directory($theme_path . '/js', '/\.js$/');
		foreach ($files as $file) {
			$js[$file->uri] = drupal_js_defaults($file->uri);
			$js[$file->uri]['group'] = JS_THEME;
		}
		// Custom JS.
		$files = file_scan_directory($theme_path . '/custom/' . $sitecode . '/js', '/\.js$/');
		foreach ($files as $file) {
			$js[$file->uri] = drupal_js_defaults($file->uri);
			$js[$file->uri]['group'] = JS_THEME;
		}
		// TODO: override module JS as in contrib bootstrap theme? If needed of course - you always can override behaviors.
		// Add Bootstrap CDN file and overrides.
		$bootstrap_cdn = theme_get_setting('bootstrap_cdn');
		// Bootstrap not loaded and we load it from local.
		if (!$bootstrap_cdn) {
			// Boostrap CSS.
			$bootstrap_version = theme_get_setting('bootstrap_version');
			$bootstrap_js = libraries_get_path('bootstrap-' . $bootstrap_version) . '/js/bootstrap.min.js';

			$js[$bootstrap_js] = drupal_js_defaults();
			$js[$bootstrap_js]['group'] = JS_LIBRARY;
			$js[$bootstrap_js]['data'] = $bootstrap_js;
			$js[$bootstrap_js]['every_page'] = TRUE;
			$js[$bootstrap_js]['weight'] = 100000;
		}
	}
}
