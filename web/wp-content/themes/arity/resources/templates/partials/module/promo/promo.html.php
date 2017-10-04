<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Promo
  Template Type:      Module
  Description:        Promo CTA with the capsule component
  Last Updated:       08/03/2017
  Since:              1.0.0
*/
?>

<div <?php module_class($data['classes']); ?>>
  <div class="row">
    <div class="container">
      <?php component('capsule', $data); ?>
    </div>
  </div>
</div>
