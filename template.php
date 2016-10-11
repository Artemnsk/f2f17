<?php

/**
 * @file
 * template.php
 */

bootstrap_include('himss17', 'theme/alter.inc');

/**
 * @param $relative_path
 *
 * @return bool|mixed
 */
function theme_get_include_path($relative_path) {
  global $theme_path;
  $path = DRUPAL_ROOT . '/' . $theme_path;
  $relative_path = 'theme/' . $relative_path;

  // Suggestions.
  $suggestions = array(
    $path . '/' . $relative_path,
  );

  // Iterate.
  foreach ($suggestions as $suggestion) {
    if (file_exists($suggestion)) {
      return $suggestion;
    }
  }

  return FALSE;
}

/**
 * @param $existing
 * @param $type
 * @param $theme
 * @param $path
 *
 * @return array
 */
function himss17_theme(&$existing, $type, $theme, $path) {
	// TODO: sitecode in theme variable?
  bootstrap_include($theme, 'theme/registry.inc');
	// We combine theme-SITECODE and theme registries instead of just return defaults from theme only.
	$himss17_registry = array();
	if ($sitecode = core_get_sitecode()) {
		$himss17_registry = _bootstrap_theme($existing, $type, $theme, $path . "/custom/" . $sitecode);
	}
	$bootstrap_registry = _bootstrap_theme($existing, $type, $theme, $path);
	return drupal_array_merge_deep($bootstrap_registry, $himss17_registry);
}
