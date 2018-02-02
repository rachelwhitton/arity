<?php

/* gets the contents of a file if it exists, otherwise grabs and caches */
function get_content($url,$file,$hours = 24,$fn = '') {

  $output = '';

	//vars
	$current_time = time();
  $expire_time = $hours * 60 * 60;
  if(file_exists($file)) {
    $file_time = filemtime(realpath($file));
  }

  // Determine if we should show cached version
  $should_display_cache = true;
  if(isset($_GET['cached']) && ($_GET['cached'] === 'false' || $_GET['cached'] === '0')) {
    $should_display_cache = false;
  }

	//decisions, decisions
	if($should_display_cache && file_exists($file) && ($current_time - $expire_time < $file_time)) {
		$output = file_get_contents($file);
	}
	else {
		$content = get_url($url);
    $content = cleanupXML($content);

    // Validate XML
    if(!isXMLValid($content)) {
      // If not valid XML use previous existing cache or generate 500 error
      if(file_exists($file)) {
        $output = file_get_contents($file);
        return $output;
      } else {
        header("HTTP/1.1 500 Internal Server Error");
        die('Failed to fetch RSS feed');
      }
    }

		if($fn) { $content = $fn($content); }
    if(createParentDirectory($file)) {
      $content.= '<!-- cached: '.date('Y-m-d H:i:s').'-->';
      file_put_contents($file,$content);
    };
		$output = $content;
	}

  return $output;
}

/* gets content from a URL via curl */
function get_url($url) {
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
}

function isXMLValid($xml) {
  // Check for rss tag
  if( strpos( $xml, '<rss version="2.0">' ) === false ) {
    return false;
  }

  return true;
}

function cleanupXML($xml) {
  // Trim Spaces
  $xml = trim($xml);

  return $xml;
}

function createParentDirectory($file) {
  $path = dirname($file);

  if(!file_exists($path)) {
    mkdir($path, 0777, true);
  }

  if(!is_dir($path)) {
    return false;
  }

  if (!is_writable($path)) {
    return false;
  }

  return true;
}

$path = realpath(__DIR__ . '/../');
$output = get_content('https://jobsearch.allstate.com/Rss/All/Search/jobtitle/arity/', $path . '/xml/jobsearch.xml', 12);
echo $output;
?>
