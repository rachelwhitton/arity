<?php
header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
namespace App\Theme;

use function App\Theme\template;

session_start();
$_SESSION['myCookie'] = $_GET['myCookie'];
$_SESSION['id'] = session_id();
if ($_SESSION['showPopup'] == ''){
    $_SESSION['showPopup'] = 1;
}

//https://dev.arity/popup/?a=update&showPopup=0
if ($_GET['a'] == 'update'){
    $_SESSION['showPopup'] = $_GET['showPopup'];
}

//https://dev.arity/popup/?a=destroy
if ($_GET['a'] == 'destroy'){
    session_destroy();
}

echo json_encode($_SESSION);