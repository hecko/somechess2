<?php
function knightRules($locations,$newSpot,$oldSpot,$movingPiece,$knightStr=null){
	if($newSpot{1} == ($oldSpot{1} + 1) || $newSpot{1} == ($oldSpot{1} - 1)){
	//row length move (over 2, up 1)
		if(ord($newSpot{0}) != (ord($oldSpot{0}) + 2) && ord($newSpot{0}) != (ord($oldSpot{0}) - 2)){
			$knightMove['error'] = $knightStr[0];
		}
	}elseif($newSpot{1} == ($oldSpot{1} + 2) || $newSpot{1} == ($oldSpot{1} - 2)){
	//column length move (over 1, up 2)
		if(ord($newSpot{0}) != (ord($oldSpot{0}) + 1) && ord($newSpot{0}) != (ord($oldSpot{0}) - 1)){
			$knightMove['error'] = $knightStr[0];
		}
	}else{
		$knightMove['error'] = $knightStr[0];
	}	
	if($knightMove[0] != 'error'){		//do we need to be specific about the notation
		if($oldSpot{0} == $newSpot{0}){ $spcNote = $oldSpot{1}; }else{ $spcNote = $oldSpot{0}; }
		//from far right
		$squareN[]	= chr(ord($newSpot{0}) - 2).($newSpot{1} + 1);
		$squareN[]	= chr(ord($newSpot{0}) - 2).($newSpot{1} - 1);
		//from far left
		$squareN[]	= chr(ord($newSpot{0}) + 2).($newSpot{1} + 1);
		$squareN[]	= chr(ord($newSpot{0}) + 2).($newSpot{1} - 1);
		//from near right
		$squareN[]	= chr(ord($newSpot{0}) - 1).($newSpot{1} + 2);
		$squareN[]	= chr(ord($newSpot{0}) - 1).($newSpot{1} - 2);
		//from near left
		$squareN[]	= chr(ord($newSpot{0}) + 1).($newSpot{1} + 2);
		$squareN[]	= chr(ord($newSpot{0}) + 1).($newSpot{1} - 2);
		//with the above array check for threatening knights
		for($x=0;$x<8;++$x){
			if(!isset($knightMove['notePiece'])){
				$square 	= $squareN[$x];
				$nearPiece	= $locations[$square];
				if($nearPiece == $movingPiece && $square != $oldSpot) $knightMove['notePiece'] = 'N'.$spcNote; 
			}
		}
	}
	return $knightMove;
}
?>