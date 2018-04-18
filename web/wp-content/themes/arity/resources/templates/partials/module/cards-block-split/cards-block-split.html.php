<?php
namespace App\Theme;

/*
  Template Name:      Cards Block with Split Background
  Template Type:      Module
  Description:        A row of cards with a split background
  Last Updated:       12/01/2017
  Since:              1.6.4
*/
?>
<div <?php module_class($data['classes']); ?>>
  <?php if (!empty($data['headline'])) : ?>
    <div class="container">
      <div class="row">
        <div class="cards-block-split__header anim-ready">
          <?php if(!empty($data['eyebrow'])) : ?>
            <?php element('eyebrow', array(
              'classes' => 'eyebrow',
              'label' => $data['eyebrow']
            )); ?>
          <?php endif; ?>

          <?php if (!empty($data['headline'])) : ?>
            <?php element('headline', array(
            'classes' => 'cards-block-split__title',
            'headline' => $data['headline']
          )); ?>
          <?php endif; ?>

          <?php if(!empty($data['subhead'])) : ?>
            <div class="cards-block-split__subhead">
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

        foreach ( $data['cards'] as $card ) {
          $blockCount++;
        }

        switch ($blockCount) {
          case 2:
            $classes = "col-lg-6";
            break;
          case 3:
            $classes = "col-lg-4";
            break;
          case 4:
            $classes = "col-lg-6";
            break;
          case 5:
            $classes = "col-lg-4";
            break;
          case 6:
            $classes = "col-lg-4";
            break;
          case 7:
            $classes = "col-lg-6";
            break;
          case 8:
            $classes = "col-lg-6";
            break;
          default:
            $classes = "col-lg-6";
            break;
        }
      ?>

      <?php foreach ($data['cards'] as $card) : ?>
        <?php $count++; ?>
        <div class="cards-block-split__col anim-ready anim-block-<?php echo $count; ?> <?php echo $classes; ?>">
          <?php the_partial($card); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php if($data['--settings_alignment']=="layout__half-bg") : ?>
    <div <?php module_class($data['bottom-classes']); ?>></div>
  <?php endif; ?>
</div>
