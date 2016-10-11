<?php
/**
 * @file
 * Default view template to display content in a Masonry layout.
 */
?>
<?php if ($gutter_sizer): ?>
  <div class="gutter-sizer"></div>
<?php endif; ?>
<?php if (!empty($sidebar_content)): ?>
  <div class="view-stamp">
    <?php print(render($sidebar_content)); ?>
  </div>
<?php endif; ?>

<?php foreach ($rows as $id => $row): ?>
  <div class="masonry-item masonry-block <?php if ($classes_array[$id]) {
    print ' ' . $classes_array[$id];
  } ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>

