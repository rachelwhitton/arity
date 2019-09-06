<?php
namespace App\Theme;

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

$data['feed'] = false;
$data['feed_cached'] = false;

$feed = get_rss('https://careers.allstate.com/feed/285400');

$data['raw_feed'] = $feed;
$data['feed'] = [];
$i = 0;

// Clean up item data
foreach($feed['job'] as $item) {
  // Call out item title
  $job['title'] = $item->title;
  // Remove Arity prefix
  $job['title'] = preg_replace('/Arity - /', '', $job['title']);
  $job['title'] = preg_replace('/Arity/', '', $job['title']);
  // Convert hyphens to spaces
  $job['title'] = preg_replace('/[\s-]+/', ' ', $job['title']);
  // Remove job location (content in parentheses)
  $job['title'] = preg_replace('/[\[{\(].*[\]}\)]/U' , '',  $job['title']);
  // Trim extra white space
  $data['feed'][$i]['title'] = trim($job['title']);
  // Cast Object as Array
  $data['feed'][$i]['link'] = (array) $item->url;
  $i++;
}

// Sort alphabetically (don’t favor caps over lowercase)
usort($data['feed'], function($a, $b) {
  if (strtoupper($a['title']) == strtoupper($b['title'])) {
    return 0;
  }
  return (strtoupper($a['title']) < strtoupper($b['title'])) ? -1 : 1;
});

 // Add feed count
$data['feedCount'] = count($data['feed']);

return $data;



// FEED UNTIL 09-06-2019 => https://careers.allstate.com/services/rss/job/?keywords=Arity&campaign=Arity%20Careers%20Portal&date=created&rows=500&sort=created
/* FEED UNTIL 09-06-2019 PARSING LOOP */ 
/*
// Clean up item data
foreach($feed[channel]->item as $innerItem){
  // Call out item title
  $item['title'] = $innerItem->title;
  // Remove Arity prefix
  $item['title'] = preg_replace('/Arity - /', '', $item['title']);
  $item['title'] = preg_replace('/Arity/', '', $item['title']);
  // Convert hyphens to spaces
  $item['title'] = preg_replace('/[\s-]+/', ' ', $item['title']);
  // Remove job location (content in parentheses)
  $item['title'] = preg_replace('/[\[{\(].*[\]}\)]/U' , '',  $item['title']);
  // Trim extra white space
  $data['feed'][$i]['title'] = trim($item['title']);
  // Cast Object as Array
  $data['feed'][$i]['link'] = (array) $innerItem->link;
  $i++;
}
*/

// OLD URL => https://jobsearch.allstate.com/Rss/All/Search/jobtitle/arity/
/* OLD CAREERS FEED PARSING LOOP */
/*
if(!empty($feed['channel']['item'])) {

  $data['feed'] = $feed['channel']['item'];

  echo '<pre>';print_r($data['feed']); echo '</pre>';

  // CleanUp Item Data
  foreach($data['feed'] as $i=>$item) {

    // Remove Arity prefix
    $item['title'] = preg_replace('/Arity-/', '', $item['title']);

    // Convert dashes to spaces
    $item['title'] = preg_replace('/[\s-]+/', ' ', $item['title']);

    // Set Object Value
    $data['feed'][$i]['title'] = $item['title'];
  }

  // Sort by alphabetical
  usort($data['feed'], function($a, $b) {
    if ($a['title'] == $b['title']) {
        return 0;
    }
    return ($a['title'] < $b['title']) ? -1 : 1;
  });

  // Add Feed Count
  $data['feedCount'] = count($data['feed']);

  // Add Cached Date
  if(!empty($feed['_cached'])) {
    $data['feed_cached'] = $feed['_cached'];
  }
}
*/
