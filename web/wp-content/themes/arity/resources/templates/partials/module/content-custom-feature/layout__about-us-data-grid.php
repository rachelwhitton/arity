<?php
/*
  Layout Name:				About Us data grid
  Description:        Custom layout for the About Us page
  Last Updated:       05/28/2019
  Since:              2.3.0
*/

// echo '<pre>'; print_r($data); echo '</pre>';

$grid_data = array(
	'grid_unit_1' => array(
		'stat' => '400',
		'stat_color' => ' purple--',
		'label' => 'employees'
	),
'grid_unit_2' => array(
		'stat' => '3',
		'stat_color' => ' blue--',
		'label' => 'locations'
	),
'grid_unit_3' => array(
		'stat' => '55',
		'stat_color' => ' yellow--',
		'label' => 'Green Team members'
	),
'grid_unit_4' => array(
		'stat' => '10',
		'stat_color' => '',
		'label' => 'patent holders'
	),
'grid_unit_5' => array(
		'stat' => '20',
		'stat_color' => '',
		'label' => 'trivia captains'
	),
'grid_unit_6' => array(
		'stat' => '104',
		'stat_color' => ' yellow--',
		'label' => 'CTA commuters'
	),
'grid_unit_7' => array(
		'stat' => '47',
		'stat_color' => ' purple--',
		'label' => 'cat parents'
	),
'grid_unit_8' => array(
		'stat' => '78',
		'stat_color' => ' blue--',
		'label' => 'dog parents'
	),
);

?>

<style>
	.block-carousel-cont {
		margin-top: 0 !important;
	}
	#custom-feature__about-us-data-grid {
		margin-top: -48px;
		margin-bottom: 48px;
		z-index: 3;
	}
	.about-us-data-grid {
		background-color: #011c2c;
		padding: 32px 16px;
	}
	.data-grid-unit {
		height: 140px;
		border-bottom: 1px solid #d8d8d8;
		border-right: 1px solid #d8d8d8;
	}
	.right-edge-sm {
		border-right: 0;
	}
	.bottom-row-sm {
		border-bottom: 0;
	}
	.bottom-row-md {
		border-bottom: 1px solid #d8d8d8;
	}
	.data-grid-unit h2 {
		font-family: 'Roboto Mono', monospace !important;
		font-weight: 400;
		letter-spacing: -.1875rem;
		font-size: 4rem;
		color: #ffffff;
		text-align: center;
		line-height: 0.6375;
		margin: 28px 0 24px 0;
	}
	.data-grid-unit p {
		font-weight: 700;
		color: #ffffff;
		font-size: 1rem;
		text-align: center;
		margin: 0;
	}
	.data-grid-unit h2.top-row-data-md {
		margin-top: 28px;
	}
	/*
	.data-grid-unit h2.top-row-data-sm {
		margin-top: 0;
	}
	*/

	@media screen and (min-width: 360px) {
		.about-us-data-grid {
			padding: 40px 32px;
		}
		.data-grid-unit h2 {
			font-size: 4.5625rem;
		}
	}

	@media screen and (min-width: 768px) {
		#custom-feature__about-us-data-grid {
			margin-top: -106px;
			margin-bottom: 64px;
		}
		.about-us-data-grid {
			padding: 36px 38px; /* 30 + 15 = 45px */
		}
		.data-grid-unit {
			height: 98px;
		}
		.data-grid-unit h2 {
			font-size: 3rem;
			margin: 40px 0 14px 0;
		}
		.data-grid-unit h2.top-row-data-md {
			margin-top: 0;
		}
		.data-grid-unit p {
			font-size: 0.875rem;
		}
		.bottom-row-md {
			border-bottom: 0;
		}
		.right-edge-sm {
			border-right: 1px solid #d8d8d8;
		}
		.right-edge-md {
			border-right: 0;
		}	
	}
	@media screen and (min-width: 961px) {
		#custom-feature__about-us-data-grid {
			margin-top: -188px; /* -96px - 92px */
			margin-bottom: 64px;
		}
		.about-us-data-grid {
			padding: 60px 57px; /* 42 + 15 = 57px */
		}
		.data-grid-unit {
			height: 140px;
		}
		.data-grid-unit h2 {
			font-size: 4.6875rem;
			margin: 54px 0 24px 0;
		}
		.data-grid-unit p {
			font-size: 1.125rem;
		}
		.data-grid-unit h2.top-row-data-md {
			margin-top: 0;
		}
		.bottom-row-md {
			border-bottom: 0;
		}
		.right-edge-sm {
			border-right: 1px solid #d8d8d8;
		}
		.right-edge-md {
			border-right: 0;
		}	
	}
</style>

