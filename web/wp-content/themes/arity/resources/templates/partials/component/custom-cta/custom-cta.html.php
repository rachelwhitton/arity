<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Text with Icon - Stack ONE Columns
  Template Type:      Component
  Description:        Stack of "Text with Icon" components in ONE column
  Last Updated:       08/28/2017
  Since:              2.3.0
*/
?>
<div <?php component_class('product-cta'); ?>>
<?php 
  for($i=0; $i<sizeof($data['link_groups']); $i++){ 
    $data['cta']['title']= $data['link_groups'][$i]['group']['cta__link']['title'];
    $data['cta']['url']= $data['link_groups'][$i]['group']['cta__link']['url'];
    $data['cta']['target']= $data['link_groups'][$i]['group']['cta__link']['target'];
    
  ?>
  <?php if (!empty($data['cta'])) : ?>
    <?php
        
        if ($data['link_groups'][$i]['group']['cta__type']=='link'){
          $data['cta']['classes'] = 'button block_link';
          $data['cta']['icon']= $data['link_groups'][$i]['group']['cta__icon_link'];
        }else{
          $data['cta']['classes'] = 'button--primary white-blue-button--';
          $data['cta']['icon']= $data['link_groups'][$i]['group']['cta__icon_button'];
        }
        
        //echo $i.'type: '.$data['link_groups'][$i]['group']['cta__type'];
    ?>
      <p>
        <?php element('button', $data['cta']); ?>
      </p>
  <?php endif; ?>
      <?php } ?>
</div>
