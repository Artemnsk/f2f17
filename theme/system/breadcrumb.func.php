<?php
/**
 * @file
 * breadcrumb.func.php
 */

/**
 * Overrides theme_breadcrumb().
 * Print breadcrumbs as an ordered list.
 */
function himss17_breadcrumb($variables) {
  $output = '';
  $breadcrumb = $variables['breadcrumb'];

  // Add separators.
  $breadcrumb_new = array();
  for ($i = 0; $i < sizeof($breadcrumb); $i++) {
    $breadcrumb_new[] = $breadcrumb[$i];
    if ($i < sizeof($breadcrumb) - 1) {
      $breadcrumb_new[] = '<i class="fa fa-angle-right"></i>';
    }
  }
  $breadcrumb = $breadcrumb_new;

  // Determine if we are to display the breadcrumb.
  $bootstrap_breadcrumb = theme_get_setting('bootstrap_breadcrumb');
  if (($bootstrap_breadcrumb == 1 || ($bootstrap_breadcrumb == 2 && arg(0) == 'admin')) && !empty($breadcrumb)) {
    $output = theme('item_list', array(
      'attributes' => array(
        'class' => array('breadcrumb'),
      ),
      'items' => $breadcrumb,
      'type' => 'ol',
    ));
  }
  return $output;
}
