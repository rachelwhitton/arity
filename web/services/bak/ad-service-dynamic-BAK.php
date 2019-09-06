<?php

  /**
   * ad-service.php
   *
   * A simple web service that relays a request for an ad, fetches the ad, then
   *
   * @author     Jonathon Westbrook
   * @copyright  VSA Partners, Inc. / Arity.com
   * @license    https://www.php.net/license/3_01.txt PHP License 3.0
   */

  // Allows testing any value in the API
  $debugMessage = "";
  $publisher    = (htmlspecialchars($_GET["w"]) ?: debug_message("<b>publisher missing</b><br />"));
  $placement_id = (htmlspecialchars($_GET["p"]) ?: debug_message("<b>placement_id missing</b><br />"));
  $rspn         = (htmlspecialchars($_GET["rspn"]) ?: debug_message("<b>rspn missing</b><br />"));
  $org          = (htmlspecialchars($_GET["org"]) ?: debug_message("<b>org missing</b><br />"));
  $uid          = (htmlspecialchars($_GET["uid"]) ?: debug_message("<b>uid missing</b><br />"));
  $did          = (htmlspecialchars($_GET["did"]) ?: debug_message("<b>did missing</b><br />"));
  $st           = (htmlspecialchars($_GET["st"]) ?: debug_message("<b>st missing</b><br />"));
  $zc           = (htmlspecialchars($_GET["zc"]) ?: debug_message("<b>zc missing</b><br />"));
  $istat        = (htmlspecialchars($_GET["istat"]) ?: debug_message("<b>istat missing</b><br />"));
  $rte          = (htmlspecialchars($_GET["rte"]) ?: debug_message("<b>rte missing</b><br />"));
  $idfa         = (htmlspecialchars($_GET["idfa"]) ?: debug_message("<b>Warning: idfa missing</b><br />"));
  

  function fetchAd($uri)
  {
      global $httpCode;
      $handle = curl_init();

      curl_setopt($handle, CURLOPT_URL, $uri);
      curl_setopt($handle, CURLOPT_POST, false);
      curl_setopt($handle, CURLOPT_BINARYTRANSFER, false);
      curl_setopt($handle, CURLOPT_HEADER, true);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 10);

      $response = curl_exec($handle);
      $hlength  = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
      $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
      $body     = substr($response, $hlength);

      // If HTTP response is not 200, throw exception
      if ($httpCode != 200) {
          throw new Exception($httpCode);
      }

      return $body;
  }

  function debug_message($message)
  {
      global $debugMessage;
      $debugMessage .= "Debug: " . $message;
      return null;
  }

  try {
      $request_url = "http://serve-stg.ansmp.net/w/${publisher}/p/${placement_id}?rspn=${rspn}&org=${org}&uid=${uid}&did=${did}&st=${st}&zc=${zc}&istat=${istat}&rte=${rte}&idfa=${idfa}";
      $response = fetchAd($request_url);
      debug_message("<b>Success!</b><br />");
      $offerHeading = "You have an exciting new offer!";
      error_log("Fetch Ad Success: " . $httpCode . " for " . $request_url);
  } catch (Exception $e) {
      error_log("Fetch Ad failed: " . $e->getMessage() . " for " . $request_url);
      $debugMessage .= "<br />Fetch Ad failed: " . $e->getMessage() . "<br>" . $request_url;
      $offerHeading = "Something went terribly wrong!";
      $response = "<iframe src=\"https://giphy.com/embed/N8wR1WZobKXaE\" width=\"300\" height=\"250\" frameBorder=\"0\" class=\"giphy-embed\" allowFullScreen></iframe>";
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-KJ7TQGD');</script>
  <!-- End Google Tag Manager -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>AnswerMarketplace Offers Test Service</title>
  <link rel="shortcut icon" href="favicon.ico">
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90423861-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-90423861-3');
  </script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJ7TQGD"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <style>
    body {
      background-color: #7874eb;
      color: #404144;
    }

    .webview {
      font-family: Arial, sans-serif;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: start;
    }

    .inner-wrap {
      width: 400px;
      margin-top: 20px;
      padding-bottom: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: start;
      background-color: #fff;
    }

    h1,
    .h1 {
      font-size: 16px;
      margin-top: 40px;
    }

    .ad {
      background-color: whitesmoke;
      box-sizing: border-box;
      width: 300px;
      height: 250px;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .debug {
      position: relative;
      width: 100%;
      height: auto;
      left: auto;
      right: auto;
      margin: 10px 0 2px;
      text-align: center;
      color: #af0e0e;
    }
    .error {
      text-align: left;
      font-size: .8rem;
      width: 300px;
      word-break:break-all;
    }
  </style>

  <body>

    <!-- The Webview -->
    <div class="webview">
      <!-- Debug Request -->
      <div class="debug">
        <?php echo $debugMessage; ?>
      </div>
      <div class="inner-wrap">
        <div class="row">
          <h1 class="h1"><?php echo $offerHeading; ?></h1>
        </div>
        <br>
        <div class="row ad">
          <?php echo $response; ?>
        </div>
      </div>
    </div>
  </body>

</html>
