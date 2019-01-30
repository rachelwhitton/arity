<?php

declare(strict_types=1);

/*
 |------------------------------------------------------------------
 | Bootstraping a Theme
 |------------------------------------------------------------------
 |
 | This file is responsible for bootstrapping your theme. Autoloads
 | composer packages, checks compatibility and loads theme files.
 | Most likely, you don't need to change anything in this file.
 | Your theme custom logic should be distributed across a
 | separated components in the `/app` directory.
 |
 */


/**
 * Require Composer
 * @since 1.0.0
 * @return void
 *
 * Require Composer's autoloading file
 * if it's present in theme directory.
 */
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

/**
 * Autoload plugins
 * @since 1.0.0
 * @return void
 *
 * Autoloads plugins/plugins in <theme>/app/plugin/
 * Similar to how Wordpress autoloads plugins
 */
$plugins = require_once __DIR__ . '/app/bootstrap/plugins.php';
foreach ($plugins as $filename) {
    require_once $filename;
}

// Before running we need to check if everything is in place.
// If something went wrong, we will display friendly alert.
$ok = require_once __DIR__ . '/app/bootstrap/compatibility.php';

/**
 * Bootstrap Theme
 * @since 1.0.0
 * @return void
 *
 * Bootstraps Theme and autoloads required files in <theme>/app/config/app.php
 */
if ($ok) {
    // Now, we can bootstrap our theme.
    $theme = require_once __DIR__ . '/app/bootstrap/theme.php';

    // Autoload theme. Uses localize_template() and
    // supports child theme overriding. However,
    // they must be under the same dir path.
    (new \Arity\Autoloader($theme->get('config')))->register();
}

function my_datavis_save_post($post_id){
    $iframeArray = [];

    if (empty($_POST['acf'])) {
        return;
    }
    
    $fields = get_fields();
    echo '<pre>';print_r($fields['modules']);echo '</pre>';

    for($i=0; $i<sizeof($fields['modules']); $i++){
        $oldProjectId = $fields['modules'][$i]['data-vis__projectid-iframe'];
        if ($fields['modules'][$i]['data-vis__projectid-iframe']!=''){
            array_push($iframeArray,$oldProjectId);
        }
    }

    $arr = $_POST['acf']['field_modules_modules'];

    foreach ($arr as $key => $value) {
        $projectId = $arr[$key]['field_module_data-vis_field_module_data-vis_data-vis__projectid-iframe'];
        //echo '<pre>';print_r($arr[$key]);echo '</pre>';
        if($projectId!=''){
            
            if (in_array($projectId,$iframeArray)){
                echo '<br/>DO NOT Update me '.$projectId;
            }else{
                echo '<br/>Update me '.$projectId;
                pullData($projectId);
            }
        }
    }
}

function pullData($projectId){
    if($_ENV['LOCAL']){
        return;
    }

    if ((isset($_ENV['PANTHEON_ENVIRONMENT']) && $_ENV['PANTHEON_ENVIRONMENT'] == 'live') ||(isset($_ENV['PANTHEON_ENVIRONMENT']) && $_ENV['PANTHEON_ENVIRONMENT'] == 'dev')) {
        $json_text = file_get_contents('../../wp-content/uploads/private/dev.json');
        $data = json_decode($json_text, TRUE);
        $userpwd = $data['user'].':'.$data['password']; 
    }

    echo '<br/><br/>IN PULL DATA: '.$projectId.'<br/><br/><br/><br/>';
    $url = 'http://dataviz.arity.vsadev.com/filemanager';
    $project = $projectId;//'smart_cities_prototype_source';
    $outputTxt = 'http://dataviz.arity.vsadev.com/dir.php?projectId='.$projectId;
    $allowedExtentions = ['css','js','html','jpg','jpeg','png','woff','md'];

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $outputTxt); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
    $output = curl_exec($ch); 
    curl_close($ch);  

    // echo $output;
    echo getcwd();
    echo mkdir('../../wp-content/uploads/dataviz/'.$projectId);

    foreach(preg_split("/((\r?\n)|(\r\n?))/", $output) as $line){
        if ($line != '.' && $line !='./output.txt' && $line !=''){
            echo '<br/><br/>'.$line;

            $fileName = str_replace('./','',$line);
            $fileNameArray = explode('/',$fileName);
            $fileNameLastItem = $fileNameArray[sizeof($fileNameArray)-1];

            $fileNameLastItemArray = explode('.',$fileNameLastItem);
            echo '<br/>'.$fileNameLastItemExt = $fileNameLastItemArray[sizeof($fileNameLastItemArray)-1];

            if (in_array($fileNameLastItemExt,$allowedExtentions) && strpos($fileNameLastItem, '.') !== false){
                echo $isFile = true;
            }else{
                echo $isFile = false;
            }
            
            echo '<br/><br/>--------------------------------------------------<br/><br/>';
            
            echo '<br/>'.$url.$projectId.'/'.$fileName;
            //The resource that we want to download.
            $fileUrl = $url.'/'.$projectId.'/'.$fileName;
            
            //The path & filename to save to.
            echo $saveTo = '../../wp-content/uploads/dataviz/'.$projectId.'/'.$fileName;

            if($isFile){
                // Download File
                echo '<br/>File ';
                
                //Open file handler.
                $fp = fopen($saveTo, 'w+');
                echo '<br/>File 1';
                //If $fp is FALSE, something went wrong.
                    if($fp === false){
                        throw new Exception('Could not open: ' . $saveTo);
                    }
                    echo '<br/>File 2';
                    //Create a cURL handle.
                    $ch = curl_init($fileUrl);
                    
                    //Pass our file handle to cURL.
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    
                    curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
                    //Timeout if the file doesn't download after 20 seconds.
                    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                    
                    //Execute the request.
                    curl_exec($ch);
                    
                    //If there was an error, throw an Exception
                    if(curl_errno($ch)){
                        throw new Exception(curl_error($ch));
                    }
                    
                    //Get the HTTP status code.
                    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    
                    //Close the cURL handler.
                    curl_close($ch);
                    
                    if($statusCode == 200){
                        echo 'Downloaded!';
                    } else{
                        echo "Status Code: " . $statusCode;
                    }
                
            }else{
                // Create Dir
                echo '<br/>Dir';
                mkdir($saveTo);
            }
        }
    } 
}

add_action('acf/save_post', 'my_datavis_save_post', 1);

/*
 * Set $regex_path_patterns accordingly.
 *
 * We don't set this variable for you, so you must define it
 * yourself per your specific use case before the following conditional.
 *
 * For example, to exclude pages in the /news/ and /about/ path from cache, set:
 *
 *   $regex_path_patterns = array(
 *     '#^/news/?#',
 *     '#^/about/?#',
 *   );
 */

$regex_path_patterns = array(
    '#^/move/?#',
    '#^/popup/?#'
  );
  
  // Loop through the patterns.
  foreach ($regex_path_patterns as $regex_path_pattern) {
    if (preg_match($regex_path_pattern, $_SERVER['REQUEST_URI'])) {
      add_action( 'send_headers', 'add_header_nocache', 15 );
  
      // No need to continue the loop once there's a match.
      break;
    }
  }
  function add_header_nocache() {
        header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
  }