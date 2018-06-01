<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Menu Selector
  Template Type:      Module
  Description:        Selector
  Last Updated:       06/01/2018
  Since:              2.1.0
*/
?>

<div class="ar-module privacy-selector">
  <div class="container">
    <div class="row">
      <div class="privacy-selector__col">
        <form class="">
          <div class="form-group">
          <?= $data['menu_list']; ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
