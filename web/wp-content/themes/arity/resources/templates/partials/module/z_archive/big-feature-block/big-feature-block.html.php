<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Big Feature Block
  Template Type:      Module
  Description:        Row of two feature solutions (as appear currently on the Understand/Empower pages)
  Last Updated:       08/02/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('big-feature-block'); ?>>
  <div class="big-feature-block__container">
    <?php component('round-image', [
      'image_id' => $data['image_id']
    ]); ?>
    <div class="row">
      <div class="big-feature-block__col">
        <?php component('feature-content', $data); ?>
      </div>
    </div>
  </div>
</div>
