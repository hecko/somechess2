<?php 
//	Some Chess, a PHP multi-player chess server.
//    Copyright (C) 2007 Jon Link
session_start(); 
require_once('loginon.php');
require_once('config.php');
include_once('languages/'.$lang.'_main.php');
include_once('constants.php');
include_once('standard.php');

/*----- CONFIG STATS -----*/
	$showIP		= 1;
	$showGames	= 1;
	$showWins	= 1;
	$showLoses	= 0;
	$showDraws	= 1;
	$showWinAvg	= 0;
	$showPoints = 1;
	$statsJoke 	= 0;
/*--- END CONFIG STATS ---*/

$do				= $_POST['do'];
if(!$do) $do	= $_GET['do'];
$statID			= $_GET['statID'];
$statLink		= ($statID)? '&statID='.$statID : null;
$ordering		= $_GET['ordering'];
$orderLink		= ($ordering)? '&ordering='.$ordering : null;
echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<title>Some Chess</title>
	<link rel="stylesheet" type="text/css" href="somechess.css">
	<style type="text/css">
		#records {margin:0 0 1.5em .2em;height:19em;width:34em;overflow:auto;clear:both;display:block;}
		#leaderboard {margin:0 0 1.5em .2em;height:18.5em;width:26em;overflow:auto;clear:both;display:block;}
		.namelabel, a.names {float:left;width:11.2em}
		.stat {float:left;width:3.2em}
		.stat_medium {width:4.5em}
		.stat_wide {width:6.5em}
		.light_row {background:#c3c3c3}
		a.names {text-decoration:none}
		p {margin:0.25em 0 1em 0}
		#records p {margin-bottom:0.25em}
		h2 {margin:0 0 1em}
		h3 {margin:0}
		h5 {padding:0;font-size:0.9em;font-weight:700;margin:0;}
		.col1 {float:left;width:8em;}
		.playerbar, .avgbar {background:#6699cc;border:1px solid #336699;height:0.87em;}
		.avgbar {background:#3366cc;border:1px solid #003366;"}
	</style>
</head>
<body>
<div id="menu"><p>Some Chess</p>',$menu,'</div>
<div id="container" style="width:67em">';

online();
include_once('playersFunc.php');
if($do =='players' || !$do){ 
//--display stats
	$order	= array('wins'=>'wins','loses'=>'loses','draws'=>'draws','points'=>'points','online'=>'lastOnline');
	$ordering			= (key_exists($ordering,$order))? $order[$ordering].' DESC' : 'name';

	$queryPlayer		= 'SELECT * FROM '.dbPre.'players WHERE invitedBy > -2 ORDER BY '.$ordering;	
	$resultPlayer		= mysql_query($queryPlayer)or die('<div class="error">'.errorDBStr.' (pl-2)</div>');
	$numPlayer			= mysql_num_rows($resultPlayer);

	$queryGames			= 'SELECT * FROM '.dbPre.'games WHERE winner!="0"';
	$resultGames		= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (pl-3)</div>');
	$numGames			= mysql_num_rows($resultGames);

	$queryGamesIP		= 'SELECT * FROM '.dbPre.'games WHERE winner="0"';
	$resultGamesIP		= mysql_query($queryGamesIP)or die('<div class="error">'.errorDBStr.' (pl-4)</div>');
	$numGamesIP			= mysql_num_rows($resultGamesIP);

	echo '
		<div class="menubox" style="float:left;height:42em;width:35em;">
		<h2 style="margin-bottom:0">'.$statsStr[0].'</h2>
		<h2>
			<a href="players.php?ordering=names'.$statLink.'" class="namelabel">'.$statsStr[1].'</a>
			<a href="players.php?ordering=wins'.$statLink.'" class="stat">'.$statsStr[2].'</a>
			<a href="players.php?ordering=loses'.$statLink.'" class="stat">'.$statsStr[3].'</a>
			<a href="players.php?ordering=draws'.$statLink.'" class="stat">'.$statsStr[4].'</a>
			<a href="players.php?ordering=points'.$statLink.'" class="stat stat_medium">'.$statsStr[17].'</a>
			<a href="players.php?ordering=online'.$statLink.'" class="stat stat_wide">'.$statsStr[19].'</a>
		</h2>
		';
	for($i=0;$i<$numPlayer;++$i){
		$fod		= array();
		$nem		= array();
		unset($fodGo,$nemGo,$gamesIP);
		$playerID = mysql_result($resultPlayer,$i,'id');
		for($x=0;$x<$numGames;++$x){
			if(mysql_result($resultGames,$x,'winner') == $playerID){ 
				if(mysql_result($resultGames,$x,'whitePlayerID') != $playerID){
					$fod[mysql_result($resultGames,$x,'whitePlayerID')] == ++$fod[mysql_result($resultGames,$x,'whitePlayerID')];
				}else{
					$fod[mysql_result($resultGames,$x,'blackPlayerID')] == ++$fod[mysql_result($resultGames,$x,'blackPlayerID')];
				}
				$fodGo = true;
			}
			if(mysql_result($resultGames,$x,'winner') == 'D' && (mysql_result($resultGames,$x,'whitePlayerID') == $playerID || mysql_result($resultGames,$x,'blackPlayerID') == $playerID)) ++$draws;
			if(mysql_result($resultGames,$x,'winner') != $playerID && mysql_result($resultGames,$x,'winner') != 'D' && mysql_result($resultGames,$x,'winner') != 'X' && (mysql_result($resultGames,$x,'whitePlayerID') == $playerID || mysql_result($resultGames,$x,'blackPlayerID') == $playerID)){ 
				$nem[mysql_result($resultGames,$x,'winner')] == ++$nem[mysql_result($resultGames,$x,'winner')];
				$nemGo = true;
			}
		}
		if($fodGo){
			$fodMax				 = max($fod);
			$stats[$i]['fod']	= array_search($fodMax,$fod);
		}
		if($nemGo){
			$nemMax 			= max($nem);
			$stats[$i]['nem']	= array_search($nemMax,$nem);
		}
		for($x=0;$x<$numGamesIP;++$x){
			if(mysql_result($resultGamesIP,$x,'whitePlayerID') == $playerID || mysql_result($resultGamesIP,$x,'blackPlayerID') == $playerID) ++$gamesIP;
		}
		$stats[$i]['id'] 		= $playerID;
		$stats[$i]['pic'] 		= mysql_result($resultPlayer,$i,'pic');;
		$stats[$i]['name'] 		= mysql_result($resultPlayer,$i,'name');
		$stats[$i]['realname'] 	= mysql_result($resultPlayer,$i,'realname');
		$stats[$i]['location'] 	= mysql_result($resultPlayer,$i,'location');
		$stats[$i]['addDate'] 	= formatDate(mysql_result($resultPlayer,$i,'addDate'));
		$stats[$i]['invitedBy'] = mysql_result($resultPlayer,$i,'invitedBy');
		$stats[$i]['lastOnline'] = date("d M y H:i",mysql_result($resultPlayer,$i,'lastOnline'));
		$stats[$i]['wins'] 		= mysql_result($resultPlayer,$i,'wins');
		$stats[$i]['loses'] 	= mysql_result($resultPlayer,$i,'loses');
		$stats[$i]['draws'] 	= mysql_result($resultPlayer,$i,'draws');
		$stats[$i]['points'] 	= round(mysql_result($resultPlayer,$i,'points'));
		$stats[$i]['gamesIP'] 	= $gamesIP;
		$stats[$i]['games']		= ($stats[$i]['loses']) + ($stats[$i]['wins']) + ($stats[$i]['draws']);
		if($stats[$i]['wins'] > 0){
			$stats[$i]['winAvg']	= number_format(str_replace('.','',number_format(($wins / $stats[$i]['games']),2)));
		}else{
			$stats[$i]['winAvg']	= '0.0';
		}
		if($stats[$i]['loses'] > 0){
			$stats[$i]['loseAvg']	= number_format(str_replace('.','',number_format(($loses / $stats[$i]['games']),2)));
		}else{
			$stats[$i]['loseAvg']	= '0.0';
		}
		if($stats[$i]['draws'] > 0){
			$stats[$i]['drawAvg']	= number_format(str_replace('.','',number_format(($draws / $stats[$i]['games']),2)));
		}else{
			$stats[$i]['drawAvg']	= '0.0';
		}
		$color = ($i%2)? ' light_row' : null;
		$playerRecords .= '<p><a class="names'.$color.'" href="players.php?statID='.$stats[$i]['id'].$orderLink.'">'.$stats[$i]['name'].'</a><div class="stat'.$color.'">'.$stats[$i]['wins'].'</div><div class="stat'.$color.'">'.$stats[$i]['loses'].'</div><div class="stat'.$color.'">'.$stats[$i]['draws'].'</div><div class="stat stat_medium'.$color.'">'.$stats[$i]['points'].'</div><div class="stat stat_wide'.$color.'">'.$stats[$i]['lastOnline'].'</div></p>
		';
	}
	echo '<div id="records">',$playerRecords,'</div>
	<div id="leaderboard">';
//-- PACK LEADERS
	if($showIP)echo'<p><h5>'.$statsStr[6].'</h5>'.mostStat('gamesIP',$stats,$numPlayer,$statsStr,$orderLink).'</p>';
	if($showGames)echo'<p><h5>'.$statsStr[7].'</h5>'.mostStat('games',$stats,$numPlayer,$statsStr,$orderLink).'</p>';
	if($showWins)echo'<p><h5>'.$statsStr[8].'</h5>'.mostStat('wins',$stats,$numPlayer,$statsStr,$orderLink).'</p>';
	if($showLoses)echo'<p><h5>'.$statsStr[9].'</h5>'.mostStat('loses',$stats,$numPlayer,$statsStr,$orderLink).'</p>';
	if($showDraws)echo'<p><h5>'.$statsStr[10].'</h5>'.mostStat('draws',$stats,$numPlayer,$statsStr,$orderLink).'</p>';
	if($showWinAvg)echo'<p><h5>'.$statsStr[11].'</h5>'.mostStat('winAvg',$stats,$numPlayer,$statsStr,$orderLink,'%').'</p>';
	if($showPoints)echo'<p><h5>'.$statsStr[18].'</h5>'.mostStat('points',$stats,$numPlayer,$statsStr,$orderLink).'</p>';
	if($statsJoke)echo randomStat($stats,$numPlayer,rand(2,5));
	echo'</div></div>';

//-- PLAYER SPECIFIC INFO
	for($i=0;$i<$numPlayer;++$i){
		if($stats[$i]['id'] == $statID){ $key = $i;break; }
	}
	if($statID && isset($key)){	
		$avg['wins'] 	= average('wins',$stats,$numPlayer);
		$avg['loses']	= average('loses',$stats,$numPlayer);
		$avg['draws']	= average('draws',$stats,$numPlayer);
		$avg['gamesIP']	= average('gamesIP',$stats,$numPlayer);
		$avg['games']	= average('games',$stats,$numPlayer);
		for($i=0;$i<$numPlayer;++$i){
			if($stats[$key]['invitedBy'] == $stats[$i]['id']) $invitedBy 		= $stats[$i]['name'];
			if($stats[$key]['invitedBy'] == $stats[$i]['id']) $invitedByLink 	= 'href="players.php?statID='.$stats[$i]['id'].'"';

			if($stats[$key]['fod'] == $stats[$i]['id']) $fodName = $stats[$i]['name'];
			if($stats[$key]['fod'] == $stats[$i]['id']) $fodLink = 'href="players.php?statID='.$stats[$i]['id'].'"';

			if($stats[$key]['nem'] == $stats[$i]['id']) $nemName = $stats[$i]['name'];
			if($stats[$key]['nem'] == $stats[$i]['id']) $nemLink = 'href="players.php?statID='.$stats[$i]['id'].'"';
		}
		echo '<div class="menubox" style="float:left;height:42em;width:28em;">
		<img src="',$playerImgDir,'/',$stats[$key]['pic'],'" alt="player image" style="float:right;border:1px solid #596D84" />
		<div style="float:left;">
			<h2>',$statsStr[12],'</h2>
			<h3>',$stats[$key]['name'],' (',$statsStr[13],': ',noEmpty($stats[$key]['realname']),')</h3><br />
			<div style="width:75px;float:left;">',$statsStr[14],': </div>',noEmpty($stats[$key]['location']),'<br />
			<div style="width:75px;float:left;">',$statsStr[15],': </div>',noEmpty($stats[$key]['addDate']),'<br />'; 
		if($invitedBy) echo'<div style="width:75px;float:left;">',$statsStr[16],': </div><a '.$invitedByLink.'>',$invitedBy,'</a><br />';
		echo'<div style="width:75px;float:left;">',$statsStr[19],': </div>',noEmpty($stats[$key]['lastOnline']),'
		</div>
		<!-- BAR GRAPHS -->
		<div style="margin-top:1em;height:15.5em;float:left;">
			<div style="width:7em;float:left;text-align:right;padding-right:5px">
				<h5>Wins</h5>
				<h5>Avg Wins</h5>
				<br />
	
				<h5>Loses</h5>
				<h5>Avg Loses</h5>
				<br />
				
				<h5>Draws</h5>
				<h5>Avg Draws</h5>
				<br />
				
				<h5>Games IP</h5>
				<h5>Avg Games IP</h5>
				<br />
	
				<h5>Games</h5>
				<h5>Avg Games</h5>
			</div>
		
			<div style="width:20em;float:left;">
				<div class="playerbar" style="width:'.barWidth($stats[$key]['wins'],$avg['wins'],'p').'px;"></div>
				<div class="avgbar" style="width:'.barWidth($stats[$key]['wins'],$avg['wins'],'a').'px;"></div>
				
				<br />
				<div class="playerbar" style="width:'.barWidth($stats[$key]['loses'],$avg['loses'],'p').'px;"></div>
				<div class="avgbar" style="width:'.barWidth($stats[$key]['loses'],$avg['loses'],'a').'px;"></div>
				
				<br />
				<div class="playerbar" style="width:'.barWidth($stats[$key]['draws'],$avg['draws'],'p').'px;"></div>
				<div class="avgbar" style="width:'.barWidth($stats[$key]['draws'],$avg['draws'],'a').'px;"></div>
				
				<br />
				<div class="playerbar" style="width:'.barWidth($stats[$key]['gamesIP'],$avg['gamesIP'],'p').'px;"></div>
				<div class="avgbar" style="width:'.barWidth($stats[$key]['gamesIP'],$avg['gamesIP'],'a').'px;"></div>
	
				<br />
				<div class="playerbar" style="width:'.barWidth($stats[$key]['games'],$avg['games'],'p').'px;"></div>
				<div class="avgbar" style="width:'.barWidth($stats[$key]['games'],$avg['games'],'a').'px;"></div>					
			</div>
		</div>
		<!-- QUICK STATS -->
		<div style="width:96%;border:1px solid #596D84;padding:0.4em;float:left;margin-top:2em;">
			<span class="col1">'.$statsStr[20].':</span>',noEmpty($stats[$key]['winAvg']),'%<br />
			<span class="col1">'.$statsStr[21].':</span>',noEmpty($stats[$key]['loseAvg']),'%<br />
			<span class="col1">'.$statsStr[22].':</span>',noEmpty($stats[$key]['drawAvg']),'%<br />
			<span class="col1">'.$statsStr[23].':</span>',noEmpty($stats[$key]['games']),'<br />
			<span class="col1">'.$statsStr[24].':</span>',noEmpty($stats[$key]['gamesIP']),'<br />
			<span class="col1">'.$statsStr[25].':</span><a '.$fodLink.'>',noEmpty($fodName),'</a><br />
			<span class="col1">'.$statsStr[26].':</span><a '.$nemLink.'>',noEmpty($nemName),'</a><br />
		</div>
	</div>';
	}
}
?>

</div>
</body>
</html>
