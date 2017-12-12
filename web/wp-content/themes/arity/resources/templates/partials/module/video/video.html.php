<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Video
  Template Type:      Module
  Description:        Video
  Last Updated:       12/11/2017
  Since:              1.2.0
*/
?>

<div <?php module_class('video'); ?>>
  <div class="container">
    <?php the_video($data['url']); ?>
  </div>
</div>
