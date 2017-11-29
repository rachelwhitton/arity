<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Text with Icon - Stack ONE Columns
  Template Type:      Component
  Description:        Stack of "Text with Icon" components in ONE column
  Last Updated:       08/03/2017
  Since:              1.0.0
*/

?>

<div <?php component_class('icon-only-stack-right'); ?>>
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
