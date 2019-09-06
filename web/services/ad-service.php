<?php

   /**
   * ad-service.php
   *
   * A simple web service that relays a request for an ad.
   *
   * @author     Jonathon Westbrook
   * @copyright  VSA Partners, Inc. / Arity.com
   * @license    https://www.php.net/license/3_01.txt PHP License 3.0
   */

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Content Security Policy -->
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'
    script-src: 'unsafe-inline' https://www.google-analytics.com/analytics.js
    script-src: https://tagmanager.google.com
    font-src: https://fonts.gstatic.com data:
    font-src: https://use.typekit.net data:
    font-src: https://p.typekit.net data:
    script-src: 'unsafe-inline' https://www.googletagmanager.com
    style-src: https://tagmanager.google.com https://fonts.googleapis.com
    img-src: https://ssl.gstatic.com https://www.gstatic.com
    img-src: https://www.google-analytics.com
    img-src: https://www.googletagmanager.com
  ;">

  <!-- Google Tag Manager -->
  <script>(function (w, d, s, l, i) {
      w[l] = w[l] || []; w[l].push({
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl + '&gtm_auth=YbVjed4dvuQxNy4cgKyjYA&gtm_preview=env-11&gtm_cookies_win=x'; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-KJ7TQGD');</script>
  <!-- End Google Tag Manager -->

  <link rel="stylesheet" href="https://use.typekit.net/kwz3nzr.css">
  <meta charset=" UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>AnswerMarketplace Offers Test Service</title>
  <link rel="shortcut icon" href="favicon.ico">

</head>

<body>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe
      src="https://www.googletagmanager.com/ns.html?id=GTM-KJ7TQGD&gtm_auth=YbVjed4dvuQxNy4cgKyjYA&gtm_preview=env-11&gtm_cookies_win=x"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Inline Stylesheet -->
  <style>
    body {
      margin: 0;
      color: #fff;
      font-family: futura-pt, sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    .webview {
      background: linear-gradient(130deg, rgba(241, 88, 42, 1) 0%, rgba(128, 39, 193, 1) 85%, rgba(128, 39, 193, 1) 100%);
      height: 100vh;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: start;
    }

    .inner-wrap {
      max-width: 400px;
      margin-top: 20px;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: start;
      background-color: transparent;
    }

    h1,
    .h1 {
      font-size: 22px;
      margin-top: 40px;
      font-weight: 400;
    }

    .ad {
      box-sizing: border-box;
      max-width: 320px;
      max-height: 270px;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>

  <body>

    <!-- The Page -->
    <div class="webview" role="main">
      <div class="inner-wrap">
        <h1>Etiam Tortor Cras Ligula Parturient?</h1>
        <div class="row ad">
          <a aria-label="Save on car insurance with Answer Financial"
            href="http://event-stg.ansmp.net/w/503251/p/2c90808a6ac7a71c016c019d74cc0013/click?c=2c90808a6121f7350161255ee03c0000&cost=5.00&share=0.00&model=A6&asset=8b3e69be69824c14a22eb33bdbb2054a&istat=1&uid=cQV88N3RsHs4PDIoi6fUKQ%3D%3D&st=DC&rte=1&org=1234&idfa=6D92078A-8246-4BA4-AE5B-76104861E7DC&zc=20012&rspn=html&did=Tester01&targeturl=238675B9CA4EDC252D8EA61286AC860458C8FFDC20572E13D2503BBBEFA5EE067CE610DE5D184ADF988D0CB03AE81E767070DC343D99B79858B3359B2B239332E484BB5C4D29D4F232E4AEBD6B4040D0D416172747385FCBBDD01FF4B2897F11472BA4A36A228B0FD9E77B8403B930D5ED712019D65F8BDDADAB9C3FE2B56565"><img
              src="./img/8b3e69be69824c14a22eb33bdbb2054a.png"
              alt="A car insurance offer from Answer Financial - customers save an average of $484 a year." width="100%"
              height="100%" /></a>
        </div>
      </div>
    </div>

  </body>

</html>
