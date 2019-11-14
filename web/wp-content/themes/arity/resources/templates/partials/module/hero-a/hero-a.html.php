<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Hero A - No Image
  Template Type:      Module
  Description:        Hero module with an inline image or a background videl.
  Last Updated:       10/18/2019
  Since:              1.0.0
*/

// $ls_aspect_ratio = 1200/700;
// $ls_height = 1 / $ls_aspect_ratio * 100;

?>
<style>
  /* .hero-a--bg-video {
    display: block;
  }
  .hero-a--bg-video .container {
    height: 100%;
  } */
/* .hero-a__background-video {
  display: none;
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  width: auto;
  height: auto;
  z-index: 0;
} */
@media (min-width: 768px) {
  /* .hero-a--bg-video {
    display: flex;
    padding-top: 76px;
    align-items: center;
    width: 100vw;
    height: <?=$ls_height;?>vw !important;
    max-width: 1400px;
    max-height: 817px;
  } */
  /* .hero-a--bg-video .container {
    height: auto !important;
  } */
  /* .hero-a__background-video {
    display: block;
  } */
}
</style>

<div <?php module_class($data['classes']); ?>>

  <?php if ($data['animation']) : ?>
    <ul id="loader">
      <li></li><li></li><li></li><li></li><li></li>
      <li></li><li></li><li></li><li></li><li></li>
      <li></li><li></li><li></li><li></li><li></li>
      <li></li><li></li><li></li><li></li><li></li>
    </ul>
  <?php endif; ?>

  <?php if (!empty($data['background-video'])) : ?>
    <div class="hero-a__background-video">
      <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"<?php echo !empty($data['bg-video-backup-image']) ? ' poster="'.$data["bg-video-backup-image"].'"': '';?>>
        <source src="<?=$data['background-video'];?>" type="video/mp4">
      </video>
    </div>
  <?php endif; ?>

  <div class="container">
    <div class="row">
      <div class="hero-a__col anim-ready left--">
        <<?= $data['h_el']; ?> class="type2 hero-a__title"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
        <div class="hero-a__content type0"><?= apply_filters('the_content', $data['body_copy']); ?></div>
        <?php if (!empty($data['cta'])) : ?>
          <p>
            <?php
              $data['cta']['classes'] = array('button--primary', 'blue-button--');
              element('button', $data['cta']);
            ?>
          </p>
        <?php endif; ?>
      </div>
      <?php if (!empty($data['image_id'])) : ?>
        <div class="hero-a__col right-- hero-a__image">
          <?php element('image', [
            'id' => $data['image_id']
          ]); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
