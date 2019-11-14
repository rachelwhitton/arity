<?php
namespace App\Theme;

/*
  Template Name:      Block Highlights
  Template Type:      Module
  Description:        List of highlights
  Last Updated:       10/24/2019
  Since:              2.3.1
*/

// echo '<pre>' . PHP_EOL;
// var_dump($data);
// echo '</pre>' . PHP_EOL;
// echo '<br>' . PHP_EOL;

?>
<div <?php module_class($data['classes']); ?> >
  <?php if (!empty($data['headline'])) : ?>
    <div class="container">
      <div class="row">
        <div class="block-highlights__header anim-ready">
          <?php if(!empty($data['eyebrow'])) : ?>
            <?php element('eyebrow', array(
              'classes' => 'eyebrow',
              'label' => $data['eyebrow']
            )); ?>
          <?php endif; ?>

          <?php if (!empty($data['headline'])) : ?>
            <?php element('headline', array(
            'classes' => 'block-highlights__title',
            'headline' => $data['headline']
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
      <?php
        $blockCount = 0;
        $classes = 'col-md-6';
        $count = 0;

        foreach ( $data['highlight-block'] as $block ) {
          $blockCount++;
        }

        switch ($blockCount) {
          case 2:
            $classes = "col-md-6";
            break;
          case 3:
            $classes = "col-md-4";
            break;
          case 4:
            $classes = "col-md-6 col-lg-3";
            break;
          case 5:
            $classes = "col-md-4";
            break;
          case 6:
            $classes = "col-md-4";
            break;
          case 7:
            $classes = "col-md-6 col-lg-3";
            break;
          case 8:
            $classes = "col-md-4 col-lg-3";
            break;
          default:
            $classes = "col-md-6";
            break;
        }
        $alignment = $data['block-alignment'] == 'left-align' ? ' ' . $data['block-alignment'] : '';
        $classes .= $alignment;
      ?>
      <?php foreach ($data['highlight-block'] as $block) : ?>
        <?php $block['component__highlight-block']['highlight-block__classes'] = $data['highlights-classes']; ?>
        <?php $count++; ?>
        <div class="block-highlights__col anim-ready anim-block-<?=$count;?> <?=$classes;?>">
          <?php the_partial($block); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</div>
