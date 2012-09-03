<?php 
session_start(); 
/***************************************************************************************
** "Some Chess" some rights reserved 2007
** Some Chess written by Jon Linklocation
** 
** This library is free software; you can redistribute it and/or
** modify it under the terms of the GNU Lesser General Public
** License as published by the Free Software Foundation; either
** version 2.1 of the License, or (at your option) any later version.
** 
** This library is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
** Lesser General Public License for more details.
** 
** You should have received a copy of the GNU Lesser General Public
** License along with this library; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
** 
** The images [p,r,n,q,k][d,l][d,l].png are GPL, 
** from Wikimedia Commons, see gpl.txt
**
** a small portion of the code to display the chess board was taken from
** phpChessBoard by Andreas Stieger http://www.wh-hms.uni-ulm.de/~tux/phpChessBoard/
*****************************************************************************************/

require_once('config.php');
include_once('languages/'.$lang.'_main.php');
include_once('constants.php');
include_once('standard.php');
$do = ($_POST['do']) ? $_POST['do'] : $_GET['do'];
if($do == 'login' || !$do){
	$userName		= validate($_POST['username']); 
	$password		= validate($_POST['password']); 
	include('login.php');
	$signin	= login($userName,$password,$loginStr);
	if($signin !== true){
		$error		= $signin;
		die(include('index.php'));
	}else{
		$do 		 = 'menu';
	}
}
require_once('loginon.php');
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Some Chess</title>
	<link rel="stylesheet" type="text/css" href="somechess.css" />
