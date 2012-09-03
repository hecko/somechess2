<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
session_start();
require_once('loginon.php');
require_once('config.php');
require_once('standard.php');
require_once('constants.php');
include_once('languages/'.$lang.'_main.php');
$gameID			= validate($_POST['gameID']);
$queryPGN		= 'SELECT * FROM '.dbPre.'complete WHERE gameID="'.$gameID.'" LIMIT 1';
$resultPGN		= mysql_query($queryPGN)or die('<div class="error">'.$queryPGN.'<br>'.errorDBStr.' (ex-1)</div>');
if(mysql_num_rows($resultPGN)==1){
	$pgn		= mysql_result($resultPGN,0,'pgn');
}else{	
	include_once('gameFunc.php');
	$pgn		= movesToPGN($gameID,true);
}
$white			= preg_replace('/[\.\D\S\W]*\[white "/i','',$pgn);
$white			= preg_replace('/"\][\.\D\S\W]*/','',$white);			
$black			= preg_replace('/[\.\D\S\W]*\[black "/i','',$pgn);
$black			= preg_replace('/"\][\.\D\S\W]*/','',$black);
$players		= $white.' VS '.$black;
$players		= str_replace(' ','_',$players);

Header('Content-disposition: attachment; filename=SomeChess_game#'.$gameID.'_'.$players.'.pgn');
Header('Content-type: application/x-chess-pgn');
echo $pgn;
?>