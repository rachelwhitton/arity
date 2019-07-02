<?php
namespace App\Theme;

?>

<?php
/*
  Template Name:      About Us Instagram
  Template Type:      Module
  Description:        Module to manually showcase #WeAreArityWednesday Instagram posts
  Last Updated:       06/27/2019
  Since:              2.3.1
*/

// echo '<pre>'; print_r($data); echo '</pre>';

?>


<div <?php module_class($data['classes']); ?>>
	<div class="container-fluid">
		<div class="row justify-content-center">
		  <div class="col-12 about-us-instagram">
		  	<div class="row no-gutters">
					<div class="instagram-unit instagram-unit__anchor colors__bg--navy col-md-6 col-lg-4 col-12">
						<div class="instagram-unit__anchor-inner">
							<h2 class="colors__text--white"><?=$data['anchor-text'];?></h2>
							<?php
								if (!empty($data['link_groups'])) :
							?>
								<div class="buttons">
								<?php $i=0; foreach ($data['link_groups'] as $cta) : $i++; if(empty($cta['group']['cta__link'])) continue; ?>
								<?php
									$cta = $cta['group'];
									if ($cta['cta__type'] == 'link'){
										$classes = 'button block_link';

										if(($cta['cta__icon_link'] == "external") && $cta['cta__icon_link'] != 'none') {
											$cta['cta__link']['icon'] = 'external';
										}
									}else{
										$classes = 'button button--primary navy-button-- yellow-hover-border has-icon-- ';
										if(($cta['cta__icon_button'] == "external") && $cta['cta__icon_button'] != 'none') {
											$cta['cta__link']['icon'] = 'external';
										}
									}
								?>
								<p>				
									<?php element('button', array_merge($cta['cta__link'], [
									'classes' => $classes
									])); ?>
								</p>
								<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php
					// $i = 0;
					foreach ($data['images'] as $image) :
					// if ($image['filename'] == null) {
					// 	$i++;
					// 	continue;
					// 	}
					?> 	
					<div class="instagram-unit instagram-unit__image col-md-6 col-lg-4 col-12"><img src="<?=wp_get_attachment_url($image['image_id']);?>" width="100%" alt="<?=$image['alt_text'];?>"></div>
					<?php
					if ($i % 3 == 2 && $i < count($instagram_data) - 1) {
						// echo '</div>' . PHP_EOL . '<div class="row no-gutters">' . PHP_EOL;
						} else {
						 // echo '';
						} 
					$i++;
					endforeach; ?>
				</div>
			</div>
		</div> 
	</div>
	<div class="footnote">
		<div class="container">
			<div class="footnote-content row justify-content-center h-100">
				<div class="col align-self-center">
					<p id="allstate-ref"><sup>1</sup> An Allstate estimation</p>
					<p id="nsc-ref"><sup>2</sup> https://www.nsc.org/road-safety/safety-topics/fatality-estimates</p>
					<p id="cnbc-ref"><sup>3</sup> https://www.cnbc.com/2016/08/09/commuters-waste-a-full-week-in-traffic-each-year.html</p>
				</div>
			</div>
		</div>
	</div>
</div>

