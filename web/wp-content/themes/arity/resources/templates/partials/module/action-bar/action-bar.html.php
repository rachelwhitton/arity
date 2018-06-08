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
var_dump($data);
var_dump($data['left_link_groups']);
var_dump($data['right_link_groups']);
?>
<div id="action-bar" <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="action-bar__row">
      <?php if (!empty($data['left_headline']) || !empty($data['left_content'])) : ?>
        <div class="action-bar__left">
          <<?= $data['h_el']; ?> class="action-bar__headline"><?= $data['left_headline']; ?></<?= $data['h_el']; ?>>
          <?= $data['left_content']; ?>
          <?php
            //if (!empty($cta = $data['left_cta'])) :
            if (!empty($data['left_cta'])) :

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
          <?php $i=0; foreach ($data['left_link_groups'] as $cta) : $i++; if(empty($cta['group_l']['link_l'])) continue; ?>
            <?php
              if ($cta['group_l']['type_l'] == 'link'){
                $a_classes = 'button block_link';
                $b_classes = 'block_link__text';
              }else{
                $a_classes = 'button button--primary white-blue-border-button--';
                $b_classes = '__text';
              }

              if (($cta['group_l']['type_l'] == 'button') && ($cta['group_l']['icon_l'] != 'none')) {
                $a_classes .= ' has-icon--';
              }

              if(isLinkEmail($cta['group_l']['link_l']['url']) || $cta['group_l']['icon_l'] == "mailto") {
                $cta['group_l']['icon_l'] = 'email';
              }

              if (($cta['group_l']['icon_l'] != 'external') && ($cta['group_l']['type_l'] == 'link')) {
                $c_classes = 'icon-svg button--circle blue-bg--';
              }else{
                $c_classes = 'icon-svg action-bar-icon';
              }

              if ($cta['group_l']['type_l'] == 'link' && $cta['group_l']['icon_l'] == 'default'){
                $cta['group_l']['icon_l'] = 'arrow-right';
              }






              // if (($cta['group_l']['icon_l'] != 'none') && ($cta['group_l']['icon_l'] != 'external') && ($cta['group_l']['icon_l'] != 'link')) {
              //   $a_classes .= ' block_link__icon';
              // }
            ?>
            <p>
              <a class="<?= $a_classes;?>" href="<?= $cta['group_l']['link_l']['url']; ?>"<?php if (!empty($cta['group_l']['link_l']['target'])) : ?> target="<?= $cta['group_l']['link_l']['target']; ?>"<?php endif; ?>>
                <?php if($cta['group_l']['icon_l'] !='none') : ?>
                  <span class="<?= $c_classes;?>">
                    <svg class="icon-svg" title="" role="img">
                        <use xlink:href="#<?= $cta['group_l']['icon_l']; ?>"></use>
                    </svg>
                  </span>
                <?php endif; ?>
                <span class="<?= $b_classes;?>"><?= $cta['group_l']['link_l']['title']; ?></span>
              </a>
            </p>
          <?php endforeach; ?>
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
          <?php $i=0; foreach ($data['right_link_groups'] as $cta) : $i++; if(empty($cta['group_r']['link_r'])) continue; ?>
            <p>
              <?php element('button', array_merge($cta['group_r']['link_r'], [
                'classes' => 'button--primary white-blue-border-button--'
              ])); ?>
            </p>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
