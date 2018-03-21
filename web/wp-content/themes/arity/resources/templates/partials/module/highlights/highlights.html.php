<?php
namespace App\Theme;

/*
  Template Name:      Highlights
  Template Type:      Module
  Description:        List of highlights
  Last Updated:       3/06/2018
  Since:              1.6.4
*/

?>
<div <?php module_class('highlights'); ?> >
  <?php if (!empty($data['headline'])) : ?>
    <div class="container">
      <div class="row">
        <div class="highlights__header anim-ready">
          <?php if(!empty($data['eyebrow'])) : ?>
            <?php element('eyebrow', array(
              'classes' => 'eyebrow',
              'label' => $data['eyebrow']
            )); ?>
          <?php endif; ?>

          <?php if (!empty($data['headline'])) : ?>
            <?php element('headline', array(
            'classes' => 'highlights__title',
            'headline' => $data['headline']
          )); ?>
          <?php endif; ?>

          <?php if(!empty($data['subhead'])) : ?>
            <div class="highlights__subhead">
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
        $break = 2;
        $count = 0;

        foreach ( $data['highlight-block'] as $block ) {
          $blockCount++;
        }

        switch ($blockCount) {
          case 2:
            $classes = "col-md-6";
            $break = 2;
            break;
          case 3: 
            $classes = "col-md-4";
            $break = 3;
            break;
          case 4: 
            $classes = "col-md-6 col-lg-3";
            $break = 4;
            break;
          case 5: 
            $classes = "col-md-4";
            $break = 3;
            break;
          case 6: 
            $classes = "col-md-4";
            $break = 3;
            break;
          case 7: 
            $classes = "col-md-6 col-lg-3";
            $break = 3;
            break;
          case 8: 
            $classes = "col-md-4 col-lg-3";
            $break = 3;
            break;
          default: 
            $classes = "col-md-6";
            $break = 2;
            break;
        }
      ?>
      <?php foreach ($data['highlight-block'] as $block) : ?>
        <?php $count++; ?>
        <div class="highlights__col anim-ready anim-block-<?php echo $count; ?> <?php echo $classes; ?>">
          <?php the_partial($block); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</div>
