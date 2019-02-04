<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Blog Popup
  Template Type:      Module
  Description:        Set time for popup to show up on page.
  Last Updated:       02/04/2019
  Since:              2.3.0


  Note:               Any page this module is added to must be included in $regex_path_patterns array in functions.php
*/

?>
<div class="popupTime" data-time="<?=$data['time']!=''?$data['time']:'20'; ?>"></div>
<?php 
require_once(get_stylesheet_directory()."/resources/templates/page-templates/blog-popup.php");
?>

