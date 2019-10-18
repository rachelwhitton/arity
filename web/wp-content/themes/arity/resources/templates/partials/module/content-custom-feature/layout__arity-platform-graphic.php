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

$block_content = array();
$i = 1;
if(!empty($data['arity-platform_build-content-blocks'])) :
  foreach($data['arity-platform_build-content-blocks'] as $data_1) :
    $block_content['block_' . $i] = array();
    foreach($data_1['content-custom-feature__add-content-sections'] as $data_2) :
      $block_content['block_' . $i]['eyebrow'] = $data_2['arity-platform__block-eyebrow'];
      $block_content['block_' . $i]['headline'] = $data_2['arity-platform__block-headline'];
      $block_content['block_' . $i]['body_copy'] = $data_2['arity-platform__block-body-copy'];
      $i++;
    endforeach;
  endforeach;
endif;

?>

<style type="text/css">
  .mobile-scroll-content {
    padding: 32px 15px;
    opacity: 0.9;
  }
  .mobile-scroll-spacer {
    height: 100vh;
    background-color: #ff0000;
    opacity: 0.25;
  }
  #mobile-scroll-element-1 {
    position: absolute;
    top: -20px;
  }
  #mobile-scroll-element-2 {
    position: absolute;
    height: 100vh;
    top: calc(100vh - 78px);
  }
  #mobile-scroll-element-3 {
    position: absolute;
    height: 100vh;
    top: calc(300vh - 78px);
  }
  #mobile-scroll-element-4 {
    position: relative;
    height: 100vh;
    top: calc(500vh - 78px);

  }
  #custom-feature__arity-platform-graphic {
    background-color: <?=$navy;?>;
    color: <?=$white;?>;
  }
  .arity-platform__section-headline {
    font-size: 1.875rem;
    color: <?=$white;?>;
    margin: 0;
    padding: 0;
  }
  .arity-platform__img-col {
    width: 100%;
  }
  .arity-platform__img-col-container {
    width: 100%;
    padding-top: 9rem;
    padding-right: 15px;
    padding-bottom: 30vh;
    padding-left: 15px;
  }
  .arity-platform__content-col {
    display: none;
  }
  .arity-platform__content-col-container {
    width: 100%;
    padding-left: 15px;
    padding-right: 15px;
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
  .arity-platform__no-bottom-margin {
    margin-bottom: 0;
  }
  #arity-platform-graphic__static {}

  @media (min-width: 768px) {
    #custom-feature__arity-platform-graphic {
      padding-top: 6rem;
      padding-bottom: 6rem;
    }
    .arity-platform__img-col {
      display: flex;
      -ms-flex: 0 0 58.33333%;
      flex: 0 0 58.33333%;
      max-width: 58.3333%;
      align-items: center;
      justify-content: start;
    }
    .arity-platform__img-col-container {
      display: block;
      width: 75%;
    }
    .arity-platform__content-col {
      display: flex;
      -ms-flex: 0 0 41.6667%;
      flex: 0 0 41.6667%;
      max-width: 41.6667%;
      align-items: center;
      justify-content: start;
    }
    .arity-platform__section-headline {
      margin: 0 0 3rem 0;
      padding: 0;
    }
    .mobile-scroll-content {
      display: none;
    }
  }

  @media (min-width: 961px) {
    .arity-platform__img-col {
      padding-left: 0.9375rem;
      padding-right: 0.9375rem;
      align-items: center;
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

<div id="mobile-scroll-element-1" class="mobile-scroll-content colors__bg--teal">
  <div class="container">
    <div class="row">
      <h2 class="col-12 arity-platform__section-headline"><?=$data['arity-platform_section-headline'];?></h2>
    </div>
  </div>
</div>

<div id="mobile-scroll-element-2" class="mobile-scroll-content colors__bg--teal">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="eyebrow type5 ar-element arity-platform__block-eyebrow"><?=$block_content['block_1']['eyebrow'];?></h3>
        <h2 class="type3 arity-platform__block-headline"><?=$block_content['block_1']['headline'];?></h2>
        <p class="arity-platform__block-body-copy arity-platform__no-bottom-margin"><?=$block_content['block_1']['body_copy'];?></p>
      </div>
    </div>
  </div>
</div>

<div id="mobile-scroll-element-3" class="mobile-scroll-content colors__bg--teal">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="eyebrow type5 ar-element arity-platform__block-eyebrow"><?=$block_content['block_2']['eyebrow'];?></h3>
        <h2 class="type3 arity-platform__block-headline"><?=$block_content['block_2']['headline'];?></h2>
        <p class="arity-platform__block-body-copy arity-platform__no-bottom-margin"><?=$block_content['block_2']['body_copy'];?></p>
      </div>
    </div>
  </div>
</div>

<div id="mobile-scroll-element-4" class="mobile-scroll-content colors__bg--teal">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="eyebrow type5 ar-element arity-platform__block-eyebrow"><?=$block_content['block_3']['eyebrow'];?></h3>
        <h2 class="type3 arity-platform__block-headline"><?=$block_content['block_3']['headline'];?></h2>
        <p class="arity-platform__block-body-copy arity-platform__no-bottom-margin"><?=$block_content['block_3']['body_copy'];?></p>
      </div>
    </div>
  </div>
</div>
