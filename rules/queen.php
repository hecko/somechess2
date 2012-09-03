<?php
function queenRules($locations,$newSpot,$oldSpot,$movingPiece,$queenStr=null){
	if($oldSpot{0} == $newSpot{0}){
		//forward COLUMN movement
		if($newSpot{1} > $oldSpot{1}){
			$num			= ($newSpot{1} - $oldSpot{1}) - 1;
			for($x=0;$x<$num;++$x){
				$sqCheck 	= $newSpot{0}.($oldSpot{1} + 1 + $x);
				if($locations[$sqCheck] != '') $queenMove['error'] = $queenStr[0];
			}
		}else{
		//backward COLUMN movement
			$num			= ($oldSpot{1} - $newSpot{1}) - 1;
			for($x=0;$x<$num;++$x){
				$sqCheck 	= $newSpot{0}.($oldSpot{1} - 1 - $x);
				if($locations[$sqCheck] != '') $queenMove['error'] = $queenStr[0];
			}
		}
	}elseif($oldSpot{1} == $newSpot{1}){
		//right ROW movement
		if(ord($newSpot{0}) > ord($oldSpot{0})){
			$num			= (ord($newSpot{0}) - ord($oldSpot{0})) - 1;
			for($x=0;$x<$num;++$x){
				$sqCheck 	= chr(ord($oldSpot{0}) + 1 + $x).$newSpot{1};
				if($locations[$sqCheck] != '') $queenMove['error'] = $queenStr[0];
			}
		}else{
		//left ROW movement
			$num			= (ord($oldSpot{0}) - ord($newSpot{0})) - 1;
			for($x=0;$x<$num;++$x){
				$sqCheck 	= chr(ord($oldSpot{0}) - 1 - $x).$newSpot{1};
				if($locations[$sqCheck] != '') $queenMove['error'] = $queenStr[0];
			}
		}
	}elseif(ord($oldSpot{0}) < ord($newSpot{0}) && $oldSpot{1} < $newSpot{1}){ 
	// [++] ascending lane (right to left)
		$num				= $newSpot{1} - $oldSpot{1};
		for($x=1;$x<=$num;++$x){
			$squareFile		= ord($oldSpot{0}) + $x;
			$squareRank		= $oldSpot{1} + $x;
			$lanes[] 		= chr($squareFile).$squareRank;
		}
		$diag					= true;
	}elseif(ord($oldSpot{0}) > ord($newSpot{0}) && $oldSpot{1} > $newSpot{1}){ 
	// [--] ascending lane (right to left)
		$num				= $oldSpot{1} - $newSpot{1};
		for($x=1;$x<=$num;++$x){
			$squareFile		= ord($oldSpot{0}) - $x;
			$squareRank		= $oldSpot{1} - $x;
			$lanes[] 		= chr($squareFile).$squareRank;
		}
		$diag					= true;
	}elseif(ord($oldSpot{0}) > ord($newSpot{0}) && $oldSpot{1} < $newSpot{1}){ 	
	// [-+] descending lane (right to left)
		$num				= $newSpot{1} - $oldSpot{1};
		for($x=1;$x<=$num;++$x){
			$squareFile		= ord($oldSpot{0}) - $x;
			$squareRank		= $oldSpot{1} + $x;
			$lanes[] 		= chr($squareFile).$squareRank;
		}
		$diag					= true;
	}elseif(ord($oldSpot{0}) < ord($newSpot{0}) && $oldSpot{1} > $newSpot{1}){ 	
	// [+-] descending lane (right to left)
		$num				= $oldSpot{1} - $newSpot{1};
		for($x=1;$x<=$num;++$x){
			$squareFile		= ord($oldSpot{0}) + $x;
			$squareRank		= $oldSpot{1} - $x;
			$lanes[] 		= chr($squareFile).$squareRank;
		}
		$diag					= true;	
	}else{
		$queenMove['error'] = $queenStr[1];
	}
	if($diag){
		$sqKey						= array_search($newSpot,$lanes);
		if($sqKey === false){
			$queenMove['error'] = $queenStr[1];
		}else{
			for($x=0;$x<$sqKey;++$x){
				$square					= $lanes[$x];
				if($locations[$square] != '') $queenMove['error'] = $queenStr[0];
			}
		}
	}
	return $queenMove;
}
?>