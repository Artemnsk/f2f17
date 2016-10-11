<?php
/**
 * @file
 * settings.inc
 */

/**
 * Contains the form for the theme settings.
 *
 * @param array $form
 *   The form array, passed by reference.
 * @param array $form_state
 *   The form state array, passed by reference.
 */
function _himss17_settings_form(&$form, $form_state) {
  $form['himss17'] = array(
    '#type' => 'vertical_tabs',
    '#attached' => array(
      'js'  => array(drupal_get_path('theme', 'bootstrap') . '/js/bootstrap.admin.js'),
    ),
    '#prefix' => '<h2><small>' . t('himss17 Settings') . '</small></h2>',
    '#weight' => -11,
  );
  // Parallax.
  $form['parallax_fieldset'] = array(
    '#type' => 'fieldset',
    '#title' => t('Header Parallax'),
    '#group' => 'himss17',
  );
  $header_parallax = theme_get_setting('header_parallax', "himss17");
  if (!is_array($header_parallax)) {
    $header_parallax = array();
  }
  $form['parallax_fieldset']['header_parallax'] = array(
    '#type' => 'textarea',
    '#title' => t('Header Parallax image URLs'),
    '#default_value' => implode("\n", $header_parallax),
  );
  // Logos.
  $form['logos_fieldset'] = array(
    '#type' => 'fieldset',
    '#title' => t('Logos'),
    '#group' => 'himss17',
  );
  // Default logo.
  $site_logo = theme_get_setting('site_logo', "himss17");
  $form['logos_fieldset']['site_logo'] = array(
    '#type' => 'textfield',
    '#title' => t('Default Site logo URL'),
    '#description' => t('Used on every website page except specified below'),
    '#default_value' => $site_logo,
  );
  // Blocks fieldset.
  $form['blocks_fieldset'] = array(
    '#type' => 'fieldset',
    '#title' => t('Blocks'),
    '#group' => 'himss17',
  );
  // Search block fieldset.
  $form['blocks_fieldset']['search_block'] = array(
    '#type' => 'fieldset',
    '#title' => t('Search Block'),
  );
  // Search block Module name.
  $search_block_module = theme_get_setting('search_block_module', "himss17");
  $form['blocks_fieldset']['search_block']['search_block_module'] = array(
    '#type' => 'textfield',
    '#title' => t('Module Name'),
    '#description' => t('Module Name used to load block'),
    '#default_value' => empty($search_block_module) ? '' : $search_block_module,
  );
  // Search block block delta.
  $search_block_delta = theme_get_setting('search_block_delta', "himss17");
  $form['blocks_fieldset']['search_block']['search_block_delta'] = array(
    '#type' => 'textfield',
    '#title' => t('Delta'),
    '#description' => t('Block Delta used to load block'),
    '#default_value' => empty($search_block_delta) ? '' : $search_block_delta,
  );
  // Submit.
  $form['#submit'][] = '_himss17_settings_form_submit';
}

/**
 * _himss17_settings_form submit callback.
 */
function _himss17_settings_form_submit($form, &$form_state) {
  // Save header_parallax as array.
  if (isset($form_state['values']['header_parallax'])) {
    $header_parallax_str = $form_state['values']['header_parallax'];
    $header_parallax = explode("\n", $header_parallax_str);
    // Trim each URL.
    foreach ($header_parallax as $key => $val) {
      $header_parallax[$key] = trim($header_parallax[$key]);
    }
    $form_state['values']['header_parallax'] = $header_parallax;
  }
}