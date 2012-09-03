<?php 
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
function adminPanel($VSid,$VSname,$showBackup,$showUpdate,$adminStr){ 
	$panel = '
		<div id="adminpanel">
		<h2>'.$adminStr[0].'</h2>
		<div class="admin" style="text-align:right;">		
			<h3>'.$adminStr[20].'</h3><br />
			<a href="menu.php?do=options" class="butt">'.$adminStr[16].'</a>
		</div>		
		<form action="menu.php" method="post" class="admin">
		<h3>'.$adminStr[1].'</h3>
			<p><select name="killing" class="input">
				<option></option>';
			$numVS = count($VSid);
			for($i=0;$i<$numVS;++$i){
				$key	= $VSid[$i];
				$panel .= '<option value="'.$key.'|'.(str_replace(' ','_',$VSname[$key])).'">'.$VSname[$key].'</option>';
			}
	$panel.='
		</select></p>
			<input type="hidden" name="do" value="killPlayer" />
		<input type="submit" value="'.$adminStr[9].'" class="butt" />
		</form>
		<form action="menu.php" method="post" class="admin">
		<h3>'.$adminStr[2].'</h3>
			<p><select name="player" class="input">
				<option></option>';
			$numVS = count($VSid);
			for($i=0;$i<$numVS;++$i){
				$key	= $VSid[$i];
				$panel .= '<option value="'.$key.'|'.(str_replace(' ','_',$VSname[$key])).'">'.$VSname[$key].'</option>';
			}
	$panel.='
			</select></p>
			<p><select name="newPower" class="input">
				<option></option>
				<option value="0">Low</option>
				<option value="1">Basic</option>
				<option value="2">High</option>
				<option value="4">Admin</option>
			</select></p>
			<input type="hidden" name="do" value="chgPower" />
			<input type="submit" value="'.$adminStr[10].'" class="butt" />
		</form>';
	if($showBackup)$panel.='
		<form action="menu.php" method="post" class="admin">		
			<h3>'.$adminStr[15].'</h3>
			<input type="hidden" name="do" value="backup" />
			<input type="submit" value="'.$adminStr[11].'" class="butt" />
		</form>';
	if($showUpdate)$panel.='
		<form action="menu.php" method="post" class="admin">		
			<h3>'.$adminStr[8].'</h3>
			<input type="hidden" name="do" value="verCheck" />
			<input type="submit" value="'.$adminStr[11].'" class="butt" />
		</form>';
	$panel.='</div>';
	if($_SESSION['power']>3) return $panel;
}
function updateOptions($adminStr){
	$optQuery	= 'SELECT * FROM '.dbPre.'options WHERE id>0 ORDER BY id';
	$optResult 	= mysql_query($optQuery)or die('<div class="error">'.errorDBStr.' (ou-1)</div>');
	$optCount	= mysql_num_rows($optResult);
	$data		= '<?php '."\r\n";	
	for($p=0;$p<$optCount;++$p){	
		$data	.= '$'.mysql_result($optResult,$p,'varName')."		= '".$_POST[mysql_result($optResult,$p,'optionName')]."'; \r\n";
		$query	= 'UPDATE '.dbPre.'options SET optionValue="'.$_POST[mysql_result($optResult,$p,'optionName')].'" WHERE id="'.mysql_result($optResult,$p,'id').'"';
		mysql_query($query)or die('<div class="error">'.errorDBStr.' (uo-2)</div>');
	}
	$data .= '@mysql_connect($host,$dbUser,$dbPass);'." \r\n".
'@mysql_select_db($database); '."\r\n".
'?>';
	$file = 'config.php';
	$done	= put_file_contents($file,$data);
	if($done){
		return $adminStr[17];
	}else{
		return $adminStr[18];
	}
}
function killPlayer($killID,$adminStr){
	//--we don't delete the user anymore, this way her username is kept for historical purposes AND this way she can be undeleted later
	$queryKill 	= 'UPDATE '.dbPre.'players set invitedBy=-2 WHERE id="'.$killID.'"';
	mysql_query($queryKill)or die('<div class="error">'.errorDBStr.' (ru-1)</div>');
	//--we delete only the games that were ended without win, lose, or draw AND games that are in-progress
	$queryKillGames	= 'DELETE FROM '.dbPre.'games WHERE (winner="0" OR winner="X") AND (whitePlayerID="'.$killID.'" OR blackPlayerID="'.$killID.'")';
	mysql_query($queryKillGames)or die('<div class="error">'.errorDBStr.' (ru-2)</div>');
	return $adminStr[3];
}
function chgPower($playerID,$newPower,$adminStr){
	if(!$playerID || !$newPower) return '<div class="error">'.$adminStr[4].'</div>';
	$queryPower = 'UPDATE '.dbPre.'players SET power="'.$newPower.'" WHERE id="'.$playerID.'"';
	mysql_query($queryPower)or die('<div class=error>'.errorDBStr.' (cp-1)</div>');
	return $adminStr[5];
}
function versionCheck($adminStr){
	$contents	= file_get_contents('http://somechess.org/web/version.rss');
	$newVer		= preg_replace('/[\W\S\.]*<description>/','',$contents);
	$newVer		= preg_replace('/<\/description>[\W\S\.]*/','',$newVer);	
	if(ver2num(shortVer) < ver2num($newVer)){
		return $adminStr[12].': <a href="http://somechess.org/web/" target="_NEW">'.$newVer.' ('.$adminStr[13].')</a>';
	}else{
		return $adminStr[14].': '.shortVer;
	}
}
function ver2num($ver){
	if(strpos($ver,'a')){
		$ver	= preg_replace('/[a-z]*/','',$ver);
		$ver	= $ver+10;
	}elseif(strpos($ver,'b')){
		$ver	= preg_replace('/[a-z]*/','',$ver);
		$ver	= $ver+20;	
	}elseif(strpos($ver,'rc')){
		$ver	= preg_replace('/[a-z]*/','',$ver);
		$ver 	= $ver+30;	
	}else{
		$ver	= $ver+40;	
	}
	$nums 		= explode('.',$ver);
	$ver		= $nums[0] + $nums[1];
	return $ver;
}
function put_file_contents($file,$data){
	$file = @fopen($file,'w');
	if(!$file) return false;
	fwrite($file,$data);
	fclose($file);
	return true;
}
?>