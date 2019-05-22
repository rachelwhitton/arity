<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Carousel
  Template Type:      Module
  Description:        Body block with one column
  Last Updated:       05/21/2019
  Since:              2.3.0
*/

?>

<div <?php module_class($data['classes']); ?>>
	<div class="container">
		<div class="row">
			<div id="<?=$data['carousel-id']?>" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php
						foreach ($data['carousel-items'] as $item) {
							component('carousel-item', $item);
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>