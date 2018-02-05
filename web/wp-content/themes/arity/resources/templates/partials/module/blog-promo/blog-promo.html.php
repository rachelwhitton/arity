<?php

namespace App\Theme;
?>

<?php if (!empty($data['posts'])) : ?>
<div class="ar-module blog-promo">
  <div class="row">
      <?php foreach ($data['posts'] as $item) : ?>
        <?php module('blog-card'); ?>
      <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
