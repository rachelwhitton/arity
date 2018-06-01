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
      <div class="col-xs-12 col-lg-8 col-lg-offset-4">
        <div class="row">
          <div class="col-xs-6 col-lg-4">
            <form class="">
              <div class="form-group form-group--required">
              <?= $data['menu_list']; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
