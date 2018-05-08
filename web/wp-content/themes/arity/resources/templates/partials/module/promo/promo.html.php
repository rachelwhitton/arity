<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Promo
  Template Type:      Module
  Description:        Promo CTA
  Last Updated:       08/03/2017
  Since:              1.0.0
*/
?>

<div <?php module_class($data['classes']); ?>>
    <div class="container">
      <div class="row">
        <div class="promo__left-col">
          <div class="promo__header">
            <?php element('headline', array(
              'classes' => 'promo__title',
              'headline' => $data['headline']
            )); ?>
            <?php if (!empty($data['location'])) : ?>
              <?= $data['location']; ?>
            <?php endif; ?>
          </div>
          <div class="promo__text">
           <?= apply_filters('the_content', $data['body_copy']); ?>
          </div>
        </div>
        <div class="promo__right-col">
          <?php
            if (!empty($data['cta'])) {
              $data['cta']['classes'] = array('button button--primary transparent-white-border-button--');
              element('button', $data['cta']);
            }
          ?>
        </div>
      </div>
    </div>
</div>
