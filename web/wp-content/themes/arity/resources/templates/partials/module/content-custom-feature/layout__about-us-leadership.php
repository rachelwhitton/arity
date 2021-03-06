<?php
/*
  Layout Name:				About Us leadership
  Description:        Custom layout for the About Us page
  Last Updated:       05/31/2019
  Since:              2.3.0
*/

// echo '<pre>'; print_r($data); echo '</pre>';

$base_img_url = 'https://www.arity.com/wp-content/uploads/2019/06/';

$leadership_data = array(
	'unit_1' => array(
		'img_url' => $base_img_url . 'leadership_gary-hallgren.png',
		'name' => 'Gary Hallgren',
		'title' => 'President'
	),
	'unit_2' => array(
		'img_url' => $base_img_url . 'leadership_chris-belden.png',
		'name' => 'Chris Belden',
		'title' => 'Customer Success'
	),
	'unit_3' => array(
		'img_url' => $base_img_url . 'leadership_grady-irey.png',
		'name' => 'Grady Irey',
		'title' => 'Analytics'
	),
	'unit_4' => array(
		'img_url' => $base_img_url . 'leadership_emad-issac.png',
		'name' => 'Emad Isaac',
		'title' => 'Engineering'
	),
	'unit_5' => array(
		'img_url' => $base_img_url . 'leadership_lisa-jillson.png',
		'name' => 'Lisa Jillson',
		'title' => 'Marketing, Communications, Research & Design'
	),
	'unit_6' => array(
		'img_url' => $base_img_url . 'leadership_peter-levinson.png',
		'name' => 'Peter Levinson',
		'title' => 'Product'
	),
	'unit_7' => array(
		'img_url' => $base_img_url . 'leadership_larry-rask.png',
		'name' => 'Larry Rask',
		'title' => 'Sales & Business Development'
	),
	'unit_8' => array(
		'img_url' => $base_img_url . 'leadership_dan-regan.png',
		'name' => 'Dan Regan',
		'title' => 'Finance, People & Culture'
	),
	'unit_9' => array(
		'img_url' => $base_img_url . 'leadership_joy-thomas.png',
		'name' => 'Joy Thomas',
		'title' => 'Operational Excellence',
		'last_row' => true
	)
);

?>

<style>
	.about-us__leadership-grid {
		padding: 56px 96px 0px;
	}
	.about-us__leadership-unit {
		padding: 0px 22px 48px;
	}

	.about-us__leadership-img {
		display: block;
		width: 100%;
		margin: auto;
		margin-bottom: 24px;
	}
	.about-us__leadership-name {
		text-align: center;
		font-weight: 700;
		margin: 0 0 6px 0;
	}
	.about-us__leadership-title {
		text-align: center;
		font-weight: 400;
		margin: 0;
		color: #63727e;
	}

	@media screen and (min-width: 768px){
		.about-us__leadership-unit {
			padding-right: 15px;
			padding-left: 15px;
		}	
	}

	@media screen and (min-width: 961px){
		.about-us__leadership-unit {
			padding-right: 40px;
			padding-left: 40px;
		}	
	}

	@media screen and (min-width: 1200px){
		.about-us__leadership-unit {
			padding-right: 70px;
			padding-left: 70px;
		}	
	}

</style>

<div class="body-column body-inset-ten-col body-inset-ten-col__white-bg text-module-standard ar-module">
	<div class="container">
		<div class="row">
			<div class="body-inset-ten-col__col">
				<div class="text-block ar-component">
					<div class="text-block__block layout__center-align">
						<div class="container">
							<h3 class="eyebrow type5 ar-element">Leadership</h3>
							<h3 class="text-block__title ar-element">Meet the team</h3>
							<div class="text-block__text">
								<p>Our leadership team includes dreamers, doers, and decision-makers&mdash;all working together to transform transportation.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container about-us__leadership-grid">
  			<div class="row justify-content-center">
	  			<?php
	  				$i = 1;
					foreach ($leadership_data as $datum) :
				?>
			  	<div class="about-us__leadership-unit col-12 col-md-4">
			  		<img src="<?=$datum['img_url'];?>" alt="<?=$datum['name'];?> - <?=$datum['title'];?>" class="about-us__leadership-img">
					<p class="about-us__leadership-name"><?=$datum['name'];?></p>
	  				<p class="about-us__leadership-title"><?=$datum['title'];?></p>
	  			</div>
		  		
		  		<?php $i++;
	  				endforeach;
				?>

				</div>
			</div>
		</div>
	</div>
</div>