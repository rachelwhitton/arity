<?php
namespace App\Theme;

?>
<?php
/*
Template Name:      Feature Solution
Template Type:      Component
Description:        Eyebrown, Headline, Copy, CTA Stack
Last Updated:       08/01/2017
Since:              1.0.0
*/

?>
<div <?php component_class('feature-solution'); ?>>
  <div class="feature-solution__inner">
    <div class="feature-solution__top">
      <?php if (!empty($data['eyebrow'])) : ?>
        <?php element('eyebrow', [
          'label' => $data['eyebrow'],
          'h_el' => $data['h_el']
        ]); ?>
      <?php endif; ?>
      <?php if (!empty($data['image_id'])) : ?>
        <?php element('image', [
          'classes' => 'feature-solution__icon',
          'id' => $data['image_id']
        ]); ?>
      <?php endif; ?>
      <?php if (!empty($data['headline'])) : ?>
        <<?= updateElImportance($data['h_el'], 1); ?> class="type3 feature-solution__headline"><?= $data['headline']; ?></<?= updateElImportance($data['h_el'], 1); ?>>
      <?php endif; ?>
    </div>

    <?php if (!empty($data['body_copy'])) : ?>
      <div class="feature-solution__p type0">
        <?= apply_filters('the_content', $data['body_copy']); ?>
      </div>
    <?php endif; ?>

    <?php
      if (!empty($data['cta'])) :
        $data['cta']['classes'][] = 'button--primary';
        $data['cta']['classes'][] = 'blue-button--';
        $data['cta']['classes'][] = 'blue-hover-border';
    ?>
      <p>
        <?php element('button', $data['cta']); ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($data['footnote_copy'])) : ?>
      <div class="feature-solution__use-case">
        <?= $data['footnote_copy']; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
