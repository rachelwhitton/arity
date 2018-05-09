<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Text with image
  Template Type:      Component
  Description:        Stack of "Text with Image" components with optional headline
  Last Updated:       05/10/2018
  Since:              1.9.0
*/
?>

<div <?php component_class('text-icon-stack'); ?>>
  <?php if (!empty($data['headline'])) : ?>
    <<?= $data['h_el']; ?> class="type0 typeBold text-icon-stack__headline">
      <?= $data['headline']; ?>
    </<?= $data['h_el']; ?>>
  <?php endif; ?>
  <?php
    foreach($data['stacks'] as $i=>$stack) {
      $data['stacks'][$i]['component__text-w-icon']['h_el'] = updateElImportance($data['h_el'], 1);
    }
  ?>
  <?php the_partials($data['stacks']); ?>
</div>
