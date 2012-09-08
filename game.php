<?php 
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
session_start();
require_once('loginon.php');
require_once('config.php');
include_once('languages/'.$lang.'_main.php');
include_once('constants.php');
include_once('standard.php');
$_SESSION['endDate']	= date(YmdHis, mktime(0, 0, 0, date(m), date(d)-$endDays, date(Y)));
$do = ($_POST['do']) ? $_POST['do'] : $_GET['do'];
$status	= validate($_GET['status']);
$gameID = ($_POST['gameID']) ? $_POST['gameID'] : validate($_GET['gameID']);
$vsName	= $_GET['vs'];
online(); //update persons online status
echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Some Chess</title>
	<link rel="stylesheet" type="text/css" href="somechess.css">
	</head>
	<body>
	<div id="menu"><p>Some Chess</p>',$menu,'</div>';
	if($status !== 'view'){
		echo'<iframe src="board.php?gameID=',$gameID,'&amp;do=',$do,'&amp;vs=',$vsName,'" frameborder="0" allowtransparency="true" id="board">
		<h3>'.$gameStr[0].'</h3>
		</iframe>';
	} else {
		if($_GET['move'])$move		= '&amp;move='.$_GET['move'];
		if($_GET['player'])$player	= '&amp;player='.$_GET['player'];
		echo'<iframe src="view.php?gameID=',$gameID,'&amp;status=',$status,$move,$player,'" frameborder="0" allowtransparency="true" id="board">
		<h3>'.$gameStr[0].'</h3>
		</iframe>';
	}
	if(!$status && $showChat){
		echo'<div id="chat_panel">
		<iframe src="chat.php?gameID=',$gameID,'#end" frameborder="0" allowtransparency="true" id="chat">
			<h3>'.$gameStr[1].'</h3>
		</iframe>';
		echo'</div>
		<form action="game.php?do=display&amp;gameID=',$gameID,'&amp;vs=',$vsName,'" method="post" id="chatter">
			<input type="text" name="chat" autocomplete="off" id="chatIn" />
			<input type="hidden" name="gameID" value="',$gameID,'" />
			<input type="hidden" name="act" value="chat" />
			<input type="submit" value="Chat" class="chat_butt" />
		</form>
		</div>';
	}
$act			= $_POST['act'];
if($act == 'chat'){
	$chat		= validate($_POST['chat']);
	$name		= validate($_SESSION['name']);	
	$queryChat	= 'SELECT gameID FROM '.dbPre.'chat WHERE gameID="'.$gameID.'"'; 
	$resultChat	= mysql_query($queryChat)or die('<div class="error">'.errorDBStr.' (sc-1)</div>');	
	$nextChat	= mysql_num_rows($resultChat)+1;	
	$queryChat	= 'INSERT INTO '.dbPre.'chat (gameID,playerName,num,text) VALUES ("'.$gameID.'","'.$name.'","'.$nextChat.'","'.$chat.'")';
	$resultChat	= mysql_query($queryChat)or die('<div class="error">'.errorDBStr.' (sc-2)</div>'.$queryChat);	
}
$vsName			= str_replace('_',' ',$vsName);
if($showPlayerImg && $status !=='view'){
	$queryVS			= 'SELECT * FROM '.dbPre.'players WHERE name="'.$vsName.'" LIMIT 1';
	$resultVS			= mysql_query($queryVS)or die('<div class="error">'.errorDBStr.' (ui-1)</div>');
	$VSpic				= mysql_result($resultVS,0,'pic');
	$vsMargin			= 3;
}
$query				 = 'SELECT * FROM '.dbPre.'games WHERE gameID="'.$gameID.'" LIMIT 1';
$result				 = mysql_query($query)or die('<div class="error">'.errorDBStr.' (gg-1)</div>');	
$bID				 = mysql_result($result,0,'blackPlayerID');
$wID				 = mysql_result($result,0,'whitePlayerID');
if($_SESSION['id'] == $bID){
	$playerColor = 'black'; $oppColor='white';
	$displayPlayerColor=$colorStr[1]; $displayOppColor=$colorStr[0];
}elseif($_SESSION['id'] == $wID){
	$playerColor = 'white'; $oppColor='black';
	$displayPlayerColor=$colorStr[0]; $displayOppColor=$colorStr[1];
}
if(!$showChat){
	echo '<div id="picframe_b">';
}elseif(!$status){
	echo '<div id="picframe_a">';
}
if($status !=='view'){
	echo'<div class="name">';
	if($showPlayerImg) echo'<img src="'.$playerImgDir.'/'.$_SESSION['pic'].'" alt="" class="pic" />';
	echo'<p>'.$_SESSION['name'].'</p>('.$displayPlayerColor.')
	</div>
	<div style="width:20%;margin-top:'.$vsMargin.'em;float:left;text-align:center;font-weight:700;">Vs. </div>
	<div class="name">';
	if($showPlayerImg) echo'<img src="'.$playerImgDir.'/'.$VSpic.'" alt="" class="pic" />';
	echo'<p>'.$vsName.'</p>('.$displayOppColor.')
		</div>
	</div>';
}else{
	$queryNames		= 'SELECT whitePlayerID, blackPlayerID FROM '.dbPre.'games WHERE gameID="'.$gameID.'"';
	$resultNames	= mysql_query($queryNames)or die('<div class="error">'.errorDBStr.' (gg-2)</div>');
	$whiteID		= mysql_result($resultNames,0,'whitePlayerID');
	$blackID		= mysql_result($resultNames,0,'blackPlayerID');
	$queryNames		= 'SELECT name FROM '.dbPre.'players WHERE id="'.$whiteID.'"';
	$resultNames	= mysql_query($queryNames)or die('<div class="error">'.errorDBStr.' (gg-3)</div>');
	$whiteName		= mysql_result($resultNames,0,'name');
	$queryNames		= 'SELECT name FROM '.dbPre.'players WHERE id="'.$blackID.'"';
	$resultNames	= mysql_query($queryNames)or die('<div class="error">'.errorDBStr.' (gg-4)</div>');
	$blackName		= mysql_result($resultNames,0,'name');
	echo '<div id="picframe_c"><b>'.$whiteName.'</b> ('.$colorStr[0].')<br />VS.<br /> <b>'.$blackName.'</b> ('.$colorStr[1].')</div>';
}
?>
</body>
</html>
