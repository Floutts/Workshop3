<?php

define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'login8034'); 
define('DB_PASSWORD', 'HjKNMemRsNWglQV'); 
define('DB_NAME', 'Workshop-B3'); 

// Google API configuration 
define('GOOGLE_CLIENT_ID', '453611261324-4018diiglbck1ibfo5me7g7flh6a68e3.apps.googleusercontent.com'); 
define('GOOGLE_CLIENT_SECRET', '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'); 
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/drive'); 
define('REDIRECT_URI','(https://s4-8034.nuage-peda.fr/Workshop3/src/controleur/google_drive_sync.php)');
 
// Start session 
if(!session_id()) session_start(); 
 
// Google OAuth URL 
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' 
. REDIRECT_URI . '&response_type=code&client_id=' . GOOGLE_CLIENT_ID . '&access_type=online'; 

?>