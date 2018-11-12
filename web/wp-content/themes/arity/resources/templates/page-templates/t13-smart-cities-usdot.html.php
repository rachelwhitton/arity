<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T13 Smart Cities USDot
  Template Type:      Page Template
  Description:
  Last Updated:       11/12/2018
  Since:              1.0.0
*/

echo 'hello';
//https://www.arity.com//wp-content/uploads/2018/10/image2_visualization_10242018/index.html?rand=1542040997
        // create curl resource 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://dev.arity/wp-content/uploads/2018/11/smart_cities_prototype/app/index.html#/screens"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); // set browser/user agent 
        echo $output = curl_exec($ch); 
        
        if(curl_exec($ch) === false)
          {
              echo 'Curl error: ' . curl_error($ch);
          }
          else
          {
              echo 'Operation completed without any errors';
          }

        curl_close($ch);