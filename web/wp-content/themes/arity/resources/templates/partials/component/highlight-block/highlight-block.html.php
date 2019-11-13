<?php
namespace App\Theme;

/*
  Template Name:      Highlight Block
  Template Type:      Component
  Description:        A block of highlight
  Last Updated:       4/20/2018
  Since:              1.6.4
*/

$link_text_flex_props = !empty($data['link-text-width']) ? ' style="flex: 0 1 ' . $data['link-text-width'] . '"' : '';

?>

  <div <?php component_class($data['classes']); ?>>
    <div class="block__inner">
      <?php if ( !empty($data['image_id']) ) : ?>
        <div class="block__icon">
          <?php template('partials/element/image/image', array(
            'id' => $data['image_id']
          )); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($data['subhead'])) : ?>
        <h3 class="block__title"><?= $data['subhead']; ?></h3>
      <?php endif; ?>
      <?php if (!empty($data['body_copy'])) : ?>
        <?= $data['body_copy']; ?>
      <?php endif; ?>
      <?php if (!empty($data['cta'])) : ?>
        <?php
          $data['cta']['classes'] = array('button', 'button--link', $data['cta-icon'] . '--');
          // $data['cta']['classes'] = array('button', 'button--link', 'arrow-right--');
          $data['cta']['icon'] = $data['cta-icon'];
          // $data['cta']['icon'] = 'arrow-right';
          // element('button', $data['cta']);
          // echo '<pre>' . PHP_EOL;
          // var_dump($data['cta']);
          // echo '</pre>' . PHP_EOL;
        ?>
          <a href="<?=$data['cta']['url'];?>" <?php element_class($data['cta']['classes']); ?><?php if (!empty($data['cta']['target'])) : ?> target="<?=$data['cta']['target'];?>"<?php endif; ?> data-analytics="<?=$data['cta']['analytics'];?>">
            <?php if (!empty($data['cta']['icon'])) : ?>
              <span class="button__icon <?=$data['cta']['icon'];?>">
                <svg class="icon-svg <?=$data['cta']['icon'];?>" title="" role="img">
                  <use xlink:href="#<?=$data['cta']['icon'];?>"></use>
                </svg>
              </span>
            <?php endif; ?>
            <span class="button__label"<?=$link_text_flex_props;?>><?=$data['cta']['title'];?></span>
          </a>
      <?php endif; ?>
    </div>
  </div>
