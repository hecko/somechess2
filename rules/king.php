<?php
function kingRules($locations,$newSpot,$oldSpot,$movingPiece,$canCastle,$lastMove,$kingStr=null){
	$checkSpot = strlen($lastMove['move'])-1;	
	//--catch castling
	if($oldSpot{0} == 'e' && ($newSpot{0} == 'c' || $newSpot{0} == 'g') && $canCastle['k'] == 0){
		$kingMove['error'] = $kingStr[0];		
	}elseif($oldSpot{0} == 'e' && ($newSpot{0} == 'c' || $newSpot{0} == 'g') && $lastMove['move']{$checkSpot} == '+'){
		$kingMove['error'] = $kingStr[1];
	}elseif($movingPiece{1} == 'l'){
		//---castling white	
		if($newSpot == 'c1' && $oldSpot == 'e1' && $locations['a1'] == 'rl'){
			if($canCastle['a'] == 0)		$kingMove['error'] = $kingStr[2];
			if($locations[$newSpot] !='') 	$kingMove['error'] = $kingStr[3];
			if($locations['d1'] !='') 		$kingMove['error'] = $kingStr[3];
			if($locations['b1'] !='') 		$kingMove['error'] = $kingStr[3];
			if(aThreat('d1',$locations,'d'))	$kingMove['error'] = $kingStr[4];
			if(!$kingMove['error']){
				$kingMove['rookSqF'] 	= 'a1';
				$kingMove['rookSqT'] 	= 'd1';
				$kingMove['castled'] = 'O-O-O';
			}
		}elseif($newSpot == 'g1' && $oldSpot == 'e1' && $locations['h1'] == 'rl'){
			if($canCastle['h'] == 0)		$kingMove['error'] = $kingStr[2];
			if($locations[$newSpot] !='') 	$kingMove['error'] = $kingStr[3];
			if($locations['f1'] !='') 		$kingMove['error'] = $kingStr[3];
			if(aThreat('f1',$locations,'d'))	$kingMove['error'] = $kingStr[4];
			if(!$kingMove['error']){
				$kingMove['rookSqF'] 	= 'h1';
				$kingMove['rookSqT'] 	= 'f1';
				$kingMove['castled'] 	= 'O-O';
			}
		}
	}elseif($movingPiece{1} == 'd'){ 
		//---castling black
		if($newSpot == 'c8' && $oldSpot == 'e8' && $locations['a8'] == 'rd'){
			if($canCastle['a'] == 0)		$kingMove['error'] = $kingStr[2];
			if($locations[$newSpot] !='') 	$kingMove['error'] = $kingStr[3];
			if($locations['d8'] !='') 		$kingMove['error'] = $kingStr[3];
			if($locations['b8'] !='') 		$kingMove['error'] = $kingStr[3];
			if(aThreat('d8',$locations,'l'))	$kingMove['error'] = $kingStr[4];
			if(!$kingMove['error']){
				$kingMove['rookSqF'] 	= 'a8';
				$kingMove['rookSqT'] 	= 'd8';
				$kingMove['castled'] 	= 'O-O-O';
			}
		}elseif($newSpot == 'g8' && $oldSpot == 'e8' && $locations['h8'] == 'rd'){
			if($canCastle['h'] == 0)		$kingMove['error'] = $kingStr[2];
			if($locations[$newSpot] !='') 	$kingMove['error'] = $kingStr[3];
			if($locations['f8'] !='') 		$kingMove['error'] = $kingStr[3];
			if(aThreat('f8',$locations,'l'))	$kingMove['error'] = $kingStr[4];
			if(!$kingMove['error']){
				$kingMove['rookSqF'] 	= 'h8';
				$kingMove['rookSqT'] 	= 'f8';
				$kingMove['castled'] 	= 'O-O';
			}
		}
	}	
	//--normal movement
	if(!$kingMove['castled'] && !$kingMove['error']){
		if($newSpot{1} > $oldSpot{1} + 1) 	$kingMove['error'] = $kingStr[5];
		if($newSpot{1} < $oldSpot{1} - 1) 	$kingMove['error'] = $kingStr[5];
		if(ord($newSpot{0}) > ord($oldSpot{0}) + 1) $kingMove['error'] = $kingStr[5];
		if(ord($newSpot{0}) < ord($oldSpot{0}) - 1) $kingMove['error'] = $kingStr[5];
	}
	return $kingMove;
}
?>