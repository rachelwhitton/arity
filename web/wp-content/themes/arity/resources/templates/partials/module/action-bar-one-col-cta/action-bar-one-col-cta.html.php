<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Action Bar One Column CTA
  Template Type:      Module
  Description:        Full width bar with centered content and CTA
  Last Updated:       12/01/2017
  Since:              1.2.0-alpha.1
*/
// echo '<pre>';print_r($data); echo '</pre>';
?>
<div id="action-bar-one-col-cta" <?php module_class($data['classes']); ?>>
  <div class="container action-bar-one-col-cta__block">
    <div class="action-bar-one-col__row">
      <?php if (!empty($data['center_headline']) || !empty($data['center_content'])) : ?>
        <div class="action-bar-one-col-cta__content">
          <<?= $data['h_el']; ?> class="action-bar-one-col-cta__headline"><?= $data['center_headline']; ?></<?= $data['h_el']; ?>>
          <?= $data['center_content']; ?>
          <?php
            if (!empty($data['link_groups'])) :
          ?>
            <div class="buttons">
            <?php $i=0; foreach ($data['link_groups'] as $cta) : $i++; if(empty($cta['group']['cta__link'])) continue; ?>
              <?php
                $cta = $cta['group'];
                if ($cta['cta__type'] == 'link'){
                  $classes = 'button block_link';

                  if ($cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'arrow-right';
                  }

                  if((isLinkEmail($cta['cta__link']['url']) || ($cta['cta__icon_link'] == "mailto")) && ($cta['cta__icon_link'] != 'none')) {
                    $cta['cta__link']['icon'] = 'email';
                  }

                  if(($cta['cta__icon_link'] == "download") && $cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'download';
                  }

                  if(($cta['cta__icon_link'] == "external") && $cta['cta__icon_link'] != 'none') {
                    $cta['cta__link']['icon'] = 'external';
                  }
                }else{
                  $classes = 'button button--primary white-blue-border-button--';

                  if(isLinkEmail($cta['cta__link']['url']) || $cta['cta__icon_button'] == "mailto" && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'email';
                  }

                  if(($cta['cta__icon_button'] == "download") && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'download';
                  }

                  if(($cta['cta__icon_button'] == "external") && $cta['cta__icon_button'] != 'none') {
                    $cta['cta__link']['icon'] = 'external';
                  }
                }
              ?>
              <p>
                <?php element('button', array_merge($cta['cta__link'], [
                  'classes' => $classes
                ])); ?>
              </p>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
