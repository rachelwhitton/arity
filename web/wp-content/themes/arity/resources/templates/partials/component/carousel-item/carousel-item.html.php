<?php
namespace App\Theme;

/*
  Template Name:      Carousel Item
  Template Type:      Component
  Description:        This component comprises a slide within the carousel module
  Last Updated:       05/21/2019
  Since:              2.3.0
*/
?>

<div class="carousel-item">
<?php
element('image', [
	'id' => $data['image_id'],
	'classes' => $data['img-classes']
]);
?>
</div>