<?php
namespace App\Theme;

/*
  Template Name:      Hero Block One Column
  Template Type:      Component
  Description:        One column content block within the "Hero B" type module
  Last Updated:       08/02/2017
  Since:              1.0.0
*/
?>

<div <?php component_class('hero-block'); ?>>
  <div class="hero-block__header"><?= $data['headline']; ?></div>
  <div class="hero-block__p type6">
    <?= apply_filters('the_content', $data['body_copy']); ?>
  </div>
</div>
