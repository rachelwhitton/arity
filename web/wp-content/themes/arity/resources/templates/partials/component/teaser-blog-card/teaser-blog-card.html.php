<?php

namespace App\Theme;
?>

<div class="module teaser-blog-card anim-ready">
  <div class="row">
  <div class="teaser-blog-card__col">
    <div class="teaser-blog-card__inner">
      <?php if(!empty($data['featured'])) : ?>
        <?php element('eyebrow', array(
          'classes' => 'eyebrow',
          'label' => 'Featured'
        )); ?>
      <?php endif; ?>
      <a class="teaser-blog-card__link" href="<?php echo get_permalink(); ?>">
        <?php the_title( '<h2 class="teaser-blog-card__title">', '</h2>' ); ?>
      </a>
      <div class="teaser-blog-card__excerpt">
       <?php // the_excerpt(); ?>
       <?php

          $abstract = get_field('abstract');
          echo $abstract;
          ?>
      </div>
      <div class="teaser-blog-card__stats">
        <div class="teaser-blog-card__date">
          <?php echo get_the_date(); ?>
        </div>
        <div class="teaser-blog-card__read"><?= do_shortcode('[ttr]'); ?></div>
      </div>
    </div>
  </div>
  <div class="teaser-blog-card__button-col">
    <?php
      $data['cta']['classes'] = array('button--primary', 'white-blue-button--');
      $data['cta']['title'] = "Read more";
      $data['cta']['url'] = get_permalink();
      element('button', $data['cta']);
    ?>
  </div>
  </div>
</div>
