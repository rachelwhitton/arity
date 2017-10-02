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
      <?php element('eyebrow', [
        'label' => $data['eyebrow']
      ]); ?>
      <?php if (!empty($data['image_id'])) : ?>
        <?php element('image', [
          'classes' => 'feature-solution__icon',
          'id' => $data['image_id']
        ]); ?>
      <?php endif; ?>
      <?php if (!empty($data['headline'])) : ?>
        <div class="type3 feature-solution__headline"><?= $data['headline']; ?></div>
      <?php endif; ?>
    </div>

    <?php if (!empty($data['body_copy'])) : ?>
      <div class="feature-solution__p type4">
        <?= apply_filters('the_content', $data['body_copy']); ?>
      </div>
    <?php endif; ?>

    <?php
      if (!empty($data['cta'])) :
        $data['cta']['classes'][] = 'button--primary';
        $data['cta']['classes'][] = 'blue-button--';
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