<?php

// for get slug name
function get_current_slug()
{  
   $gethomeurl = get_home_url();
   $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $getslugname = str_replace($gethomeurl, '', $actual_link);
   $rmslash = preg_replace('|/|', '', $getslugname);
   return $rmslash;
}


?>