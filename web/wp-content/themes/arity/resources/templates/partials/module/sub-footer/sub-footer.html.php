<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Sub Footer
  Template Type:      Module
  Description:        Block below the traditional footer (used in careers page)
  Last Updated:       09/15/2017
  Since:              1.0.0
*/
?>
<div <?php module_class('sub-footer text-module-subfooter ar-module--no-margin'); ?>>
  <div class="container sub-footer__disclaimer">
      <?= $data['content']; ?>
  </div>
</div>
