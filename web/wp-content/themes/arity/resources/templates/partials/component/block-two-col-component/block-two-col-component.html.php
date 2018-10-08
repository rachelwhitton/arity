<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Block Two Column Component
  Template Type:      Module
  Description:        Product or feature highlight ("River")
  Last Updated:       10/05/2018
  Since:              2.3.0
*/
  
// echo '<pre>'; print_r($data); echo '</pre>';
// echo 'i am here';

$data['classes'][] = 'block-two-col-component';

if ($data['content-chooser']=='layout__datavis') {
  $data['classes'][] = 'content-datavis-block';
} else {
  $data['classes'][] = 'content-image-block';
}

$class = 'content-image-block';
$color_prefix = 'colors__';

if ($data['content-chooser']=='layout__datavis') {
  $class = 'content-datavis-block';
  if (!empty($data['visualization'])) {
    $ext = pathinfo($data['visualization']['url'], PATHINFO_EXTENSION);
    $newUrl =  str_replace('.'.$ext,'',$data['visualization']['url']);
    $newUrl .= '/index.html'; 
    $iframeUrl = $newUrl;
  }
  if (!empty($data['url-iframe'])) {
    $iframeUrl = $data['url-iframe'];
  }
}

if(!empty($data['shadow'])){
  $data['img-classes'] = 'img-shadow';
}else{
  $data['img-classes'] = '';
}

if ($data['layout'] == 'right') {
  $data['classes'][] = $class . '--right';
} elseif ($data['layout'] == 'left') {
  $data['classes'][] = $class . '--left';
}

if ($data['bkg_color'] && $data['bkg_color'] != 'default') {
  $data['classes'][] = $color_prefix . 'bg--' . $data['bkg_color'];
} 

if (empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

?>

<div <?php component_class($data['classes']); ?>>
  <div class="container">
    <div class="row">
      <?php if (!empty($data['image_id']) && $data['content-chooser'] == "layout__image") : ?>
        <div class="<?=$class?>__col wide-- <?=$class?>__img-box">
          <?php element('image', [
            'id' => $data['image_id'],
            'classes' => $data['img-classes']
          ]); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($data['url']) && $data['content-chooser'] == "layout__video") : ?>
        <div class="<?=$class?>__col wide-- <?=$class?>__video-box">
          <figure class="video-wrapper">
            <?php the_video($data['url']); ?>
          </figure>
        </div>
      <?php endif; ?>
      <?php if ((!empty($data['url-iframe']) || !empty($data['visualization'])) && $data['content-chooser'] == "layout__datavis") : ?>
        <div class="<?=$class?>__col wide-- <?=$class?>__img-box">
          <iframe class="dataVis" style="border: 0px solid transparent; width:100%; height:<?=$data['url-height-xlarge']?>px" 
                  src="<?=$iframeUrl?>"
                  data-height-xlarge="<?=$data['url-height-xlarge']?>"
                  data-height-large="<?=$data['url-height-large']?>"
                  data-height-medium="<?=$data['url-height-medium']?>"
                  data-height-small="<?=$data['url-height-small']?>"
          ></iframe>
        </div>
      <?php endif; ?>
      <div class="<?=$class?>__col narrow--">
        <div class="<?=$class?>__col-group">
          <?php if (!empty($data['headline'])) : ?>
            <<?= $data['h_el']; ?> class="<?=$class?>__headline type3"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
          <?php endif; ?>
          <?php if (!empty($data['body_copy'])) : ?>
          <div class="content-image-block__content type0">
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
