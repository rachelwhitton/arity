<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Promo Strip
  Template Type:      Module
  Description:        Promo CTA full width
  Last Updated:       02/27/2018
  Since:              1.6.4
*/
?>

<div <?php module_class('promo-strip'); ?>>
    <div class="container">
      <div class="row">
        <div class="promo-strip__left-col">
          <div class="promo-strip__header">
          	<?php element('headline', array(
              'classes' => 'promo-strip__title',
              'headline' => $data['headline']
            )); ?>
            <?php if (!empty($data['location'])) : ?>
              <?= $data['location']; ?>
            <?php endif; ?>
          </div>
          <div class="promo-strip__text">
  			   <?= apply_filters('the_content', $data['body_copy']); ?>
  		    </div>
        </div>
        <div class="promo-strip__right-col">
        	<?php
      			$data['cta']['classes'] = array('button--primary');
      			element('button', $data['cta']);
      		?>
        </div>
      </div>
    </div>
</div>
