<?php
if(session_destroy()) {
	echo'<div id="logout">',$loginStr[6],'<br /><br /><a href="index.php">'.$loginStr[7].'</a></div>';
} else {
	echo'ERROR';
}
?> 
