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

  <?php if ($data['animation']) : ?>
    <ul id="loader">
      <li></li><li></li><li></li><li></li><li></li>
      <li></li><li></li><li></li><li></li><li></li>
      <li></li><li></li><li></li><li></li><li></li>
      <li></li><li></li><li></li><li></li><li></li>
    </ul>
  <?php endif; ?>

  <div class="container">
    <div class="row">
      <div class="hero-e__col anim-ready left--">
        <<?= $data['h_el']; ?> class="type2 hero-e__title"><?= $data['headline']; ?></<?= $data['h_el']; ?>>

        <?php if (!empty($data['image_id'])) : ?>
          <div class="hero-e__image--mobile">
            <?php element('image', [
              'id' => $data['image_id']
            ]); ?>
          </div>
        <?php endif; ?>

        <div class="hero-e__content type0"><?= apply_filters('the_content', $data['body_copy']); ?></div>
        <?php if (!empty($data['cta']) || !empty($data['cta-2'])) : ?>
          <p>
            <?php if (!empty($data['cta'])) : ?>
              <span class="button-wrapper">
                <?php
                  $data['cta']['classes'] = array('button--primary', 'blue-button--');
                  element('button', $data['cta']);
                ?>
              </span>
            <?php endif; ?>
            <?php if (!empty($data['cta-2'])) : ?>
              <span class="button-wrapper">
                <?php
                  $data['cta-2']['classes'] = array('button--primary', 'blue-button--');
                  element('button', $data['cta-2']);
                ?>
              </span>
            <?php endif; ?>
          </p>
        <?php endif; ?>
      </div>
      <?php if (!empty($data['image_id'])) : ?>
        <div class="hero-e__col right-- hero-e__image">
          <?php element('image', [
            'id' => $data['image_id']
          ]); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
