<?php
namespace App\Theme;

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

$data['feed'] = false;

$feed = get_rss('https://jobsearch.allstate.com/Rss/All/Search/jobtitle/arity/');
if(!empty($feed['channel']['item'])) {
  $data['feed'] = $feed['channel']['item'];

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

  $data['feedCount'] = count($data['feed']);
}

return $data;
