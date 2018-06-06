<?php

namespace App\Theme;
?>

<div class="blog-author blog-post__author-inner">
  <div class="avatar_col">
    <?php if(is_int ($data['display_image'])) : ?>
      <?php element('image', [
        'id' => $data['display_image'],
        'classes' => 'avatar'
      ]); ?>
    <?php else: ?>
      <?= $data['display_image']; ?>
    <?php endif; ?>
  </div>
  <div class="blog-post__author-info">
    <span class="author-name"><?= $data['author-name']; ?> </span>

    <?php if(!empty($data['twitter'])) : ?>
      <a class="author-twitter" target="_blank" href="https://twitter.com/<?= $data['twitter']; ?>">@<?= $data['twitter']; ?></a>
    <?php endif; ?>

    <?php if(!empty($data['description'])) : ?>
      <div class="author-description">
        <?= $data['description'];?>
      </div>
    <?php endif; ?>
  </div>
</div>
