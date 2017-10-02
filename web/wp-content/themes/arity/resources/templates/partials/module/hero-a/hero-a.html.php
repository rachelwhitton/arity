<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Hero A - No Image
  Template Type:      Module
  Description:        Hero module with wo inline image.
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="row">
      <div class="hero-a__col left--">
        <div class="type2 hero-a__title"><?= $data['headline']; ?></div>
        <div class="hero-a__content type6"><?= apply_filters('the_content', $data['body_copy']); ?></div>
        <?php if (!empty($data['cta'])) : ?>
          <?php
            $data['cta']['classes'] = array('button--primary', 'blue-button--', 'scroll-to-form--');
            element('button', $data['cta']);
          ?>
        <?php endif; ?>
      </div>
      <?php if (!empty($data['image_id'])) : ?>
        <div class="hero-a__col right-- hero-a__image">
          <?php element('image', [
            'id' => $data['image_id']
          ]); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>