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

<div <?php component_class('text-icon-stack'); ?>>
  <?php if (!empty($data['headline'])) : ?>
    <div class="type4 typeBold text-icon-stack__headline">
      <?= $data['headline']; ?>
    </div>
  <?php endif; ?>
  <?php the_partials($data['stacks']); ?>
</div>
