<?php
namespace App\Theme;

/*
  Template Name:      Newsroom Item
  Template Type:      Module
  Description:        A news item.
  Last Updated:       08/15/2018
  Since:              2.3.0
*/
?>

<? echo '<pre>'; print_r($data); echo count($data[items]).'</pre>';

if( get_query_var('page') ) {
  $page = get_query_var( 'page' );
} else {
  $page = 1;
}

// Variables
$row              = 0;
$images_per_page  = 4; // How many images to display on each page
$images           = $data[items];
$total            = count( $images );
$pages            = ceil( $total / $images_per_page );
$min              = ( ( $page * $images_per_page ) - $images_per_page ) + 1;
$max              = ( $min + $images_per_page ) - 1;

// ACF Loop
if( $total>0 ) : ?>

  <?php while( $row < $total): 
    $row++;

    // Ignore this image if $row is lower than $min
    if($row < $min) { continue; }

    // Stop loop completely if $row is higher than $max
    if($row > $max) { break; } ?>                     
  
    <h2><a href="<?=$data['items'][$row-1]['link']?>"><?=$data['items'][$row-1]['headline']?></a></h2>

  <?php endwhile;

  // Pagination
  echo paginate_links( array(
    'base' => get_permalink() . '%#%' . '/',
    'format' => '?page=%#%',
    'current' => $page,
    'total' => $pages
  ) );
  ?>

<?php else: ?>

  No images found

<?php endif; ?>
