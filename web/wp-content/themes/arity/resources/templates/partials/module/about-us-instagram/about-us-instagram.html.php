<?php
namespace App\Theme;

?>

<?php
/*
  Template Name:      About Us Instagram
  Template Type:      Module
  Description:        Module to manually showcase #WeAreArityWednesday Instagram posts
  Last Updated:       06/07/2019
  Since:              2.3.1
*/

// echo '<pre>'; print_r($data); echo '</pre>';

?>

<style>
.footnote {
	background-color: #63727E;
	color: #fff;
	font-size: 14px;
	height: 150px;
}

.ar-module__about-us-instagram .footnote .container {
	height: 100%;
}
</style>

<div <?php module_class($data['classes']); ?>>
	<div class="container-fluid">
		<div class="row justify-content-center">
		  <div class="col-12 about-us-instagram">
		  	<div class="row no-gutters">


					<div class="instagram-unit instagram-unit__anchor colors__bg--navy col-md-6 col-lg-4 col-12">
						<div class="instagram-unit__anchor-inner">
							<h2 class="colors__text--white"><?=$data['anchor-text'];?></h2>
							
						
							<div class="buttons">
								<p>
									<a href="https://www.instagram.com/arityofficial/?hl=en" class="button button--primary navy-button-- yellow-hover-border has-icon-- ar-element">
										<span class="button__icon"><svg class="icon-svg" title="" role="img"><use xlink:href="#external"></use></svg></span>
										<span class="button__label">Follow us @arityofficial</span>
									</a>
								</p>
							</div>
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

