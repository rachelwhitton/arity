<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Inset 10 cols
  Template Type:      Module
  Description:        Body block with a 10 col max (1 col inset on each side)
  Last Updated:       02/19/2018
  Since:              1.6.0
*/

// echo '<pre>'; print_r($data); echo '</pre>'; 
?>

<div <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="row">
      <div class="body-inset-ten-col__col">
        <?php the_partials($data['content']); ?>
      </div>
    </div>
  </div>
</div>
