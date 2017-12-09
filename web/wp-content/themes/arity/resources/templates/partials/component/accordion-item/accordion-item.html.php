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
<div class="item-body">
  <a id="item-<?= $data['aid']; ?>" class="accordion-item" data-toggle="collapse" href="#collapse-<?= $data['aid']; ?>" aria-expanded="false" aria-controls="collapse-<?= $data['aid']; ?>">
    <div class="item-row">
      <div class="item-row-header" role="tab" id="heading-<?= $data['aid']; ?>">
        <div class="header-container">
          <<?= $data['h_el']; ?> class="item-title"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
        </div>
        <div class="ar-element button--plus-minus-toggle">
          <svg class="icon-svg plus-minus" role="img" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1">
              <g id="plus">
                <g id="Layer_1" transform="translate(11.000000, 0.000000)">
                  <rect id="Rectangle-path" x="0" y="0" width="3" height="26" rx="1.5"></rect>
                </g>
                <g id="Layer_2" transform="translate(0.000000, 11.000000)">
                  <rect id="Rectangle-path" x="0" y="0" width="26" height="3" rx="1.5"></rect>
                </g>
              </g>
            </g>
          </svg>
        </div>
      </div>
    </div>
  </a>

  <div id="collapse-<?= $data['aid']; ?>" class="collapse item" role="tabpanel" aria-labelledby="heading-<?= $data['aid']; ?>" data-parent="#items-wrapper">
    <div class="item-row-body">
      <?= apply_filters('the_content', $data['content']); ?>
    </div>
  </div>
</div>
<?php endif; ?>
