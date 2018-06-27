<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Content and Image Block
  Template Type:      Module
  Description:        Product or feature highlight ("River")
  Last Updated:       08/01/2017
  Since:              1.0.0
*/
?>

<div <?php module_class($data['classes']); ?>>
  <?php if (!empty($data['module-headline'])) : ?>
    <div class="container module-intro">
      <div class="row">
        <div class="<?= $data['headline-alignment']; ?>">
          <?php if(!empty($data['eyebrow'])) : ?>
            <?php element('eyebrow', array(
              'classes' => 'eyebrow',
              'label' => $data['eyebrow']
            )); ?>
          <?php endif; ?>

          <?php if (!empty($data['module-headline'])) : ?>
            <?php element('headline', array(
            'classes' => 'content-image-block__title',
            'headline' => $data['module-headline']
          )); ?>
          <?php endif; ?>

          <?php if(!empty($data['subhead'])) : ?>
            <div class="block-highlights__subhead">
              <?= $data['subhead']; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <?php if (!empty($data['image_id']) && $data['content-chooser'] == "layout__image") : ?>
        <div class="content-image-block__col wide-- content-image-block__img-box">
          <?php element('image', [
            'id' => $data['image_id'],
            'classes' => $data['img-classes']
          ]); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($data['url']) && $data['content-chooser'] == "layout__video") : ?>
        <div class="content-image-block__col wide-- content-image-block__video-box">
          <figure class="video-wrapper">
            <?php the_video($data['url']); ?>
          </figure>
        </div>
      <?php endif; ?>
      <div class="content-image-block__col narrow--">
        <div class="content-image-block__col-group">
          <?php if (!empty($data['headline'])) : ?>
            <<?= $data['h_el']; ?> class="content-image-block__headline type3"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
          <?php endif; ?>
          <?php if (!empty($data['body_copy'])) : ?>
          <div class="type0">
            <?= apply_filters('the_content', $data['body_copy']); ?>
          </div>
          <?php endif; ?>
          <?php
            if (!empty($data['link_groups'])) :
          ?>
            <div class="buttons">
            <?php $i=0; foreach ($data['link_groups'] as $cta) : $i++; if(empty($cta['group']['cta__link'])) continue; ?>
              <?php
                $cta = $cta['group'];
                if ($cta['cta__type'] == 'link'){
                  $classes = 'button block_link';

                  if ($cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'arrow-right';
                  }

                  if((isLinkEmail($cta['cta__link']['url']) || ($cta['cta__icon_link'] == "mailto")) && ($cta['cta__icon_link'] != 'none')) {
                    $cta['cta__link']['icon'] = 'email';
                  }

                  if(($cta['cta__icon_link'] == "download") && $cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'download';
                  }

                  if(($cta['cta__icon_link'] == "external") && $cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'external';
                  }
                }else{
                  $classes = 'button button--primary blue-button-- blue-hover-border';

                  if(isLinkEmail($cta['cta__link']['url']) || $cta['cta__icon_button'] == "mailto" && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'email';
                  }

                  if(($cta['cta__icon_button'] == "download") && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'download';
                  }

                  if(($cta['cta__icon_button'] == "external") && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'external';
                  }
                }
              ?>
              <p>
                <?php $cta['cta__link']['analytics'] = $data['headline']; ?>
                <?php element('button', array_merge($cta['cta__link'], [
                  'classes' => $classes
                ])); ?>
              </p>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>
