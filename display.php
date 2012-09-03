<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
function displayBoard($locations,$player,$gameID){
	($player == 'black')? $flip = true:$flip = false;
	echo'<div class="boardbox">';
	for($x=1;$x<=8;++$x) echo'<div class="col_label">',($flip?(chr(73-$x)) : (chr(64+$x))),'</div>';
	echo'<br /><br />';
	for($row=1;$row<=8;++$row){ 
		for($col=1;$col<=8;++$col){
			$square 	= $flip? chr(105-$col).$row : chr(96+$col).(9-$row);
			$piece		= $locations[$square];
			$color 		= ((($row + $col) % 2) == 0)?'l':'d';
			$imgFile 	= imgDir.$piece.$color.imgExt;
			echo'
			<a href="board.php?do=move&amp;gameID=',$gameID,'&amp;sq='.$square,'" title="',$square,'"><img src="',$imgFile,'" class="sq" alt="',$piece,'" /></a>';		
		}
		echo'<div class="row_label">',($flip?($row) : (9-$row)),'</div>';
	}
	echo'</div>';
}
?>
