<?php
/*
  Layout Name:				About Us Instagram
  Description:        Custom layout for the About Us page
  Last Updated:       06/06/2019
  Since:              2.3.1
*/

	$base_url = 'https://www.arity.com/wp-content/uploads/2019/06/';
	$instagram_data = array(
		array('filename' => NULL, 'alt_text' => NULL),
		array('filename' => '1080x1080_2019-05-07_amy-johnson.jpg', 'alt_text' => 'Amy Johnson - Arity is UX Design'),
		array('filename' => '1080x1080_2019-04-24_tanner-clarke.jpg', 'alt_text' => 'Tanner Clarke - Arity is Marketing'),
		array('filename' => '1080x1080_2019-04-17_ken-erebholo.jpg', 'alt_text' => 'Ken Erebholo - Arity is Data Science and Analytics'),
		array('filename' => '1080x1080_2019-04-03_mel-hanna.jpg', 'alt_text' => 'Melanie Hanna - Arity is Data Science and Analytics'),
		array('filename' => '1080x1080_2019-03-27_dipti-karmarkar.gif', 'alt_text' => 'Dipti Karmarkar - Arity is Data Science')
);

?>

<style>
	#custom-feature__about-us-instagram {
		margin-top: 0 !important;
	}
	.about-us-instagram {
		max-width: 1200px;
		padding: 0 !important;
	}
	.instagram-unit.instagram-unit__anchor h2 {
		font-size: 1.5rem;
		margin: 0 0 48px 0;
	}
	.instagram-unit__anchor-inner {
		width: 100%;
		padding: 48px;
	}
	.instagram-unit__image {
		line-height: 0;
		font-size: 0;
	}
	@media screen and (min-width: 768px) {
  	.instagram-unit.instagram-unit__anchor h2 {
  		font-size: 1.875rem;
  	}
  }
  @media screen and (min-width: 1200px) {
  	.instagram-unit.instagram-unit__anchor h2 {
  		font-size: 1.875rem;
  	}
  }
</style>

<div id="custom-feature__about-us-instagram" class="ar-module__no-margin ar-module">
	<div class="container-fluid">
		<div class="row justify-content-center">
		  <div class="col-12 about-us-instagram">
		  	<div class="row no-gutters">


					<div class="instagram-unit instagram-unit__anchor colors__bg--navy col-md-6 col-lg-4 col-12">
						<div class="instagram-unit__anchor-inner">
							<h2 class="colors__text--white">See what the data-day looks like at Arity<br>#WeAreArityWednesday</h2>
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
					$i = 0;
					foreach ($instagram_data as $data) :
					if ($data['filename'] == null) {
						$i++;
						continue;
						}
					?> 	
					<div class="instagram-unit instagram-unit__image col-md-6 col-lg-4 col-12"><img src="<?=$base_url.$data['filename'];?>" width="100%" alt="<?=$base_url.$data['alt_text'];?>"></div>
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
</div>