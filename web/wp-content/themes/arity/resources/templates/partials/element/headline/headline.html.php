<?php
namespace App\Theme;

/*
  Template Name:      Headline
  Template Type:      Element
  Description:
  Last Updated:       02/15/2018
  Since:              1.0.0
*/
?>

<<?= $data['h-size']; ?> <?php element_class($data['classes']); ?>><?= $data['headline']; ?></<?= $data['h-size']; ?>>
