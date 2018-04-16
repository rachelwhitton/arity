<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Careers List Item
  Template Type:      Component
  Description:        List item for Careers Feed
  Last Updated:       01/24/2018
  Since:              1.5.0
*/
?>
<a class="career-link" href="<?= $data['link']; ?>" target="_blank">
  <div class="careers-table__row">
    <div class="careers-table__cell careers-table__job-title"><?= $data['title']; ?></div>
    <div class="careers-table__cell careers-table__link-button">
      <div href="#" class="ar-element button button--circle blue-button--">
        <svg class="icon-svg" title="" role="img">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#external"></use>
        </svg>
      </div>
    </div>
  </div>
</a>
<div class="careers-table__border"></div>
