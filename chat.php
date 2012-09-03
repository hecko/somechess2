<?php 
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
session_start(); 
require_once('loginon.php');
require_once('config.php');
include_once('standard.php');
include_once('constants.php');
$name		= $_SESSION['name'];
$gameID		= validate($_GET['gameID']);
if($chatRefresh)header('refresh: '.$chatRefresh.'; url=chat.php?gameID='.$gameID.'#end');
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>chat</title>
  <style type="text/css">
		body {background:#dbdbdb url("img/boxShadow.gif") repeat-x;font:0.8em Sabon, Georgia, Arial;line-height:1.1em;color:#2F3953;}
		h3, b {font:bold 1em Helvetica, Arial, sans-serif;margin-right:0.7em;display:block}
		.you {color:#476DB7}
		.them {color:#163970}
	</style>
</head>
<body>';
$queryChat		= 'SELECT playerName,text FROM '.dbPre.'chat WHERE gameID="'.$gameID.'" ORDER BY num DESC LIMIT 40';
$resultChat		= mysql_query($queryChat)or die('<div class="error">'.errorDBStr.' (ch-1)</div>');	
$chatNum		= mysql_num_rows($resultChat);
for($c=0;$c<$chatNum;++$c){
	$chatName	= mysql_result($resultChat,$chatNum-($c+1),'playerName');
	$div 		= ($chatName == $name)? 'you':'them';
	if($c == $chatNum-1) $endID = ' id="end" ';
	$text 		.= '
	<p class="'.$div.'"'.$endID.'><b>'.$chatName.'</b> '.mysql_result($resultChat,$chatNum-($c+1),'text').'</p>';
}
echo $text;
?>

</body>
</html>