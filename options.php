<?PHP
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
require_once('loginon.php');
if($_SESSION['power']>3 && is_writable('config.php')){
	include_once('languages/'.$lang.'_options.php');
	$optQuery	= 'SELECT * FROM '.dbPre.'options WHERE id>0 ORDER BY id';
	$optResult 	= mysql_query($optQuery)or die('<div class="error">'.errorDBStr.' (op-1)</div>');
	$optCount	= mysql_num_rows($optResult);

 	echo '
 	<form action="menu.php" method="post" class="options">
 		<div id="optlist">';
	for($p=0;$p<$optCount;++$p){
		unset($check,$excp,$value);
		$optName	= mysql_result($optResult,$p,'optionName');
		if(mysql_result($optResult,$p,'type') == 'checkbox'){
			if(mysql_result($optResult,$p,'optionValue') == 1) $check = ' checked';
			$value = '1';
		}else{
			$value = mysql_result($optResult,$p,'optionValue');
		}

		if(mysql_result($optResult,$p,'type') == 'checkbox') $excp = ' style="width:auto"';
		echo '
		<p>'.str_replace('_',' ',$optName).' <input type="'.mysql_result($optResult,$p,'type').'" name="'.$optName.'" value="'.$value.'"'.$excp.$check.' /></p>';
		$help	.= '
		<p>'.$opStr[$p].'</p>';
	}
	echo '
		</div> <!--close optLIst-->
		<div id="help">'.
		$help.'
		</div>
		<input type="hidden" name="do" value="updateOpt" />
		<input type="submit" value="'.$opStr['a'].'" class="butt" />
	</form>
	';
}elseif(!is_writable('config.php')){
	echo '<div class="error">'.$adminStr[19].'</div>';
}
?>