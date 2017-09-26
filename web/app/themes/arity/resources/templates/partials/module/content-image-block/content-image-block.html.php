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
  <div class="container">
    <div class="row">
      <?php if (!empty($data['image_id'])) : ?>
        <div class="content-image-block__col wide-- content-image-block__img-box">
          <?php element('image', [
            'id' => $data['image_id'],
            'classes' => 'img-shadow'
          ]); ?>
        </div>
      <?php endif; ?>
      <div class="content-image-block__col narrow--">
        <div class="content-image-block__col-group">
          <?php if (!empty($data['headline'])) : ?>
            <div class="type3"><?= $data['headline']; ?></div>
          <?php endif; ?>
          <?php if (!empty($data['body_copy'])) : ?>
          <div class="type4">
            <?= apply_filters('the_content', $data['body_copy']); ?>
          </div>
          <?php endif; ?>
          <?php if (!empty($data['cta'])) : ?>
          <p>
            <?php element('button', array_merge($data['cta'], [
              'classes' => 'blue-link content-image-block__arrow-link' ,
              'icon' => 'arrow-right'
            ])); ?>
          </p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
