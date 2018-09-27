<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Feature Content
  Template Type:      Component
  Description:        Eyebrow, Headline, Copy, CTA Stack
  Last Updated:       08/01/2017
  Since:              1.0.0
*/
?>
<div <?php component_class('feature-content'); ?>>
  <div class="row">
    <div class="feature-content__subcol">
      <?php element('eyebrow', array(
        'classes' => 'eyebrow--homepage-teal',
        'label' => $data['eyebrow'],
        'h_el' => updateElImportance($data['h_el'], 1)
      )); ?>
      <?php if (!empty($data['headline'])) : ?>
        <?php // @todo This should be an h1 tag for SEO purposes ?>
        <<?= $data['h_el']; ?> class="feature-content__header"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
      <?php endif; ?>
    </div>
  </div>
  <div class="row">
    <div class="feature-content__subcol">
      <?php if (!empty($data['body_copy'])) : ?>
        <div class="type0">
          <?= apply_filters('the_content', $data['body_copy']); ?>
        </div>
      <?php endif; ?>
      <?php
        if (!empty($data['cta'])) :
          $data['cta']['classes'] = 'button--primary';
      ?>
        <p>
          <?php element('button', $data['cta']); ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</div>
