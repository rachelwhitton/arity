<?php

namespace App\Theme;

use function App\Theme\template;

session_start();
echo session_id();
$_SESSION['popup'] = 'true';

echo "popup";
echo '<pre>'; print_r($_SESSION); echo '</pre>';