<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Page Footnote
  Template Type:      Module
  Description:
  Last Updated:       08/18/2017
  Since:              1.0.0
*/
?>
<div <?php module_class('page-footnote'); ?>>
  <div class="container">
    <div class="row">
      <div class="page-footnote__content">
        <?= $data['body_copy']; ?>
      </div>
    </div>
  </div>
</div>
