<?php
function pawnRules($locations,$newSpot,$oldSpot,$movingPiece,$lastMove,$pawnStr=null){
	if($lastMove['move']{1} == 4 && $newSpot{1} == 3 && $newSpot{0} == $lastMove['move']{0} && $locations[$oldSpot]{1} == 'd' && $lastMove['twoSpaces'] == 'yes'){//en passant black
		$pawnMove['notePiece']	= $oldSpot{0}.'x'.$newSpot.'EP';
		$pawnMove['cap']	= $lastMove['move'];
	}elseif($lastMove['move']{1} == 5 && $newSpot{1} == 6 && $newSpot{0} == $lastMove['move']{0} && $locations[$oldSpot]{1} == 'l' && $lastMove['twoSpaces'] == 'yes'){//en passant white
		$pawnMove['notePiece']	= $oldSpot{0}.'x'.$newSpot.'EP';
		$pawnMove['cap']		= $lastMove['move'];
	}elseif(ord($oldSpot{0}) != ord($newSpot{0})){
	//capture rules	
		if($locations[$newSpot] == '') $pawnMove['error'] = $pawnStr[1];
		if($movingPiece{1} == 'l'){
			if(($oldSpot{1} + 1) != $newSpot{1}) $pawnMove['error'] = $pawnStr[1];
		}else{
			if(($oldSpot{1} - 1) != $newSpot{1}) $pawnMove['error'] = $pawnStr[1];
		}
		if(ord($newSpot{0}) > ord($oldSpot{0}) + 1) $pawnMove['error'] = $pawnStr[1];
		if(ord($newSpot{0}) < ord($oldSpot{0}) - 1) $pawnMove['error'] = $pawnStr[1];
		if(!$pawnMove['error']) $pawnMove['twoSpaces'] = 'no';
	}else{
	//movement rules
		if($oldSpot{1} == 2 || $oldSpot{1} == 7){
			//can move two spaces
			if($movingPiece{1} == 'l'){
				if(($oldSpot{1} + 2) < $newSpot{1} || $oldSpot{1} > $newSpot{1}) $pawnMove['error'] = $pawnStr[2];
				$midSpot	= $newSpot{0}.($newSpot{1} - 1);  //square between old square & new square
			}else{
				if(($oldSpot{1} - 2) > $newSpot{1} || $oldSpot{1} < $newSpot{1}) $pawnMove['error'] = $pawnStr[2];
				$midSpot	= $newSpot{0}.($newSpot{1} + 1);  //square between old square & new square
			}
			if($locations[$midSpot] != '' && $midSpot != $oldSpot) $pawnMove['error'] = $pawnStr[0];
			if($locations[$newSpot] != '') $pawnMove['error'] = $pawnStr[1];
			if(!$pawnMove['error']) $pawnMove['twoSpaces'] = 'yes';
		}else{
			//can move one space
			if($locations[$newSpot] != ''){
				$pawnMove['error'] = '<b>Illegal move</b><br /><br /> Pawns can only capture diagonally';
			}else{
				if($movingPiece{1} == 'l'){
					if(($oldSpot{1} + 1) != $newSpot{1}) $pawnMove['error'] = $pawnStr[2];
				}else{
					if(($oldSpot{1} - 1) != $newSpot{1}) $pawnMove['error'] = $pawnStr[2];
				}
			}
			if(!$pawnMove['error']) $pawnMove['twoSpaces'] = 'no';
		}
	}
	if($newSpot{1} == 1 || $newSpot{1} == 8) $pawnMove['promo'] = true;
	return $pawnMove;
}
?>