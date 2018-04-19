<?php
namespace App\Theme;

/*
  Template Name:      Highlight Block
  Template Type:      Component
  Description:        A block of highlight
  Last Updated:       4/20/2018
  Since:              1.6.4
*/

?>

  <div <?php component_class('highlight-block'); ?>>
    <div class="block__inner">
        <?php if ( !empty($data['image_id']) ) : ?>
          <div class="block__icon">
            <?php template('partials/element/image/image', array(
              'id' => $data['image_id']
            )); ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($data['subhead'])) : ?>
          <h3 class="block__title"><?= $data['subhead']; ?></h3>
        <?php endif; ?>

        <?php if (!empty($data['body_copy'])) : ?>
          <?= $data['body_copy']; ?>
        <?php endif; ?>

        <?php if (!empty($data['cta'])) : ?>
          <?php
            $data['cta']['classes'] = array('button', 'button--link', 'arrow-right--');
            $data['cta']['icon'] = 'arrow-right';
            element('button', $data['cta']);
          ?>
        <?php endif; ?>
    </div>
  </div>
