<?php

namespace App\Theme;

/*
  Template Name:      Hero Image
  Template Type:      Component
  Description:        Full bleed, absolutely placed hero image for "Hero B" pages
  Last Updated:       08/01/2017
  Since:              1.0.0
*/
?>
<div <?php component_class('hero-image'); ?><?php if (!empty($data['background-image'])) : ?> style="background-image: url(<?= $data['background-image']; ?>);"<?php endif; ?>></div>

<?php if ($data['overlay']) : ?>
  <!-- div class="hero-image__overlay"><div class="overlay-inner"></div></div -->
<div class="hero-image__overlay hero-elaborated dots-animate-modified">
    <ul id="loader">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    </ul>
</div>
<?php endif; ?>
