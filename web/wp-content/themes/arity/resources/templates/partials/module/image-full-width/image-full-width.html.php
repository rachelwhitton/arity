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
$data['classes'][] = 'content-image-block';
$class = 'content-image-block';
$color_prefix = 'colors__';


if(!empty($data['shadow'])){
  $data['img-classes'] = 'img-full-width img-shadow';
}else{
  $data['img-classes'] = 'img-full-width ';
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
            'classes' => $class.'__title',
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
        <div class="wide-- <?=$class?>__img-box">
          <?php element('image', [
            'id' => $data['image_id'],
            'classes' => $data['img-classes']
          ]); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
