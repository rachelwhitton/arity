<?php
namespace App\Theme;

/*
  Template Name:      Horizontal Card with Split Background
  Template Type:      Module
  Description:        A horizontal 2 col card with a split background
  Last Updated:       06/12/2018
  Since:              2.2.1
*/
// echo '<pre>';print_r($data);echo '</pre>';
?>
<div <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="row">

      <div class="card card--horizontal-split promo-card-horizontal__col">
        <div class="card__inner">
          <?php if (!empty($data['image_id'])) : ?>
            <div class="card__top">
              <?php template('partials/element/image/image', array(
                'id' => $data['image_id']
              )); ?>
              <?php if(!empty($data['bkg_image'])) : ?>
                <div class="promo-card-horizontal__bkg" style="background-image:url('<?= $data['bkg_image']; ?>');"></div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <div class="card__bottom">
            <?php if (!empty($data['headline'])) : ?>
              <?php element('headline', array(
              'classes' => 'promo-card-horizontal__title',
              'headline' => $data['headline']
            )); ?>
            <?php endif; ?>

            <?php if (!empty($data['location'])) : ?>
              <div class="promo-card-horizontal__subhead">
                <?= $data['location']; ?>
              </div>
            <?php endif; ?>

            <?php if(!empty($data['body-copy'])) : ?>
              <div class="promo-card-horizontal__body-copy">
                <?= $data['body-copy']; ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($data['cta'])) : ?>
                <?php
                  $data['cta']['classes'] = array('button--link');
                  if(!empty($data['cta']['target'])) {
                    $data['cta']['icon'] = 'external';
                  }else{
                    $data['cta']['icon'] = 'arrow-right';
                  }
                  element('button', $data['cta']);
                ?>
            <?php endif; ?>

            <?php 
              for($i=0; $i<sizeof($data['custom-cta__link_groups']); $i++){ 
                $data['cta']['title']= $data['custom-cta__link_groups'][$i]['group']['cta__link']['title'];
                $data['cta']['url']= $data['custom-cta__link_groups'][$i]['group']['cta__link']['url'];
                $data['cta']['target']= $data['custom-cta__link_groups'][$i]['group']['cta__link']['target'];
                
              ?>
              <?php if (!empty($data['cta'])) : ?>
                <?php
                    if ($data['custom-cta__link_groups'][$i]['group']['cta__type']=='link'){
                      $data['cta']['classes'] = 'button block_link';
                      $data['cta']['icon']= $data['custom-cta__link_groups'][$i]['group']['cta__icon_link'];
                    }else{
                      $data['cta']['classes'] = 'button--primary blue-hover-border blue-button--';
                      $data['cta']['icon']= $data['custom-cta__link_groups'][$i]['group']['cta__icon_button'];
                    }
                    
                    //echo $i.'type: '.$data['link_groups'][$i]['group']['cta__type'];
                ?>
                  <p>
                    <?php element('button', $data['cta']); ?>
                  </p>
              <?php endif; ?>
          <?php } ?> 

            <div class="promo-card-horizontal__ctas">
              <?php
                if (!empty($data['link_groups'])) :
              ?>
              <?php $i=0; foreach ($data['link_groups'] as $cta) : $i++; if(empty($cta['group']['link'])) continue; ?>
                <?php
                  if ($cta['group']['type'] == 'link'){
                    $a_classes = 'button button--link';
                    $b_classes = 'block_link__text';
                  }else{
                    $a_classes = 'button button--primary blue-button--';
                    $b_classes = '__text';
                  }

                  if (($cta['group']['type'] == 'button') && ($cta['group']['icon'] != 'none')) {
                    $a_classes .= ' has-icon--';
                  }

                  if(isLinkEmail($cta['group']['link']['url']) || $cta['group']['icon'] == "mailto") {
                    $cta['group']['icon'] = 'email';
                  }

                  if (($cta['group']['icon'] != 'external') && ($cta['group']['type'] == 'link')) {
                    $c_classes = 'button__icon';
                  }else{
                    $c_classes = 'button__icon';
                  }

                  if ($cta['group']['type'] == 'link' && $cta['group']['icon'] == 'default'){
                    $cta['group']['icon'] = 'arrow-right';
                  }

                  // if (($cta['group']['icon'] != 'none') && ($cta['group']['icon'] != 'external') && ($cta['group']['icon'] != 'link')) {
                  //   $a_classes .= ' block_link__icon';
                  // }
                ?>
                <p>
                  <a class="<?= $a_classes;?>" href="<?= $cta['group']['link']['url']; ?>"<?php if (!empty($cta['group']['link']['target'])) : ?> target="<?= $cta['group']['link']['target']; ?>"<?php endif; ?>>
                    <?php if($cta['group']['icon'] !='none') : ?>
                      <span class="<?= $c_classes;?>">
                        <svg class="icon-svg" title="" role="img">
                            <use xlink:href="#<?= $cta['group']['icon']; ?>"></use>
                        </svg>
                      </span>
                    <?php endif; ?>
                    <span class="<?= $b_classes;?>"><?= $cta['group']['link']['title']; ?></span>
                  </a>
                </p>
              <?php endforeach; ?>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <?php if($data['--settings_alignment']=="layout__half-bg") : ?>
    <div <?php module_class($data['bottom-classes']); ?>></div>
  <?php endif; ?>
</div>
