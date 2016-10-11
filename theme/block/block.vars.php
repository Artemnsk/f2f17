<?php
/**
 * @file
 * block.vars.php
 */

/**
 * Implements hook_preprocess_block().
 */
function himss17_preprocess_block(&$variables) {
}

/**
 * Implements hook_process_block().
 */
function himss17_process_block(&$variables) {
  $block = $variables['block'];
  if (isset($block->title)) {
    $variables['title'] = $block->title == '<none>' ? '' : $block->title;
  }
  else {
    $variables['title'] = $block->subject;
  }
}
