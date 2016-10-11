<?php
/**
 * @file
 * menu-link.func.php
 */

/**
 * Overrides theme_menu_link().
 */
function _default_himss17_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
  $link = $element['#original_link'];

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($link['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    else {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);

      // menu name
      if ('main-menu' == $link['menu_name']) {
        if (module_exists('menu_item_block') && (1 == $link['depth'])) {
          $mlid = $link['mlid'];
          if ($menu_item_block = variable_get('menu_item_block_' . $mlid, '')) {
            list($module, $delta) = explode('|', $menu_item_block, 2);
            $block = block_render($module, $delta);
            $element['#below'] = array(
                0 => array(
                  '#markup' => $block,
                )
              ) + $element['#below'];
          }
        }
      }
      $prefix = '';
      $suffix = '';
      // Container for main-menu only to support screen-wide menus.
      if (1 == $link['depth'] && 'main-menu' == $link['menu_name']) {
        $prefix = '<div class="expand-wrapper-outer"><div class="expand-wrapper-inner"><div class="container">';
        $suffix = '</div></div></div>';
      }
      $sub_menu = '<ul class="dropdown-menu">' . $prefix . drupal_render($element['#below']) . $suffix . '</ul>';
      // Generate as standard dropdown.
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;

      // Dropdown Trigger
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

      // No Dropdown Trigger for the Main Menu
      if ('main-menu' == $link['menu_name']) {
        // Remove the below condition to make 1-level click lead to story.
        if ($link['depth'] > 1) {
          unset($element['#localized_options']['attributes']['data-toggle']);
        }
      }
    }
  }

  // mlid
  $element['#localized_options']['attributes']['data-mlid'] = $link['mlid'];

  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  // Check for fragments.{
  $fragment_link_regexp = '/^(([^\/]*\/)+[^\/]*)#([^\/]*)$/';
  if (preg_match($fragment_link_regexp, $element['#href'])) {
    $old_href = $element['#href'];
    $element['#href'] = preg_replace($fragment_link_regexp, '$1', $old_href);
    $fragment = preg_replace($fragment_link_regexp, '$3', $old_href);
    // Override fragment.
    $element['#localized_options']['fragment'] = $fragment;
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

if (!function_exists("himss17_menu_link")) {
  function himss17_menu_link(&$variables) {
    _default_himss17_menu_link($variables);
  }
}