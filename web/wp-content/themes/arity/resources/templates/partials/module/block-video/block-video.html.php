<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Video
  Template Type:      Module
  Description:        Video
  Last Updated:       12/15/2017
  Since:              1.3.0
*/
?>
<div <?php module_class('block-video video-module'); ?>>
  <div class="container">
    <figure class="video-wrapper">
      <?php the_video($data['url']); ?>
    </figure>
  </div>
</div>
