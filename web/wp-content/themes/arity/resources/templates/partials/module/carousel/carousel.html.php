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

<?php if (!empty($data['carousel-items'])) : ?>
	<div <?php module_class($data['classes']); ?>>
		<div class="container">
			<div class="row">
				<div id="<?=$data['carousel-id'];?>" class="carousel slide">
					<div class="carousel-inner">
						<?php
							foreach ($data['carousel-items'] as $key=>$item) {
								$item['active'] = ($key == 0) ? ' active' : '';
								component('carousel-item', $item);
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>