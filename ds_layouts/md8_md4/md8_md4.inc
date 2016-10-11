<?php

function ds_md8_md4 () {
  return array(
    'label' => t('2 Column Layout - md8/md4. Right column goes top on small resolutions.'),
    'regions' => array(
      'left' => t('Left'),
      'right' => t('Right'),
    ),
    // Add this line if there is a default css file.
    'css' => FALSE,
    // Add this line if you're using DS 2.x for icon preview
    'image' => FALSE,
  );
}