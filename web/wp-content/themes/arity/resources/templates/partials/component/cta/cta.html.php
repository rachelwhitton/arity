<?php
namespace App\Theme;

/*
Template Name:      CTA
Template Type:      Component
Description:
Last Updated:       08/03/2017
Since:              1.0.0
*/
?>
<div <?php component_class('cta'); ?>>
  <?php element('button', array_merge($data, [
    'classes' => 'button--primary blue-button--'
  ])); ?>
</div>
