<?php
$url = 'http://khawajausman.com/';
$project = $_GET['project_id'];//'smart_cities_prototype_source';
$outputTxt = $url.$project.'/output.txt';
$allowedExtentions = ['css','js','html','jpg','jpeg','png','woff','md'];

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $outputTxt); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 
curl_close($ch);  

// echo $output;
echo getcwd();
mkdir('../../uploads/dataviz/'.$project.'/');

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
        
        echo '<br/>'.$url.'/'.$fileName;
        //The resource that we want to download.
        $fileUrl = $url.'/'.$fileName;
        
        //The path & filename to save to.
        $saveTo = '../../uploads/dataviz/'.$project.'/'.$fileName;

        if($isFile){
            // Download File
            echo '<br/>File ';
            
            //Open file handler.
            $fp = fopen($saveTo, 'w+');
            
            //If $fp is FALSE, something went wrong.
            if($fp === false){
                throw new Exception('Could not open: ' . $saveTo);
            }
            
            //Create a cURL handle.
            $ch = curl_init($fileUrl);
            
            //Pass our file handle to cURL.
            curl_setopt($ch, CURLOPT_FILE, $fp);
            
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

        //exit;
    }
} 
?>