<?php

/**
 * index.php
 *
 * An insurance offers page intended to measure intent.
 *
 * @author     Jonathon Westbrook
 * @copyright  VSA Partners, Inc. / Arity.com
 * @license    https://www.php.net/license/3_01.txt PHP License 3.0
 */

error_log("Page requested.");

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Content Security Policy -->
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'

    font-src: https://fonts.gstatic.com data:
    font-src: https://use.typekit.net data:
    font-src: https://p.typekit.net data:

    style-src: https://tagmanager.google.com https://fonts.googleapis.com

    script-src: 'unsafe-inline' https://www.google-analytics.com/analytics.js
    script-src: https://tagmanager.google.com
    script-src: https://js-agent.newrelic.com/nr-1130.min.js
    script-src: 'unsafe-inline' https://www.googletagmanager.com

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

  <meta name="robots" content="noindex">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>AnswerMarketplace Offers Test Service</title>
  <link rel="stylesheet" href="https://use.typekit.net/kwz3nzr.css">
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
    @font-face {
      font-family: 'CentraNo2Book';
      src: url('./fonts/CentraNo2-Book.eot');
      src: url('./fonts/CentraNo2-Book.eot?#iefix') format('embedded-opentype'),
        url('./fonts/CentraNo2-Book.woff2') format('woff2'),
        url('./fonts/CentraNo2-Book.woff') format('woff');
    }

    @font-face {
      font-family: 'CentraNo2Bold';
      src: url('./fonts/CentraNo2-Bold.eot');
      src: url('./fonts/CentraNo2-Bold.eot?#iefix') format('embedded-opentype'),
        url('./fonts/CentraNo2-Bold.woff2') format('woff2'),
        url('./fonts/CentraNo2-Bold.woff') format('woff');
    }

    * {
      text-size-adjust: none;
      -webkit-tap-highlight-color: rgba(0,
          0,
          0,
          0);
      -webkit-tap-highlight-color: transparent;
    }

    html,
    body {
      margin: 0;
      max-width: 100%;
      height: auto;
      overflow-x: hidden;
      overflow-y: auto;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      -webkit-text-size-adjust: 100%;
      color: #212121;
      font-family: CentraNo2Book, sans-serif;
      scroll-behavior: smooth;
    }

    .header {
      height: 56px;
      padding: 0 32px;
      background: #7875EB;
      color: #fff;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
    }

    .page-heading {
      font-size: 16px;
      font-weight: 700;
      line-height: 22px;
      margin-left: 8px;
    }

    .webview {
      background: #fff;
      display: flex;
      flex-direction: column;
      align-items: start;
    }

    .inner-wrap {
      padding: 0 32px;
      display: flex;
      flex-direction: column;
      background-color: transparent;
    }

    h1,
    .h1 {
      font-family: 'CentraNo2Bold';
      font-size: 22px;
      margin: 16px 0 0;
    }

    .desc {
      margin: 8px 0 0;
      font-weight: 400;
      font-style: normal;
      font-size: 16px;
      line-height: 22px;
    }

    h3,
    .h3 {
      font-family: 'CentraNo2Bold';
      font-weight: 700;
      margin: 16px 0 0;
    }

    .carrier {
      display: block;
      max-height: 250px;
      max-width: 300px;
      margin: 24px 0 0;
    }

    a>img {
      width: 100%;
      height: 100%;
    }

    .cta {
      display: block;
      margin: 24px 0;
      padding: 0;
      cursor: pointer;
      color: #fff;
      background: #7875EB;
      border-radius: 27px;
      width: 100%;
      height: 54px;
      font-size: 16px;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    hr {
      width: 100%;
      margin: 0;
      border-top: 1px solid #BDBDBD;
    }

    .cta:hover {
      background: #5957B7;
      transition: .25s ease-in-out;
    }

    .btt {
      font-size: 16px;
      line-height: 22px;
      text-align: center;
      color: #7875EB;
      display: inline-block;
      margin-top: 16px;
      margin-bottom: 60px;
    }
  </style>

  <body>
    <a name="top"></a>
    <!-- The Page -->
    <div class="header" role="header">
      <img src="./img/life360-logo-light.svg" alt="The Life360 Logo">
      <p class="page-heading">Welcome Life360 member</p>
    </div>
    <div class="webview" role="main">
      <div class="inner-wrap">

        <h1>Here are two insurance picks just for you</h1>
        <p class="desc">These insurance carriers offer great protection for you and anyone that rides by your side.</p>

        <a class="carrier" aria-label="Save on car insurance with Answer Financial"
          href="https://www.esurance.com/switchandsave?promoid=AFIMA_Offers-Landing-Page-v01"><img class="images"
            src="./img/esuarance-save-on-insurance.png"
            alt="A car insurance offer from Answer Financial - customers save an average of $484 a year." /></a>

        <a class="cta" href="https://www.esurance.com/switchandsave?promoid=AFIMA_Offers-Landing-Page-v01">Get a
          quote</a>

        <hr>

        <a class="carrier" aria-label="Save on car insurance with Answer Financial"
          href="https://www.answerfinancial.com/Auto-Insurance?a=afi_marketplace_web&cid=staticplacement2"><img
            class="images" src="./img/answer-financial-save-on-insurance.png"
            alt="A car insurance offer from Answer Financial - customers save an average of $484 a year." /></a>

        <a class="cta"
          href="https://www.answerfinancial.com/Auto-Insurance?a=afi_marketplace_web&cid=staticplacement2">Get a
          quote</a>

        <hr>

        <a href="#top" class="btt">Back to Top</a>

      </div>
    </div>

    <script>
      const today = new Date();
      const date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + '-' + today.getTime();
      const images = [...document.querySelectorAll('.images')]
      const imagesAppended = images.map(image => {
        image.src += "?c=" + date;
      })
    </script>

  </body>

</html>
