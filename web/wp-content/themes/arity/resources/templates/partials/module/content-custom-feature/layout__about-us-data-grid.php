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
		'stat' => '300',
		'stat_color' => '#b096f8',
		'label' => 'employees'
	),
'grid_unit_2' => array(
		'stat' => '3',
		'stat_color' => '#4fa3f3',
		'label' => 'locations'
	),
'grid_unit_3' => array(
		'stat' => '17',
		'stat_color' => '#e2ef1c',
		'label' => 'neighborhoods'
	),
'grid_unit_4' => array(
		'stat' => '40',
		'stat_color' => '#009ba3',
		'label' => 'cat parents'
	),
'grid_unit_5' => array(
		'stat' => '163',
		'stat_color' => '#009ba3',
		'label' => 'CTA commuters'
	),
'grid_unit_6' => array(
		'stat' => '24',
		'stat_color' => '#e2ef1c',
		'label' => 'marathon runners'
	),
'grid_unit_7' => array(
		'stat' => '13',
		'stat_color' => '#b096f8',
		'label' => 'cyclists'
	),
'grid_unit_8' => array(
		'stat' => '4',
		'stat_color' => '#4fa3f3',
		'label' => 'skaters'
	),
);

?>

<style>
	#custom-feature__about-us-data-grid {
		margin-top: -188px; /* -96px - 92px */
		z-index: 100;
	}
	.about-us-data-grid {
		background-color: #011c2c;
		padding: 60px 57px; /* 42 + 15 = 57px */
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
		font-size: 3rem;
		color: #ffffff;
		text-align: center;
		line-height: 0.6375;
		margin: 54px 0 24px 0;
	}
	.data-grid-unit p {
		font-weight: 700;
		color: #ffffff;
		font-size: 0.875rem;
		text-align: center;
		margin: 0;
	}
	.data-grid-unit h2.top-row-data-sm {
		margin-top: 0;
	}
	@media screen and (min-width: 768px) {
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
		.about-us-data-grid {
			padding: 60px 57px;
		}
		.data-grid-unit {
			height: 140px;
		}
		.data-grid-unit h2 {
			font-size: 4.6875rem;
			margin: 54px 0 24px 0;
		}
		.data-grid-unit p {
			font-size: 1.0625rem;
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
		<div class="col-md-10 col-sm-12 about-us-data-grid">
			<div class="row">

				<div class="data-grid-unit col-md-3 col-sm-6">
					<h2 class="top-row-data-md top-row-data-sm" style="color: <?=$grid_data['grid_unit_1']['stat_color']?>"><?=$grid_data['grid_unit_1']['stat']?></h2>
					<p><?=$grid_data['grid_unit_1']['label']?></p>
				</div>
				<div class="data-grid-unit col-md-3 col-sm-6 right-edge-sm">
					<h2 class="top-row-data-md top-row-data-sm" style="color: <?=$grid_data['grid_unit_2']['stat_color']?>"><?=$grid_data['grid_unit_2']['stat']?></h2>
					<p><?=$grid_data['grid_unit_2']['label']?></p>
				</div>
				<div class="data-grid-unit col-md-3 col-sm-6">
					<h2 class="top-row-data-md" style="color: <?=$grid_data['grid_unit_3']['stat_color']?>"><?=$grid_data['grid_unit_3']['stat']?></h2>
					<p><?=$grid_data['grid_unit_3']['label']?></p>
				</div>
				<div class="data-grid-unit col-md-3 col-sm-6 right-edge-md right-edge-sm">
					<h2 class="top-row-data-md" style="color: <?=$grid_data['grid_unit_4']['stat_color']?>"><?=$grid_data['grid_unit_4']['stat']?></h2>
					<p><?=$grid_data['grid_unit_4']['label']?></p>
				</div>

				<div class="data-grid-unit col-md-3 col-sm-6 bottom-row-md">
					<h2 style="color: <?=$grid_data['grid_unit_5']['stat_color']?>"><?=$grid_data['grid_unit_5']['stat']?></h2>
					<p><?=$grid_data['grid_unit_5']['label']?></p>
				</div>
				<div class="data-grid-unit col-md-3 col-sm-6 bottom-row-md right-edge-sm">
					<h2 style="color: <?=$grid_data['grid_unit_6']['stat_color']?>"><?=$grid_data['grid_unit_6']['stat']?></h2>
					<p><?=$grid_data['grid_unit_6']['label']?></p>
				</div>
				<div class="data-grid-unit col-md-3 col-sm-6 bottom-row-sm">
					<h2 style="color: <?=$grid_data['grid_unit_7']['stat_color']?>"><?=$grid_data['grid_unit_7']['stat']?></h2>
					<p><?=$grid_data['grid_unit_7']['label']?></p>
				</div>
				<div class="data-grid-unit col-md-3 col-sm-6 bottom-row-sm right-edge-md right-edge-sm">
					<h2 style="color: <?=$grid_data['grid_unit_8']['stat_color']?>"><?=$grid_data['grid_unit_8']['stat']?></h2>
					<p><?=$grid_data['grid_unit_8']['label']?></p>
				</div>

			</div>
		</div>
	</div>
</div>