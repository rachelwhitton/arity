<?php
namespace App\Theme;

/*
  Template Name:      Button
  Template Type:      Element
<<<<<<< Updated upstream
  Description:
  Last Updated:       08/15/2017
=======
  Description:        Design system buttons come as round rect 'pills' or links.
                      Both types have icon options.
  Last Updated:       11/29/2019
>>>>>>> Stashed changes
  Since:              1.0.0
*/
// echo 'Custom CTA <pre>';print_r($data);echo '</pre>';
?>

<a href="<?=$data['url'];?>" <?php element_class($data['classes']); ?><?php if (!empty($data['target'])) : ?> target="<?=$data['target'];?>"<?php endif; ?> data-analytics="<?=$data['analytics'];?>">
  <?php if (!empty($data['icon'])) : ?>
    <?php if ($data['icon'] != 'none') : ?>
      <span class="button__icon">
        <?php
        switch($data['icon']) {
          case 'arrow-right':
            $inline = ' style="top: -1;"';
            break;
          case 'arrow-left':
            $inline = ' style="top: -1;"';
            break;
          case 'download':
            $inline = ' style="width: 22px; height: 22px; top: -2px;"';
            break;
          case 'email':
            $inline = '';
            break;
          case 'external':
            $inline = ' style="width: 22px; height: 22px; top: -2px;"';
            break;
          default:
            $inline = '';
        }
        ?>
        <svg class="icon-svg <?=$data['icon'];?>" title="" role="img"<?=$inline;?>>
          <use xlink:href="#<?=$data['icon'];?>"></use>
        </svg>
      </span>
    <?php endif; ?>
  <?php endif; ?>
  <span class="button__label"><?=$data['title'];?></span>
</a>
