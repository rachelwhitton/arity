<?php
/*
  Layout Name:			About us rotating headline
  Description:			Custom layout for the About Us page
  Last Updated:			06/18/2019
  Since:						2.3.1
*/

/* ARITY COLORS */
$navy = '#011c2c';
$blue = '#0070d6';
$yellow = '#e2ef1c';
$gray = '#63727e';
$teal = '#009ba3';
$white = '#ffffff';

?>

<style type="text/css">
  #custom-feature__arity-platform-graphic {
    background-color: <?=$navy;?>;
    color: <?=$white;?>;
    padding-top: 6rem;
    padding-bottom: 6rem;
  }
  .arity-platform__section-headline {
    font-size: 1.875rem;
    color: <?=$white;?>;
    text-align: left;
    margin: 0 0 3rem 0;
    padding: 0;
  }
  .arity-platform__img-col {
    display: flex;
    -ms-flex: 0 0 58.33333%;
    flex: 0 0 58.33333%;
    max-width: 58.3333%;
    align-items: center;
    justify-content: center;
  }
  .arity-platform__img-col-container {
    width: 100%;
  }
  #arity-platform-graphic__static {}
  .arity-platform__content-col {
    display: flex;
    -ms-flex: 0 0 41.6667%;
    flex: 0 0 41.6667%;
    max-width: 41.6667%;
    align-items: center;

  }
  .arity-platform__block-eyebrow {
    color: <?=$yellow;?>;
  }
  .arity-platform__block-headline {
    font-size: 1.3125rem;
    font-weight: 600;
    color: <?=$white;?>;
    margin: 0 0 0.75rem 0;
  }
  .arity-platform__block-body-copy {
    font-size: 1.0625rem;
    line-height: 1.3125;
    color: <?=$white;?>;
    margin: 0 0 3rem 0;
  }
  @media (min-width: 768px) {
    .arity-platform__img-col {
      justify-content: left;
    }
    .arity-platform__img-col-container {
      display: block;
      width: 75%;
    }
  }
  @media (min-width: 961px) {
    .arity-platform__img-col {
      padding-left: 0.9375rem;
      padding-right: 0.9375rem;
      justify-content: center;
    }
    .arity-platform__img-col-container {
      width: 60%;
    }
    .arity-platform__content-col {
      padding-left: 0.9375rem;
      padding-right: 0.9375rem;
    }
  }
  @media (min-width: 1200px) {
    .arity-platform__img-col {
      padding-left: 0.9375rem;
      padding-right: 0.9375rem;
    }
    .arity-platform__content-col {
      padding-left: 0.9375rem;
      padding-right: 0.9375rem;
    }
  }
</style>

<div id="custom-feature__arity-platform-graphic">
	<div class="container">
		<div class="row">
      <div class="arity-platform__img-col">
        <div class="arity-platform__img-col-container">
          <?php
            get_template_part('dist/arity', 'platform-graphic-static.svg');
          ?>
        </div>
      </div>
      <div class="arity-platform__content-col">
        <div class="arity-platform__content-col-container">
          <h2 class="arity-platform__section-headline"><?=$data['arity-platform_section-headline'];?></h2>
          <?php
          if(!empty($data['arity-platform_build-content-blocks'])) :
            foreach($data['arity-platform_build-content-blocks'] as $data_1) :
              foreach($data_1['content-custom-feature__add-content-sections'] as $data_2) : ?>
                <h3 class="eyebrow type5 ar-element arity-platform__block-eyebrow"><?=$data_2['arity-platform__block-eyebrow'];?></h3>
                <h2 class="type3 arity-platform__block-headline"><?=$data_2['arity-platform__block-headline'];?></h2>
                <p class="arity-platform__block-body-copy"><?=$data_2['arity-platform__block-body-copy'];?></p>
              <?php endforeach;
            endforeach;
          endif;
          ?>
        </div>
      </div>
    </div>
	</div>
</div>
