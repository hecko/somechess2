<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
header('Content-type: text/xml');
putenv('TZ=GMT');
echo'<?xml version="1.0" encoding="ISO-8859-1" ?>
<?xml-stylesheet type="text/css" href="../rss.css" ?>
<rss version="2.0">';
require_once('config.php');
include_once('standard.php');
include_once('constants.php');
echo'<channel>
<title id="main">Some Chess</title>
<link>http://'.$domain.$homeFolder.'</link>
<description></description>
<lastBuildDate>',substr(date(r),0,-5),'GMT</lastBuildDate>
<language>en-us</language>
';
$entry		= explode('/', $_SERVER['REQUEST_URI']);
$varIndx	= count($entry)-1;
$name		= str_replace('-',' ',validate($entry[$varIndx]));
if($name){
	$queryPlayers		= 'SELECT * FROM '.dbPre.'players WHERE name="'.$name.'" LIMIT 1';
	$resultPlayers		= mysql_query($queryPlayers)or die('error');
	$num				= mysql_numrows($resultPlayers);
}else{
	$stop = true;
	echo'<item>
<title>A username is needed</title>
<pubDate>',substr(date(r),0,-5),'GMT</pubDate>
<description>username error</description>
</item>';
}
if($num>0){
	$id					= validate(mysql_result($resultPlayers,0,'id'));
	$queryVS			= 'SELECT * FROM '.dbPre.'players WHERE id!="'.$id.'" AND invitedBy > -2';
	$resultVS			= mysql_query($queryVS)or die('error');
	$numVS				= mysql_num_rows($resultVS);
	for($i=0;$i<$numVS;++$i){
		$key			= mysql_result($resultVS,$i,'id');
		$oppID[$i]		= $key;
		$oppName[$key]	= mysql_result($resultVS,$i,'name');
	}
	$queryGames			= 'SELECT * FROM games WHERE winner="0"  AND (whitePlayerID='.$id.' OR blackPlayerID='.$id.')';
	$resultGames		= mysql_query($queryGames)or die('error');	
	$gamesNum			= mysql_num_rows($resultGames);
	$tooOld 			= date(YmdHi, mktime(0, 0, 0, date(m), date(d)-5, date(Y)));
	for($i=0;$i<$gamesNum;++$i){
		unset($draw,$hide);
		$gameID			= mysql_result($resultGames,$i,'gameID');
		$bID			= mysql_result($resultGames,$i,'blackPlayerID');
		$wID			= mysql_result($resultGames,$i,'whitePlayerID');
		$nTC			= mysql_result($resultGames,$i,'nextTurnColor');
		$last			= unserialize(mysql_result($resultGames,$i,'lastMove'));
		$lastMove		= $last['move'];
		$draw			= mysql_result($resultGames,$i,'reqDraw');	
		if($draw)$draw 	= ' (a draw has bee proposed)'; else $draw = '';
		if(mysql_result($resultGames,$i,'gameDate')<$tooOld) $hide = true;
		if($bID == $id){ $playerColor = 'black'; $opp = $oppName[$wID]; }else{ $playerColor = 'white'; $opp = $oppName[$bID]; }
	
		if($nTC == $playerColor && $hide != true){
		++$gameCount; 
echo'
<item>
<title>Move for Game#',$gameID,' (',$playerColor,') Vs. ',$opp,'</title>
<pubDate>',substr(date(r),0,-5),'GMT</pubDate>
<description>It is your turn, the latest move was: ',$lastMove,$draw,'</description>
<link>http://'.$domain.$homeFolder.'</link>
</item>
';
		}
	}
}elseif(!$stop){
	echo'<item>
<title>That user doesn\'t exist</title>
<pubDate>',substr(date(r),0,-5),'GMT</pubDate>
<description>username error</description>
</item>';
}
?>

</channel>
</rss>