</head>
<body>
<div id="menu">
';
echo'<p>Some Chess <span id="ver">',version,'</span></p>
';
if($do != 'logout') echo $menu;
echo'
</div>
<div id="container">';
if($_SESSION['power']>3) include('admin.php');
if($do == 'logout'){ 
	include('logout.php');
}elseif($do == 'about'){
	include('about.html');
}elseif($do == 'newGame'){
	$vs				= validate($_POST['vs']);
	$color		 	= validate($_POST['color']);
	if($color == 'white'){
		$wID = $_SESSION['id'];
		$bID = $vs;
	}else{
		$bID = $_SESSION['id'];
		$wID = $vs;
	}
	include('gameFunc.php');
	$message = newGame($wID,$bID,$gameFuncStr);
	unset($do);
}elseif($do == 'chngInfo'){
	$pass1			= validate($_POST['pass1']);
	$pass2		 	= validate($_POST['pass2']);	
	$username		= validate($_POST['username']);
	$realname		= validate($_POST['realname']);
	$location		= validate($_POST['location']);
	$email			= validate($_POST['email']);
	$secQuestion	= validate($_POST['sec_question']);
	$secAnswer		= md5($_POST['sec_answer']);
	include('menuFunc.php');
	$message = chngInfo($username,$pass1,$pass2,$realname,$location,$email,$secQuestion,$secAnswer,$menuFuncStr);
	unset($do);
}elseif($do == 'invite'){
	$nameInv		= validate($_POST['name']);
	$emailInv		= validate($_POST['email']);
	$friend			= validate($_POST['friend']);
	include('menuFunc.php');
	$message =  invite($nameInv,$emailInv,$friend,$domain,$homeFolder,$startPower,$menuFuncStr);
	unset($do);
}elseif($do == 'resign'){
	$gameID			= validate($_POST['gameID']);
	$confirm		= $_POST['confirm'];
	if(!$confirm){
		echo '<form action="menu.php" method="post" class="dialog">
		'.$gameFuncStr[8].'
		<input type="hidden" name="gameID" value="'.$gameID.'" />
		<input type="hidden" name="do" value="resign" />
		<input type="hidden" name="confirm" value="yes" />
		<input type="submit" value="'.$buttStr[4].'" class="butt" />
		</form>';
	}else{
		include('gameFunc.php');
		$message = resign($gameID,$gameFuncStr);
		unset($do);
	}
}elseif($do == 'draw' || $do == 'drawOK'){
	$gameID			= validate($_POST['gameID']);
	$confirm		= $_POST['confirm'];
	if(!$confirm){
		if($do == 'draw'){
			echo'<form action="menu.php" method="post" class="dialog">'.$gameFuncStr[9];
		}else{
			echo'<form action="menu.php" method="post" class="dialog">'.$gameFuncStr[16];
		}
		echo '<input type="hidden" name="gameID" value="'.$gameID.'" />
		<input type="hidden" name="do" value="draw" />
		<input type="hidden" name="confirm" value="yes" />
		<input type="submit" value="'.$buttStr[5].'" class="butt" />
		</form>';
	}else{
		include('gameFunc.php');
		$message = draw($gameID,$gameFuncStr);
		unset($do);
	}
}elseif($do == 'undo' || $do == 'undoOK'){
	$gameID			= validate($_POST['gameID']);
	$queryGames		= 'SELECT gameDate FROM '.dbPre.'games WHERE gameID="'.$gameID.'" LIMIT 1';
	$resultGames	= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (udm-1)</div>');	
	$gametime		= mysql_result($resultGames,0,'gameDate');
	$tooLate		= (substr($gametime,-2)+30 > 60)? ($gametime+70) : $gametime+30;
	$undoNow		= date(YmdHis);	
	$confirm		= $_POST['confirm'];
	if(!$confirm && (($tooLate>=$undoNow && $do == 'undo') || $do == 'undoOK')){
		if($do == 'undo'){
			echo'<form action="menu.php" method="post" class="dialog">'.$gameFuncStr[11];
		}else{
			echo'<form action="menu.php" method="post" class="dialog">'.$gameFuncStr[12];
		}
		echo '<input type="hidden" name="gameID" value="'.$gameID.'" />
		<input type="hidden" name="do" value="undo" />
		<input type="hidden" name="confirm" value="yes" />
		<input type="submit" value="'.$buttStr[10].'" class="butt" />
		</form>';
	}elseif(!$confirm && $tooLate<=$undoNow){
		print'<form action="menu.php" method="post" class="dialog">
			
			'.$timed.$gameFuncStr[15].'
			<input type="hidden" name="do" value="menu" />
			<input type="submit" value="'.$buttStr[11].'" class="butt" />
		</form>';
	}else{
		include('gameFunc.php');
		$message = undo($gameID,$gameFuncStr);
		unset($do);
	}
}elseif($do == 'end'){
	$gameID			= validate($_POST['gameID']);
	$confirm		= $_POST['confirm'];	
	if(!$confirm){
		echo '<form action="menu.php" method="post" class="dialog">
		'.$gameFuncStr[10].'
		<input type="hidden" name="gameID" value="'.$gameID.'" />
		<input type="hidden" name="do" value="end" />
		<input type="hidden" name="confirm" value="yes" />
		<input type="submit" value="'.$buttStr[6].'" class="butt" />
		</form>';
	}else{
		include('gameFunc.php');
		$message = ended($gameID,$gameFuncStr);
		unset($do);
	}
}elseif($do == 'importPGN'){
	$pgn	= validate($_POST['pgn']);
	include('gameFunc.php');
	if($pgn){ 
		$import = parsePGN($pgn,null,2,1,1);
	}else{
		$message = '<div class="error">'.$gameFuncStr[20].'</div>';
	}
	if($import) $message = $gameFuncStr[19];
	unset($do);
}elseif($do == 'killPlayer' && $_SESSION['power']>3){
	$kill		= validate($_POST['killing']);
	$kill		= explode('|',$kill);
	$killName	= str_replace('_',' ',$kill[1]);
	$confirm	= $_POST['confirm'];
	if(!$confirm){
		echo '
		<form action="menu.php" method="post" class="dialog">
		<h2>'.$adminStr[6].' ',$killName,'?</h2>
		<input type="hidden" name="killing" value="'.$kill[0].'" />
		<input type="hidden" name="do" value="killPlayer" />
		<input type="hidden" name="confirm" value="yes" />
		<input type="submit" value="'.$buttStr[3].'" class="butt" />
		</form>';
	}else{
		$message = killPlayer($kill[0],$adminStr);
		unset($do);
	}
}elseif($do == 'chgPower' && $_SESSION['power']>3){
	$newPower	= validate($_POST['newPower']);
	$player		= validate($_POST['player']);
	$player		= explode('|',$player);
	$plyaerName	= str_replace('_',' ',$player[1]);
	$confirm	= $_POST['confirm'];
	if(!$confirm){
		echo '<form action="menu.php" method="post" class="dialog">
		<h2>'.$adminStr[7].$plyaerName.'</h2>
		<input type="hidden" name="playerID" value="'.$player[0].'" />
		<input type="hidden" name="newPower" value="'.$newPower.'" />
		<input type="hidden" name="do" value="chgPower" />
		<input type="hidden" name="confirm" value="yes" />
		<input type="submit" value="'.$buttStr[1].'" class="butt" />
		</form>';
	}else{
		$playerID	= validate($_POST['playerID']);
		$message 	= chgPower($playerID,$newPower,$adminStr);
		unset($do);
	}
}elseif($do == 'upload'){
	$file['name'] 		= str_replace(' ','_',$_FILES['image']['name']);
	$file['size'] 		= $_FILES['image']['size'];
	$file['tmpName'] 	= $_FILES['image']['tmp_name'];
	$file['error'] 		= $_FILES['image']['error'];	
	include('menuFunc.php');
	$message = upload($file,$playerImgDir,$menuFuncStr);
	unset($do);
}elseif($do == 'updateOpt' && $_SESSION['power']>3){
	$message = updateOptions($adminStr);
	unset($do,$firstrun);
}elseif(($do == 'options' && $_SESSION['power']>3) || ($firstrun && $_SESSION['power']>3)){
	include('options.php');
}elseif($do == 'verCheck' && $_SESSION['power']>3){
	$message = versionCheck($adminStr);
	unset($do);
}elseif($do == 'backup' && $_SESSION['power']>3){
	include('backup.php');
	$message = '<div class="message">Backup script has run</div>';
	unset($do);
}
if(($do =='menu' || !$do ) && !$firstrun){ 
online(); //--MAKE THE PERSON ACTIVELY ONLINE
//--GET USER'S INFO
$queryPlayer		= 'SELECT * FROM '.dbPre.'players WHERE id="'.$_SESSION['id'].'" LIMIT 1';
$resultPlayer		= mysql_query($queryPlayer)or die('<div class="error">'.errorDBStr.' (mp-1)</div>');	
$name				= mysql_result($resultPlayer,0,'name');
$realname			= mysql_result($resultPlayer,0,'realname');
$email				= mysql_result($resultPlayer,0,'email');
$location			= mysql_result($resultPlayer,0,'location');
$power				= mysql_result($resultPlayer,0,'power');

//--GET OTHER PLAYER'S INFO
$queryVS			= 'SELECT * FROM '.dbPre.'players WHERE id !="'.$_SESSION['id'].'" && invitedBy > -1 ORDER BY name';
$resultVS			= mysql_query($queryVS)or die('<div class="error">'.errorDBStr.' (mp-2)</div>');
$numVS				= mysql_num_rows($resultVS);
for($i=0;$i<$numVS;++$i){
	$key			= mysql_result($resultVS,$i,'id');
	$VSid[$i]		= $key;
	$VSname[$key]	= mysql_result($resultVS,$i,'name');
}

//--DISPLAY MENU PANEL & DIALOG WINDOW
$dialog				= ($message)? $message : $menuStr[39].$_SESSION['name'];
echo'
<div class="subcontainer">
';
include('menuPanel.php');
echo'</div>
<div id="dialog_window">'.$dialog.'</div>';

//--DISPLAY GAMES: CURRENT, WINS, LOSES, DRAWS
	echo '<div class="menubox" style="float:left;height:42em;width:50%">
		<div class="submenu">
			<a href="menu.php?do=menu&amp;games=inprogress" class="subitem">'.$menuStr[15].'</a><a href="menu.php?do=menu&amp;games=won" class="subitem">'.$menuStr[10].'</a><a href="menu.php?do=menu&amp;games=lost" class="subitem">'.$menuStr[11].'</a><a href="menu.php?do=menu&amp;games=drawn" class="subitem">'.$menuStr[12].'</a>
		</div>';	
	if($_GET['games'] == 'inprogress' || !$_GET['games']){
		echo'<h2>',$name.$menuStr[9].' '.$menuStr[15].'</h2>
		<div class="gamesbox">';
		$queryGames			= 'SELECT * FROM '.dbPre.'games WHERE winner="0" AND (whitePlayerID="'.$_SESSION['id'].'" OR blackPlayerID="'.$_SESSION['id'].'") ORDER BY gameID DESC';
		$resultGames		= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (mg-1)</div>');	
		$gamesNum			= mysql_num_rows($resultGames);
		if($gamesNum == 0) echo'<p>( None )</p>';
		$tooOld 			= date(YmdHis, mktime(0, 0, 0, date(m), date(d)-$endDays, date(Y)));
		for($i=0;$i<$gamesNum;++$i){
			unset($turns,$end);
			$gameID			= mysql_result($resultGames,$i,'gameID');
			$blackID		= mysql_result($resultGames,$i,'blackPlayerID');
			$whiteID		= mysql_result($resultGames,$i,'whitePlayerID');
			$nTC			= mysql_result($resultGames,$i,'nextTurnColor');
			$draw			= mysql_result($resultGames,$i,'reqDraw');	
			$undo			= mysql_result($resultGames,$i,'reqUndo');	
			//if(mysql_result($resultGames,$i,'gameDate')<$tooOld) $end = true;  //disabled for legacy support, to be enabled with 2.5 release
			$gameDate		= mysql_result($resultGames,$i,'gameDate');	//--begin legacy support
			if(strlen($gameDate) == 12) $gameDate = $gameDate.'00';		//--end legacy support
			if($gameDate<$tooOld && $gameDate) $end = true;
			if($blackID == $_SESSION['id']){$oppName = $VSname[$whiteID];$playerColor='black';}else{$oppName = $VSname[$blackID];$playerColor='white';}
			if($nTC == $playerColor) $turns = '<span class="note"> &mdash;'.$menuStr[26].'</span>';
			if($undo && $undo !== $_SESSION['id']){
				$turns = '<span class="attn"> &mdash;'.$menuStr[29].'</span>'; 
			}
			if($draw){ 
				$turns = '<span class="attn"> &mdash;'.$menuStr[28].'</span>'; 
			}
			if($end && $nTC !== $playerColor && $endDays){ 
				$turns = '<span class="attn"> &mdash;'.$menuStr[27].'</span>';
			}
			echo '<p><a href="game.php?do=display&amp;gameID='.$gameID.'&amp;vs='.(str_replace(' ','_',$oppName)).'" class="gamelink">#'.$gameID.' Vs. '.$oppName.$turns.'</a></p>';
		}
		echo'</div>';
	}elseif($_GET['games'] == 'won'){
		echo'
		<h2>',$name.$menuStr[9].' '.$menuStr[10].'</h2>
		<div class="gamesbox">';
		$queryGames			= 'SELECT * FROM '.dbPre.'games WHERE winner="'.$_SESSION['id'].'" ORDER BY gameID DESC'; 
		$resultGames		= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (mg-2)</div>');	
		$wins				= mysql_num_rows($resultGames);
		if($wins == 0) echo'<p>( None )</p>';
		for($i=0;$i<$wins;++$i){
			$gameID			= mysql_result($resultGames,$i,'gameID');
			$blackID		= mysql_result($resultGames,$i,'blackPlayerID');
			$whiteID		= mysql_result($resultGames,$i,'whitePlayerID');
			$oppName 		= ($blackID == $_SESSION['id'])? $VSname[$whiteID] : $VSname[$blackID];
			echo '<p><a href="game.php?do=display&amp;gameID='.$gameID.'&amp;vs='.(str_replace(' ','_',$oppName)).'&amp;status=view" class="gamelink">#'.$gameID.' Vs. '.$oppName.'</a></p>';
		}
		echo'</div>';
	}elseif($_GET['games'] == 'lost'){	
		echo'<h2>',$name.$menuStr[9].' '.$menuStr[11].'</h2>
		<div class="gamesbox">';
		$queryGames			= 'SELECT * FROM '.dbPre.'games WHERE winner !="'.$_SESSION['id'].'" AND winner !="0" AND winner !="D" AND winner !="X" AND (blackPlayerID='.$_SESSION['id'].' OR whitePlayerID='.$_SESSION['id'].') ORDER BY gameID DESC';
		$resultGames		= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (mg-3)</div>');	
		$loses				= mysql_num_rows($resultGames);
		if($loses == 0) echo'<p>( None )</p>';
		for($i=0;$i<$loses;++$i){
			$gameID			= mysql_result($resultGames,$i,'gameID');
			$blackID		= mysql_result($resultGames,$i,'blackPlayerID');
			$whiteID		= mysql_result($resultGames,$i,'whitePlayerID');
			$oppName 		= ($blackID == $_SESSION['id'])? $VSname[$whiteID] : $VSname[$blackID];
			echo '<p><a href="game.php?do=display&amp;gameID='.$gameID.'&amp;vs='.(str_replace(' ','_',$oppName)).'&amp;status=view" class="gamelink">#'.$gameID.' Vs. '.$oppName.'</a></p>';
		}
		echo'</div>';
	}elseif($_GET['games'] == 'drawn'){	
		echo'<h2>',$name.$menuStr[9].' '.$menuStr[12].'</h2>
		<div class="gamesbox">';
		$queryGames			= 'SELECT * FROM '.dbPre.'games WHERE winner="D" AND (blackPlayerID='.$_SESSION['id'].' OR whitePlayerID='.$_SESSION['id'].') ORDER BY gameID DESC';
		$resultGames		= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (mg-4)</div>');	
		$draws				= mysql_num_rows($resultGames);
		if($draws == 0) echo'<p>( None )</p>';
		for($i=0;$i<$draws;++$i){
			$gameID			= mysql_result($resultGames,$i,'gameID');
			$blackID		= mysql_result($resultGames,$i,'blackPlayerID');
			$whiteID		= mysql_result($resultGames,$i,'whitePlayerID');
			$oppName 		= ($blackID == $_SESSION['id'])? $VSname[$whiteID] : $VSname[$blackID];
			echo '<p><a href="game.php?do=display&amp;gameID='.$gameID.'&amp;vs='.(str_replace(' ','_',$oppName)).'&amp;status=view" class="gamelink">#'.$gameID.' Vs. '.$oppName.'</a></p>';
		}
		echo'</div>';
	}elseif($_GET['games'] == 'other'){	
		echo'<h2>'.$menuStr[30].'</h2>
		<div class="gamesbox">
		<h3>'.$menuStr[31].'</h3>';
		$queryGames			= 'SELECT * FROM '.dbPre.'games WHERE winner="0" AND blackPlayerID !="'.$_SESSION['id'].'" AND whitePlayerID !="'.$_SESSION['id'].'" ORDER BY gameID DESC';
		$resultGames		= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (mg-5)</div>');	
		$otherGames			= mysql_num_rows($resultGames);
		if($otherGames == 0) echo'<p>( None )</p>';
		for($i=0;$i<$otherGames;++$i){
			$gameID			= mysql_result($resultGames,$i,'gameID');
			$blackID		= mysql_result($resultGames,$i,'blackPlayerID');
			$whiteID		= mysql_result($resultGames,$i,'whitePlayerID');
			$whiteName = $VSname[$whiteID];
			$blackName = $VSname[$blackID];
			echo '<p><a href="game.php?do=display&amp;gameID='.$gameID.'&amp;status=view" class="gamelink">#'.$gameID.' '.$whiteName.' Vs. '.$blackName.'</a></p>';
		}
		echo'<br />
		<h3>'.$menuStr[32].'</h3>';
		$queryGames			= 'SELECT * FROM '.dbPre.'games WHERE winner !="0" AND blackPlayerID !="'.$_SESSION['id'].'" AND whitePlayerID !="'.$_SESSION['id'].'"  ORDER BY gameID DESC';
		$resultGames		= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (mg-6)</div>');	
		$otherGames			= mysql_num_rows($resultGames);
		if($otherGames == 0) echo'<p>( None )</p>';
		for($i=0;$i<$otherGames;++$i){
			$gameID			= mysql_result($resultGames,$i,'gameID');
			$blackID		= mysql_result($resultGames,$i,'blackPlayerID');
			$whiteID		= mysql_result($resultGames,$i,'whitePlayerID');
			$whiteName = $VSname[$whiteID];
			$blackName = $VSname[$blackID];
			echo '<p><a href="game.php?do=display&amp;gameID='.$gameID.'&amp;status=view" class="gamelink">#'.$gameID.' '.$whiteName.' Vs. '.$blackName.'</a></p>';
		}
		echo'<br />
		<h3>'.$menuStr[33].'</h3>';
		$queryGames			= 'SELECT * FROM '.dbPre.'games WHERE blackPlayerID ="'.$_SESSION['id'].'" OR whitePlayerID ="'.$_SESSION['id'].'" ORDER BY gameID DESC';
		$resultGames		= mysql_query($queryGames)or die('<div class="error">'.errorDBStr.' (mg-7)</div>');	
		$otherGames			= mysql_num_rows($resultGames);
		if($otherGames == 0) echo'<p>( None )</p>';
		for($i=0;$i<$otherGames;++$i){
			unset($whiteName,$blackName);
			$gameID			= mysql_result($resultGames,$i,'gameID');
			$blackID		= mysql_result($resultGames,$i,'blackPlayerID');
			$whiteID		= mysql_result($resultGames,$i,'whitePlayerID');
			$whiteName = $VSname[$whiteID];
			$blackName = $VSname[$blackID];
			if($whiteName || $blackName)echo '<p><a href="game.php?do=display&amp;gameID='.$gameID.'&amp;status=view" class="gamelink">#'.$gameID.' Vs. '.$whiteName.$blackName.'</a></p>';
		}
		echo'
		</div>
		';
	}
	echo'<div class="submenu">';
	if($showStats == 1)echo'<a href="players.php?do=players" class="subitem">'.$menuStr[13].'</a>';
	echo'<a href="menu.php?do=menu&amp;games=other" class="subitem">',$menuStr[34],'</a><a href="rss.php/',(str_replace(' ','-',$name)),'" class="subitem">RSS</a>
	</div>
	</div><!--close game menubox-->';
}
echo '
</div> <!--close container div-->';
//--SHOW ADMIN PANEL
if($power > 3 && ($do =='menu' || !$do)){
	echo adminPanel($VSid,$VSname,$showBackup,$showUpdate,$adminStr);
}
mysql_close();
?>
<div style="position:absolute;top:1.5em;left:0.5em;color:#cc3300;font-weight:700">
	<a href="http://astrodogpress.com" target="_NEW" style="color:#cc3300">please report any bugs</a>
</div>
</body>
</html>