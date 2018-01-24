<?php

namespace App\Theme;
?>

<?php if (!empty($data['posts'])) : ?>
<div class="ar-module blog-promo">
  <div class="row">
      <?php foreach ($data['posts'] as $item) : ?>
        <!-- <div class="blog-promo__col">
          <?php echo get_the_post_thumbnail($item->ID); ?>
          <div class="blog-promo__content">
            <h4><?php echo $item->primary_term; ?></h4>
            <h2><?php echo $item->post_title; ?></h2>
            <?php echo $item->post_excerpt;?>
            <?php echo get_the_date('F Y'); ?>
            <div class="">5 min read</div>
          </div>
    		</div> -->
        <div class="blog-card__col col-4">
          <div class="blog-card__image">
            <?php if (get_the_post_thumbnail($item->ID )) : ?>
                <?php echo get_the_post_thumbnail($item->ID, 'post-thumbnail' ); ?>
            <?php else : ?>
              <div class="blog-card__filler-img"></div>
            <?php endif ?>
          </div>
          <div class="blog-card__inner">
            <div class="blog-card__cat">
              <a href="/insights/category/<?php echo strtolower($item->primary_term) ?>"><?php echo $item->primary_term ?></a>
            </div>
            <h1 class="blog-card__title"><?php echo $item->post_title; ?></h1>
            <div class="blog-card__excerpt">
             <p><?php echo $item->post_excerpt;?></p>
            </div>
            <div class="blog-card__date">
              <?php echo get_the_date('F Y'); ?>
            </div>
            <div class="">5 min read</div>
          </div>
        </div>
      <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
