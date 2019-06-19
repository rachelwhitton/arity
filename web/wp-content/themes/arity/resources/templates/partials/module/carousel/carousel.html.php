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
 // echo '<pre>'; print_r($data); echo '</pre>'; 
?>

<?php if (!empty($data['carousel-items'])) : ?>
	<div <?php module_class($data['classes']); ?>>
		<div class="container-fluid">
			<div class="row">
				<div id="<?=$data['carousel-id'];?>" class="carousel slide carousel-fade col" data-ride="carousel">
					<div class="carousel-inner">
						<?php
							foreach ($data['carousel-items'] as $key=>$item) {
								$item['active'] = ($key == 0) ? ' active' : '';
								component('carousel-item', $item);
							}
						?>
					</div>
					<?php if($data['has-arrows']) : ?>
						<a class="carousel-control-prev" href="javascript:;" data-target="#<?=$data['carousel-id'];?>" role="button" data-slide="prev">
          		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
          		<span class="sr-only">Previous</span>
        		</a>
        		<a class="carousel-control-next" href="javascript:;" data-target="#<?=$data['carousel-id'];?>" role="button" data-slide="next">
          		<span class="carousel-control-next-icon" aria-hidden="true"></span>
          		<span class="sr-only">Next</span>
        		</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>