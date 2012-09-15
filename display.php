<?php
function displayBoard($locations,$player,$gameID,$glow){
	//if player is black, flip the board
	($player == 'black')? $flip = true:$flip = false;

	echo'<div class="boardbox">';

	//name the columns A-H
	for($x=1;$x<=8;++$x) echo'<div class="col_label">',($flip?(chr(73-$x)) : (chr(64+$x))),'</div>';

	echo'<br /><br />';
	//drawing the board with pieces now
	for($row=1;$row<=8;++$row){ 
		for($col=1;$col<=8;++$col){
			$square 	= $flip? chr(105-$col).$row : chr(96+$col).(9-$row);
			if($square==$glow) $glowing = 'style="border:0.1em solid red;height:3.25em;width:3.25em"';
			$piece		= $locations[$square];
			$color 		= ((($row + $col) % 2) == 0)?'l':'d';
			$imgFile 	= imgDir.$piece.$color.imgExt;
			$out .= '<a href="board.php?do=move&amp;gameID='.$gameID.'&amp;sq='.$square.'" 
				title="'.$square.'"><img src="'.$imgFile.'" class="sq" alt="'.$piece.'" /></a>';		
		}
		$out .= '<div class="row_label">'.($flip?($row) : (9-$row)).'</div>';
	}
	echo $out;
	echo'</div>';
}
?>
