<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Block Two Column Repeater
  Template Type:      Module
  Description:        Product or feature highlight ("River")
  Last Updated:       10/05/2018
  Since:              2.3.0
*/

// echo '<pre>'; print_r($data); echo '</pre>';

$class = 'content-image-block';
if($data['content-chooser']=='layout__datavis'){
  $class = 'content-datavis-block';
  /*
  if (!empty($data['visualization'])){
    $ext = pathinfo($data['visualization']['url'], PATHINFO_EXTENSION);
    $newUrl =  str_replace('.'.$ext,'',$data['visualization']['url']);
    $newUrl .= '/index.html'; 
    $iframeUrl = $newUrl;
  }
  
  if (!empty($data['url-iframe'])){
    $iframeUrl = $data['url-iframe'];
  }
  */
}
?>

<div <?php module_class($data['classes']); ?>>
  <div class="container module-intro">
    <div class="row">
      <div class="<?= $data['headline-alignment']; ?>">
        <?php if(!empty($data['eyebrow'])) : ?>
          <?php element('eyebrow', array(
            'classes' => 'eyebrow',
            'label' => $data['eyebrow']
          )); ?>
        <?php endif; ?>

        <?php if (!empty($data['main_headline'])) : ?>
          <?php element('headline', array(
          'classes' => $class . '__title',
          'headline' => $data['main_headline']
        )); ?>
        <?php endif; ?>

        <?php if(!empty($data['subhead'])) : ?>
          <div class="block-highlights__subhead">
            <?= $data['subhead']; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php
  foreach ($data['blocks'] as $block) {
    component('block-two-col-component', $block);
  }
  ?>
</div>
