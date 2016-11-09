<?php if (!empty($page['region_page_top'])): ?>
<div class="top-region-wrapper">
  <?php print render($page['region_page_top']); ?>
</div>
<?php endif; ?>

<header id="navbar" role="banner" class="<?php print $navbar_classes; ?>">
  <div class="container">
    <div class="navbar-header">
      <?php if ($logo): ?>
        <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
          <?php if ($logo_path): ?>
            <img src="<?php print $logo_path; ?>" alt="<?php print t('Home'); ?>" />
          <?php endif; ?>
        </a>
      <?php endif; ?>
    </div>

    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
			<?php if (!empty($page['region_main_menu'])): ?>
				<div class="main-menu-wrapper">
					<nav role="navigation">
						<?php print render($page['region_main_menu']); ?>
					</nav>
				</div>
			<?php endif; ?>
    <?php endif; ?>

		<?php print $mobile_menu; ?>
  </div>
</header>