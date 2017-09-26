<?php
/** Development */
/** This is what displays the funny PHP errors. Add WP_DEBUG=false to your .env file if you want to disable. Do NOT edit this line directly.  */
define('WP_DEBUG', env('WP_DEBUG') !== null ? env('WP_DEBUG') : true );
