<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Action Bar
  Template Type:      Module
  Description:        Full width bar with side-by-side links
  Last Updated:       09/15/2017
  Since:              1.0.0
*/

?>
<div <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="action-bar__row">
      <?php if (!empty($data['left_headline']) || !empty($data['left_content'])) : ?>
        <div class="action-bar__left">
          <<?= $data['h_el']; ?> class="action-bar__headline"><?= $data['left_headline']; ?></<?= $data['h_el']; ?>>
          <?= $data['left_content']; ?>
          <?php if (!empty($data['left_cta'])) : ?>
            <div class="show-mobile">
              <p>
                <a class="block_link" href="mailto:<?= $data['left_cta']['url']; ?>"<?php if (!empty($data['left_cta']['target'])) : ?> target="<?= $data['left_cta']['target']; ?>"<?php endif; ?>>
                    <span class="button--circle blue-bg--">
                      <svg class="icon-svg" title="" role="img">
                          <use xlink:href="#email"></use>
                      </svg>
                    </span>
                  <span class="block_link__text"><?= $data['left_cta']['url']; ?></span>
                </a>
              </p>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($data['right_headline']) || !empty($data['right_content'])) : ?>
        <div class="action-bar__center">&nbsp;</div>
        <div class="action-bar__right">
          <<?= $data['h_el']; ?> class="action-bar__headline"><?= $data['right_headline']; ?></<?= $data['h_el']; ?>>
          <?= $data['right_content']; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
