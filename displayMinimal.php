<?php 
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
function displayBoardMin($locations,$player,$gameID,$glow){
	if($player == 'black'){$flip = true;}else{$flip = false;}
	echo'<div class="boardbox">';
	//----echo column labels
	for($x=1;$x<=8;++$x) echo'<div class="col_label">',($flip?(chr(73-$x)) : (chr(64+$x))),'</div>';
	echo'<br /><br />';
	//----echo the column
	for($row=1;$row<=8;++$row){ 
		//echo the row
		for($col=1;$col<=8;++$col){
			unset($glowing);
			$square 	= $flip? chr(105-$col).$row : chr(96+$col).(9-$row);
			if($square==$glow) $glowing = 'style="border:0.1em solid red;height:3.25em;width:3.25em"';
			$piece		= $locations[$square];
			$color 		= ((($row + $col) % 2) == 0)?'l':'d';
			$imgFile 	= imgDir.$piece.$color.imgExt;
			if(!$piece) $piece = 'empty';
			echo'
			<a><img ',$glowing,' src="',$imgFile,'" alt="',$piece,'" class="sq" /></a>';		
		}
		//----echo row labels
		echo'<div class="row_label">',($flip?($row) : (9-$row)),'</div>';
	}
	echo'</div>';
}
function info($playerColor,$gameID,$winner,$oppName,$infoBoxStr){	
	echo'<div id="info">';
	if($oppName)echo'<p><b>',$winner,'</b>',$infoBoxStr[11],'</b></p>';
	echo'</div>
	<div class="opt">
		<form action="export.php" method="post" target="_top" style="float:left;margin:0px;">
			<input type="hidden" name="gameID" value="',$gameID,'" />
			<input type="submit" value="'.$infoBoxStr[5].'" class="butt" />	
		</form>
	</div>';

	$queryHist 	= 'SELECT * FROM '.dbPre.'moves WHERE gameID="'.$gameID.'" ORDER BY moveNum';
	$resultHist	= mysql_query($queryHist) or die('<div class="error">'.errorDBStr.'moves</div>');
	$moveNum 	= mysql_num_rows($resultHist);
	for($i=0;$i<$moveNum;++$i) $moves .= '<p><span class="moveNum">'.mysql_result($resultHist,$i,'moveNum').'</span><span class="move">'.mysql_result($resultHist,$i,'whiteMove').'</span>'.mysql_result($resultHist,$i,'blackMove').'</p>';
	echo'<div class="history">
		<div class="in_history">
			<h3>'.$infoBoxStr[0].'</h3>
			'.$moves.'
		</div>
	</div>';
}
?>
