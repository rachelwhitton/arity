<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Action Bar
  Template Type:      Module
  Description:        Full width bar with side-by-side links
  Last Updated:       09/15/2017
  Since:              1.0.0
*/
//var_dump($data);
// var_dump($data['left_link_groups']);
// var_dump($data['right_link_groups']);
?>
<div id="action-bar" <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="action-bar__row">
      <?php if (!empty($data['left_headline']) || !empty($data['left_content'])) : ?>
        <div class="action-bar__left">
          <<?= $data['h_el']; ?> class="action-bar__headline"><?= $data['left_headline']; ?></<?= $data['h_el']; ?>>
          <?= $data['left_content']; ?>
          <?php
            if (!empty($cta = $data['left_cta'])) :
            //if (!empty($data['left_cta'])) :

              if(!empty($cta['target'])) {
                $cta['icon'] = 'external';
              }

              if(isLinkEmail($cta['url'])) {
                $cta['icon'] = 'email';
              }
          ?>
          <p>
            <a class="button block_link <?php if (!empty($cta['icon']) && $cta['icon'] != 'external') : ?>block_link__icon <?php endif; ?>" href="<?= $cta['url']; ?>"<?php if (!empty($cta['target'])) : ?> target="<?= $cta['target']; ?>"<?php endif; ?>>
              <?php if(!empty($cta['icon'])) : ?>
                <span class="icon-svg <?php if ($cta['icon'] !== 'external') { echo 'button--circle blue-bg--';} else {echo 'action-bar-icon';}?>">
                  <svg class="icon-svg" title="" role="img">
                      <use xlink:href="#<?= $cta['icon']; ?>"></use>
                  </svg>
                </span>
              <?php endif; ?>
              <span class="block_link__text"><?= $cta['title']; ?></span>
            </a>
          </p>
          <?php endif; ?>
          <?php
            if (!empty($data['left_link_groups'])) :
          ?>
          <div class="buttons">
          <?php $i=0; foreach ($data['left_link_groups'] as $cta) : $i++; if(empty($cta['group_l']['link_l'])) continue; ?>
            <?php
              $cta = $cta['group_l'];
              if ($cta['type_l'] == 'link'){
                $classes = 'button block_link';

                if ($cta['icon_l_link'] != 'none') {
                  $cta['link_l']['icon'] = 'arrow-right';
                }

                if((isLinkEmail($cta['link_l']['url']) || ($cta['icon_l_link'] == "mailto")) && ($cta['icon_l_link'] != 'none')) {
                  $cta['link_l']['icon'] = 'email';
                }

                if(($cta['icon_l_link'] == "download") && $cta['icon_l_link'] != 'none') {
                  $cta['link_l']['icon'] = 'download';
                }

                if(($cta['icon_l_link'] == "external") && $cta['icon_l_link'] != 'none') {
                  $cta['link_l']['icon'] = 'external';
                }
              }else{
                $classes = 'button button--primary white-blue-border-button--';

                if(isLinkEmail($cta['link_l']['url']) || $cta['icon_l_button'] == "mailto" && $cta['icon_l_button'] != 'none') {
                  $cta['link_l']['icon'] = 'email';
                }

                if(($cta['icon_l_button'] == "download") && $cta['icon_l_button'] != 'none') {
                  $cta['link_l']['icon'] = 'download';
                }

                if(($cta['icon_l_button'] == "external") && $cta['icon_l_button'] != 'none') {
                  $cta['link_l']['icon'] = 'external';
                }
              }
            ?>
            <p>
              <?php element('button', array_merge($cta['link_l'], [
                'classes' => $classes
              ])); ?>
            </p>
          <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($data['right_headline']) || !empty($data['right_content'])) : ?>
        <div class="action-bar__center">&nbsp;</div>
        <div class="action-bar__right">
          <<?= $data['h_el']; ?> class="action-bar__headline"><?= $data['right_headline']; ?></<?= $data['h_el']; ?>>
          <?= $data['right_content']; ?>
          <?php
            if (!empty($data['right_link_groups'])) :
          ?>
          <div class="buttons">
          <?php $i=0; foreach ($data['right_link_groups'] as $cta) : $i++; if(empty($cta['group_r']['link_r'])) continue; ?>
            <?php
              $cta = $cta['group_r'];
              if ($cta['type_r'] == 'link'){
                $classes = 'button block_link';

                if ($cta['icon_r_link'] != 'none') {
                  $cta['link_r']['icon'] = 'arrow-right';
                }

                if((isLinkEmail($cta['link_r']['url']) || ($cta['icon_r_link'] == "mailto")) && ($cta['icon_r_link'] != 'none')) {
                  $cta['link_r']['icon'] = 'email';
                }

                if(($cta['icon_r_link'] == "download") && $cta['icon_r_link'] != 'none') {
                  $cta['link_r']['icon'] = 'download';
                }

                if(($cta['icon_r_link'] == "external") && $cta['icon_r_link'] != 'none') {
                  $cta['link_r']['icon'] = 'external';
                }
              }else{
                $classes = 'button button--primary white-blue-border-button--';

                if(isLinkEmail($cta['link_r']['url']) || $cta['icon_r_button'] == "mailto" && $cta['icon_r_button'] != 'none') {
                  $cta['link_r']['icon'] = 'email';
                }

                if(($cta['icon_r_button'] == "download") && $cta['icon_r_button'] != 'none') {
                  $cta['link_r']['icon'] = 'download';
                }

                if(($cta['icon_r_button'] == "external") && $cta['icon_r_button'] != 'none') {
                  $cta['link_r']['icon'] = 'external';
                }
              }
            ?>
            <p>
              <?php element('button', array_merge($cta['link_r'], [
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
