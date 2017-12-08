<?php
namespace App\Theme;

/*
  Template Name:      Accordion Item
  Template Type:      Component
  Description:        A component that is part of the accordion component. Headline and Text body.
  Last Updated:       12/07/2017
  Since:              1.2.2
*/

?>
<?php if (!empty($data['headline'])) : ?>
  <a id="item-<?= $data['aid']; ?>" class="accordion-item" data-toggle="collapse" href="#collapse-<?= $data['aid']; ?>" aria-expanded="true" aria-controls="collapse-<?= $data['aid']; ?>">
    <div class="item-row">
      <div class="item-row-header" role="tab" id="heading-<?= $data['aid']; ?>">
        <<?= $data['h_el']; ?> class="item-title"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
        <div class="ar-element button--plus-minus-toggle">
          <svg class="icon-svg" title="" role="img">
            <use xlink:href="#plus"></use>
          </svg>
        </div>
      </div>

      <div id="collapse-<?= $data['aid']; ?>" class="collapse show" role="tabpanel" aria-labelledby="heading-<?= $data['aid']; ?>" data-parent="#item-<?= $data['aid']; ?>">
        <div class="item-row-body">
          <?= apply_filters('the_content', $data['content']); ?>
        </div>
      </div>
    </div>
  </a>
<?php endif; ?>