<div id="custom-feature__about-us-data-grid" class="container">
	<div class="row justify-content-center">
		<div class="col-md-10 col-12 about-us-data-grid">
			<div class="row no-gutters">

				<div class="data-grid-unit col-md-3 col-6">
					<h2 class="top-row-data-md">
							<span class="product-stats__value<?=$grid_data['grid_unit_1']['stat_color'];?>">
								<span id="product-stats__value_<?=$grid_data['grid_unit_1']['stat'];?>" data-animstart="0" data-animvalue="<?=$grid_data['grid_unit_1']['stat'];?>" data-animdecimal="0">
									<?=$grid_data['grid_unit_1']['stat'];?>
								</span>
						</span>
						</h2>
					<p><?=$grid_data['grid_unit_1']['label'];?></p>
				</div>

				<div class="data-grid-unit col-md-3 col-6 right-edge-sm">
					<h2 class="top-row-data-md">
						<span class="product-stats__value<?=$grid_data['grid_unit_2']['stat_color'];?>">
							<span id="product-stats__value_<?=$grid_data['grid_unit_2']['stat'];?>" data-animstart="0" data-animvalue="<?=$grid_data['grid_unit_2']['stat'];?>" data-animdecimal="0">
								<?=$grid_data['grid_unit_2']['stat'];?>
							</span>
						</span>						
					</h2>
					<p><?=$grid_data['grid_unit_2']['label'];?></p>
				</div>

				<div class="data-grid-unit col-md-3 col-6">
					<h2 class="top-row-data-md">
						<span class="product-stats__value<?=$grid_data['grid_unit_3']['stat_color'];?>">
							<span id="product-stats__value_<?=$grid_data['grid_unit_3']['stat'];?>" data-animstart="0" data-animvalue="<?=$grid_data['grid_unit_3']['stat'];?>" data-animdecimal="0">
								<?=$grid_data['grid_unit_3']['stat'];?>
							</span>
						</span>
					</h2>
					<p><?=$grid_data['grid_unit_3']['label'];?></p>
				</div>

				<div class="data-grid-unit col-md-3 col-6 right-edge-md right-edge-sm">
					<h2 class="top-row-data-md">
						<span class="product-stats__value<?=$grid_data['grid_unit_4']['stat_color'];?>">
							<span id="product-stats__value_<?=$grid_data['grid_unit_4']['stat'];?>" data-animstart="0" data-animvalue="<?=$grid_data['grid_unit_4']['stat'];?>" data-animdecimal="0">
								<?=$grid_data['grid_unit_4']['stat'];?>
							</span>
						</span>
					</h2>
					<p><?=$grid_data['grid_unit_4']['label'];?></p>
				</div>

				<div class="data-grid-unit col-md-3 col-6 bottom-row-md">
					<h2>
						<span class="product-stats__value<?=$grid_data['grid_unit_5']['stat_color'];?>">
							<span id="product-stats__value_<?=$grid_data['grid_unit_5']['stat'];?>" data-animstart="0" data-animvalue="<?=$grid_data['grid_unit_5']['stat'];?>" data-animdecimal="0">
								<?=$grid_data['grid_unit_5']['stat'];?>
							</span>
						</span>
					</h2>
					<p><?=$grid_data['grid_unit_5']['label'];?></p>
				</div>

				<div class="data-grid-unit col-md-3 col-6 bottom-row-md right-edge-sm">
					<h2>
						<span class="product-stats__value<?=$grid_data['grid_unit_6']['stat_color'];?>">
							<span id="product-stats__value_<?=$grid_data['grid_unit_6']['stat'];?>" data-animstart="0" data-animvalue="<?=$grid_data['grid_unit_6']['stat'];?>" data-animdecimal="0">
								<?=$grid_data['grid_unit_6']['stat'];?>
							</span>
						</span>
					</h2>
					<p><?=$grid_data['grid_unit_6']['label'];?></p>
				</div>

				<div class="data-grid-unit col-md-3 col-6 bottom-row-sm">
					<h2>
						<span class="product-stats__value<?=$grid_data['grid_unit_7']['stat_color'];?>">
							<span id="product-stats__value_<?=$grid_data['grid_unit_7']['stat'];?>" data-animstart="0" data-animvalue="<?=$grid_data['grid_unit_7']['stat'];?>" data-animdecimal="0">
								<?=$grid_data['grid_unit_7']['stat'];?>
							</span>
						</span>
					</h2>
					<p><?=$grid_data['grid_unit_7']['label'];?></p>
				</div>

				<div class="data-grid-unit col-md-3 col-6 bottom-row-sm right-edge-md right-edge-sm">
					<h2>
						<span class="product-stats__value<?=$grid_data['grid_unit_8']['stat_color'];?>">
							<span id="product-stats__value_<?=$grid_data['grid_unit_8']['stat'];?>" data-animstart="0" data-animvalue="<?=$grid_data['grid_unit_8']['stat'];?>" data-animdecimal="0">
								<?=$grid_data['grid_unit_8']['stat'];?>
							</span>
						</span>
					</h2>
					<p><?=$grid_data['grid_unit_8']['label'];?></p>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	// var robotoMonoLink = document.createElement('link');
	// robotoMonoLink.href = 'https://fonts.googleapis.com/css?family=Roboto+Mono:100,300,400,500,700';
	// robotoMonoLink.rel = 'stylesheet';
	// document.getElementsByTagName('head')[0].appendChild(robotoMonoLink);
</script>