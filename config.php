<?php
// used to construct mail domain and web URL
$domain		= $_SERVER['SERVER_NAME'];
$homeFolder	= '/somechess2/';
// DB config
$host		= 'localhost'; 		// host name of database (usually it's localhost)
$dbUser		= 'somechess';		// username for DB
$dbPass		= 'parajko';		// password for DB
$database	= 'somechess';		// DB name (suggested name is somechess, but you can change it of course)
$dbPre		= '';			// add a prefix to Some Chess table names (optional)
$lang		= 'en';			// language Some Chess uses
$firstrun	= false;		// DO NOT EDIT THIS LINE
$playerImgDir	= 'playerImg';		//player images directory
$emailMove	= true;
mysql_connect($host,$dbUser,$dbPass);
mysql_select_db($database) or die('<br>ERROR: can\'t connect to database<br>'.mysql_error());
?>
