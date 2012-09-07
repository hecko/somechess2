<?php
$query 	= 'UPDATE '.dbPre.'players SET online="0" WHERE id="'.validate($id).'" LIMIT 1';
mysql_query($query)or die('<div class="error">'.errorDBStr.' (lo-1)</div>');
if(session_destroy()) {
	echo'<div id="logout">',$loginStr[6],'<br /><br /><a href="index.php">'.$loginStr[7].'</a></div>';
} else {
	echo'ERROR';
}
?> 
