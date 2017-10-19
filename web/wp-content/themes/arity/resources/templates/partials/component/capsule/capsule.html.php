<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Capsule
  Template Type:      Component
  Description:        Inner block in a promo with the rounded corners
  Last Updated:       08/01/2017
  Since:              1.0.0
*/
?>
<div <?php component_class('capsule'); ?>>
  <<?= $data['h_el']; ?> class="capsule__header"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
  <div class="capsule__text">
    <?= apply_filters('the_content', $data['body_copy']); ?>
  </div>
  <p>
    <?php
      $data['cta']['classes'] = array('button--primary');
      element('button', $data['cta']);
    ?>
  </p>
</div>
