<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Hero F - Featured with video
  Template Type:      Module
  Description:        Hero module with video
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php module_class($data['classes']); ?>>

  <div class="hero-f__background-video">
    <?php if (!empty($data['background-video-url'])) : ?>
      <video
        src="<?= $data['background-video-url'] ?>"
        <?php if (!empty($data['image_url'])) : ?>
          poster="<?= $data['image_url'] ?>"
        <?php endif ?>
        autoplay
        loop
        muted
        playsinline />
    <?php endif; ?>
  </div>

  <?php if ($data['gradient-flood-active'] !== '0') : ?>
    <div class="hero-f__background-flood --desktop"></div>
  <?php endif; ?>

  <div class="hero-f__content-wrapper">
    
    <?php if ($data['gradient-flood-active'] !== '0') : ?>
      <div class="hero-f__background-flood --mobile"></div>
    <?php endif; ?>

    <div class="container">
      <div class="row">
        <div class="hero-f__col left--">
          <div>
            <<?= $data['h_el']; ?> class="type2 hero-f__title"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
            <div class="hero-f__content type0"><?= apply_filters('the_content', $data['body_copy']); ?></div>
            <?php if (!empty($data['cta'])) : ?>
              <p>
                <?php
                  $data['cta']['classes'] = array('button--primary', 'blue-button--');
                  element('button', $data['cta']);
                ?>
              </p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
