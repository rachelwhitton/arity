<?php
namespace App\Theme;

use function App\Theme\template;

header("Access-Control-Allow-Origin: *");
echo do_shortcode('[geoip_detect2 property="country.isoCode"]');
//echo 'GB';