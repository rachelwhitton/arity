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
<div <?php component_class('product-cta'); ?>>
  <?php if (!empty($data['headline'])) : ?>
    <<?= $data['h_el']; ?> class="type4 typeBold product-cta__headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
  <?php endif; ?>
  <?php if (!empty($data['body_copy'])) : ?>
    <div class="type0 product-cta__p">
      <?= $data['body_copy']; ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($data['cta'])) : ?>
    <?php
      if (!empty($data['cta'])) :
        $data['cta']['classes'] = 'button--primary white-blue-button--';
        $data['cta']['icon'] = 'arrow-right';
    ?>
      <p>
        <?php element('button', $data['cta']); ?>
      </p>
    <?php endif; ?>
  <?php endif; ?>
</div>
