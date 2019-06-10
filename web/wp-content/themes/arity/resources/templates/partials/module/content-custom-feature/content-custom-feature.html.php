<?php
namespace App\Theme;

?>

<?php
/*
  Template Name:      Custom Feature
  Template Type:      Module
  Description:        Custom code wrapper module
  Last Updated:       05/24/2019
  Since:              2.3.0
*/

// echo '<pre>'; print_r($data); echo '</pre>';

?>

<div <?php module_class($data['classes']); ?>>
	<?php 
	if (!empty($data['custom-content'])) {
		if ($data['custom-content'] != 'custom-content-selector') {
			require_once('layout__'.$data['custom-content'].'.php');
		} else {
			require_once('layout__default.php');
		}
	}
	?>
</div>