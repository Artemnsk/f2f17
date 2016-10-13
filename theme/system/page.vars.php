<?php
/**
 * @file
 * page.vars.php
 */

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function _default_himss17_preprocess_page(&$variables) {
  // Set parallax header image in style.
	$variables['parallax_header_style'] = '';
  if (!drupal_is_front_page()) {
    $image_url = '';
    // For node page let's use this node field_parallax_header field.
    if (($node = menu_get_object()) && node_is_page($node)) {
      $node_wrapper = entity_metadata_wrapper("node", $node);
      if ($node_wrapper->__isset('field_parallax_header') && ($image = $node_wrapper->field_parallax_header->value())) {
        $image_url = file_create_url($image['uri']);
      }
    }
    // If $image_url is still empty we want to fill it with one of default values.
    if (empty($image_url) && ($header_parallax = theme_get_setting('header_parallax', "himss17"))) {
      $header_parallax = theme_get_setting('header_parallax', "himss17");
      $random_key = rand(0, sizeof($header_parallax) - 1);
      $image_url = $header_parallax[$random_key];
    }
    $variables['parallax_header_style'] = "background-image: url($image_url);";
  }
  // Top User Menu.
  $logged_in = user_is_logged_in();
  $username = '';
  if ($logged_in) {
    global $user;
    $account = user_load($user->uid);
    $username = field_get_item($account, 'field_fname', 0, 'value', 'user');
  }
  $variables['navbar_user_menu'] = theme('navbar_user_menu', array('logged_in' => $logged_in, 'username' => $username));
  // Register link.
  $register_link = l('Register', 'node/511', array('attributes' => array('id' => array('account-link'), 'rel' => array('nofollow'))));
	// TODO: in variable.
  $variables['secondary_nav'] = menu_tree('menu-register');//theme('himss17_mobile_menu', array('menu' => array()));//'<ul class="menu nav navbar-nav secondary"><li>' . $register_link . '</li></ul>';
	$variables['mobile_menu'] = theme('himss17_mobile_menu', array('menu' => array()));
  // Textsearch block.
  $search_block_module = theme_get_setting('search_block_module', 'himss17');
  $search_block_delta = theme_get_setting('search_block_delta', 'himss17');
  if (!empty($search_block_module) && !empty($search_block_delta)) {
    if ($block = block_load($search_block_module, $search_block_delta)) {
      // This class should be used in SCSS for this block to be able to vary blocks in themes.
      $block->css_class = 'header-search-block';
      $render_array = _block_get_renderable_array(_block_render_blocks(array($block)));
      $variables['search_block'] = $render_array;
    }
  }
  // Footer info.
  $variables['footer_info'] = theme_get_setting('footer_info', "himss17");
  // Footer menu.
  $variables['footer_menu'] = menu_tree('menu-footer');
  // Logo.
  if ($logo_path = theme_get_setting('site_logo', "himss17")) {
    $variables['logo_path'] = $logo_path;
  }
}

if (!function_exists("himss17_preprocess_page")) {
	function himss17_preprocess_page(&$variables) {
		_default_himss17_preprocess_page($variables);
	}
}