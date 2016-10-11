<?php
/**
 * @file
 * Display Suite 2 column template.
 */
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="ds-hc-2col <?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <div class="row">
		<<?php print $right_wrapper ?> class="group-right right-goes-top col-md-4 col-xs-12 <?php print $right_classes; ?>">
		<?php print $right; ?>
		</<?php print $right_wrapper ?>>

		<<?php print $left_wrapper ?> class="group-left col-md-8 col-xs-12 <?php print $left_classes; ?>">
			<?php print $left; ?>
		</<?php print $left_wrapper ?>>
  </div>

</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
