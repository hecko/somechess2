<?php 
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
session_start(); 
require_once('loginon.php');
require_once('config.php');
include_once('languages/'.$lang.'_chess.php');
include_once('standard.php');
include_once('constants.php');
$do = ($_POST['do']) ? $_POST['do'] : $_GET['do'];
$gameID = ($_POST['gameID']) ? $_POST['gameID'] : validate($_GET['gameID']);
$vsName				 	= str_replace('_',' ',$_GET['vs']);
if(!$vsName)$vsName		= $_SESSION['vs'.$gameID];
$query				= 'SELECT * FROM '.dbPre.'games WHERE gameID="'.$gameID.'" LIMIT 1';
$result				= mysql_query($query)or die('<div class="error">'.errorDBStr.' (bg-1)</div>');	
$locations			= unserialize(mysql_result($result,0,'setup'));
$bID				= mysql_result($result,0,'blackPlayerID');
$wID				= mysql_result($result,0,'whitePlayerID');
$oppID		 		= ($_SESSION['id'] == $bID)? $wID : $bID;
$playerColor		= ($_SESSION['id'] == $bID)? 'black' : 'white';
if($do == 'move'){
	$clickedSQ			 	 	= validate($_GET['sq']);
	if($_SESSION['oldSpot'.$gameID]){
		$oldSpot 			 	= validate($_SESSION['oldSpot'.$gameID]);
		$newSpot 			 	= $clickedSQ;
		if(!$newSpot)$newSpot 	= validate($_POST['newSpot']);
		unset($_SESSION['oldSpot'.$gameID]);
	}elseif($clickedSQ){
		$nTC					= mysql_result($result,0,'nextTurnColor');
		if($playerColor == $nTC && $locations[$clickedSQ])$_SESSION['oldSpot'.$gameID] = validate($clickedSQ);
		$do					 	= 'display';
	}
}
if($do == 'move'){
	include_once('move.php');
	$promote			= $_POST['promote'];
	$canCastle			= ($_SESSION['id'] == $bID)? unserialize(mysql_result($result,0,'bCastle')):unserialize(mysql_result($result,0,'wCastle'));
	$nextMoveNum		= mysql_result($result,0,'nextMoveNum');
	$lastMove			= unserialize(mysql_result($result,0,'lastMove'));
	print_r($lastMove);
	$theMove			= moveIt($locations,$oldSpot,$newSpot,$nextMoveNum,$gameID,$canCastle,$playerColor,$lastMove,$promote,$lang,$oppID,$emailMove);
	if($theMove !== 'redo') $locations = $theMove;
	$result				= mysql_query($query)or die('<div class="error">'.errorDBStr.' (bg-2)</div>'); //refresh the result with the new info after moving
	$do 				= 'display';
}
if($do == 'display'){
	include_once('display.php');	
	$reqDraw			= mysql_result($result,0,'reqDraw');
	$reqUndo			= mysql_result($result,0,'reqUndo');
	$lastMove			= unserialize(mysql_result($result,0,'lastMove'));
	if($reqUndo == $_SESSION['id']){
		$message = '<p>'.$infoBoxStr[10].'</p>';
		$undoB = 0;
	}elseif($reqUndo){
		$message = '<p>'.$infoBoxStr[9].'</p>';
		$undoB = 2;
	}
	if($reqDraw == $_SESSION['id']){
		$message .= '<p>'.$infoBoxStr[8].'</p>';
		$undoD = 0;
	}elseif($reqDraw){
		$message .= '<p>'.$infoBoxStr[7].'</p>';
		$undoD = 2;
	}
	if(mysql_result($result,0,'nextTurnColor') == $playerColor){
		$turn = $boardStr[0];
		if(strpos($lastMove['move'],'+') !== false) $message 	.= '<p>'.$infoBoxStr[6].'</p>';
		if(strpos($lastMove['move'],'#') !== false) $message 	= '<p>'.$gameOverStr[0].'</p>';
	}else{
		$undoB	= ($undoB === 0)? null : 1;
		$turn = $boardStr[1].$vsName.$boardStr[2];
		if(strpos($lastMove['move'],'#') !== false) $message 	.= $gameOverStr[1];
		if($boardRefresh && strpos($lastMove['move'],'#') === false) @header('refresh: '.$boardRefresh.'; url=board.php?do=display&gameID='.$gameID);
	}
	echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>board</title>
<link rel="stylesheet" type="text/css" href="board.css">
</head>
<body>';
	if($_SESSION['oldSpot'.$gameID]){ $moving = '<p>'.$infoBoxStr[15].$_SESSION['oldSpot'.$gameID].$infoBoxStr[16].'</p>'; unset($message);}
	displayBoard($locations,$playerColor,$gameID);
	if(mysql_result($result,0,'gameDate')<$_SESSION['endDate'] && $endDays) $endB = true;
	include_once('info.php');
}
$_SESSION['vs'.$gameID] = $vsName;
unset($undoB);
?>
</body>
</html>
