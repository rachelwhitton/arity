<?php
namespace App\Theme;

$data['panels'] = !empty($data['panels']) ? $data['panels'] : array();

?>
<div id="scrim" class="scrim" role="presentation">
  <?php $i=-1; while ($i < $data['panels']) : $i++; ?>
    <div class="scrim__panel" data-scrim-panel="<?= $i; ?>"></div>
  <?php endwhile; ?>
</div>
