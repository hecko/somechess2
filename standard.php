<?php
function validate($value){
	if(get_magic_quotes_gpc()) 	$value 	= stripslashes($value);
	if(!is_numeric($value)) 	$value 	= mysql_real_escape_string(strip_tags($value));
	return $value;
}
function online(){
	$now		 = date(YmdHi);
	$queryOnline = 'UPDATE '.dbPre.'players SET online="1", timeOnline="'.$now.'" WHERE id="'.$_SESSION['id'].'" LIMIT 1';
	mysql_query($queryOnline)or die('<div class="error">'.errorDBStr.' (ut-1)</div>');
}
?>