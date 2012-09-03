<?PHP
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
$queryHist 	= 'SELECT * FROM '.dbPre.'moves WHERE gameID="'.$gameID.'" ORDER BY moveNum';
$resultHist	= mysql_query($queryHist) or die('<div class="error">'.errorDBStr.' (im-1)</div>');
$moveNum 	= mysql_num_rows($resultHist);
for($i=0;$i<$moveNum;++$i) $moves .= '<p><span class="movenum">'.mysql_result($resultHist,$i,'moveNum').'.</span><span class="move">'.mysql_result($resultHist,$i,'whiteMove').'</span>'.mysql_result($resultHist,$i,'blackMove').'</p>';
echo'<div class="history">
	<div class="in_history">
		<h2>'.$infoBoxStr[0].'</h2>
		'.$moves.'
	</div>
</div>
<div id="info">';
if($message) echo'<div class="look">'.$message.'</div>';	
if($moving) echo'<div class="moving">'.$moving.'</div>';	
if(strpos($lastMove['move'],'#') === false) echo $turn;
if($undoD == 2){$okayD = ' &#8730;';$doDK='OK';}
echo'</div>
<div class="opt">
	<form action="menu.php" method="post" style="float:left;margin:0px;" target="_top">
		<input type="hidden" name="do" value="resign" />
		<input type="hidden" name="gameID" value="',$gameID,'" />
		<input type="submit" value="'.$infoBoxStr[1].'" class="butt" />	
	</form>
	<form action="menu.php" method="post" style="float:left;margin:0px;" target="_top">
		<input type="hidden" name="do" value="draw'.$doDK.'" />
		<input type="hidden" name="gameID" value="',$gameID,'" />
		<input type="submit" value="'.$infoBoxStr[2].$okayD.'" class="butt" />	
	</form>';
if($undoB == 2){$okayU = ' &#8730;';$doUK='OK';}
if($undoB>0){
	echo'<form action="menu.php" method="post" style="float:left;margin:0px;" target="_top">
		<input type="hidden" name="do" value="undo'.$doUK.'" />
		<input type="hidden" name="gameID" value="',$gameID,'" />
		<input type="submit" value="'.$infoBoxStr[4].$okayU.'" class="butt" />	
	</form>';	
}
if($endB) echo'<form action="menu.php" method="post" style="float:left;margin:0px;" target="_top">
		<input type="hidden" name="do" value="end" />
		<input type="hidden" name="gameID" value="',$gameID,'" />
		<input type="submit" value="'.$infoBoxStr[3].'" class="butt" />	
	</form>';
echo'</div>';	
?>