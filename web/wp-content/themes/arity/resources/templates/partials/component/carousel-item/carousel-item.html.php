<?php
namespace App\Theme;

/*
  Template Name:      Carousel Item
  Template Type:      Component
  Description:        This component comprises a slide within the carousel module
  Last Updated:       05/21/2019
  Since:              2.3.0
*/
 // echo '<pre>'; print_r($data); echo '</pre>'; 

?>

<div class="carousel-item<?=$data['active'];?>">
	<?=wp_get_attachment_image($data['image_id'], $data['size'], null, $data['attrs']);?>
</div>
