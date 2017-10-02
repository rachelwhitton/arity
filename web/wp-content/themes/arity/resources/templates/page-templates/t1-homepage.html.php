<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T1 Homepage
  Template Type:      Page Template
  Description:
  Last Updated:       08/15/2017
  Since:              1.0.0
*/

// Get ACF Fields
$acf_fields = get_fields();

// Build In Page Navigation data
$navigation = array();
foreach ($acf_fields['t1__sections'] as $key => $section) {
  $navigation[$key]['id'] = $section['id'];
  $navigation[$key]['label'] = $section['label'];
}

?>
<?php get_header(); ?>

<div class="app__wrapper container">
  <?php
    component('in-page-navigation', array(
      'links' => $navigation
    ));
  ?>
  <div class="row">
    <div class="app__home">
      <?php
        $i = 0;
        foreach ($acf_fields['t1__sections'] as $key => $section) : ?>
        <div data-scrim-trigger="<?php echo $i++; ?>">
          <section id="<?= $section['id']; ?>" class="app__home__section">
            <?php the_partials($section['modules']); ?>
          </section>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</div>

<?php component('scrim', array(
  'panels' => count($navigation)
)); ?>

<?php get_footer(); ?>