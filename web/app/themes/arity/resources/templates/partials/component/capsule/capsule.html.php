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
  <h3 class="capsule__header"><?= $data['headline']; ?></h3>
  <div class="capsule__text">
    <?= apply_filters('the_content', $data['body_copy']); ?>
  </div>
  <?php
    $data['cta']['classes'] = array('button--primary');
    element('button', $data['cta']);
  ?>
</div>
