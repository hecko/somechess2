<?php
function bishopRules($locations,$newSpot,$oldSpot,$movingPiece,$bishopStr=null){
	if(ord($oldSpot{0}) < ord($newSpot{0}) && $oldSpot{1} < $newSpot{1}){ 
	// [++] ascending lane (right to left)
		$num				= $newSpot{1} - $oldSpot{1};
		for($x=1;$x<=$num;++$x){
			$squareFile		= ord($oldSpot{0}) + $x;
			$squareRank		= $oldSpot{1} + $x;
			$lanes[] 		= chr($squareFile).$squareRank;
		}
	}elseif(ord($oldSpot{0}) > ord($newSpot{0}) && $oldSpot{1} > $newSpot{1}){ 
	// [--] ascending lane (right to left)
		$num				= $oldSpot{1} - $newSpot{1};
		for($x=1;$x<=$num;++$x){
			$squareFile		= ord($oldSpot{0}) - $x;
			$squareRank		= $oldSpot{1} - $x;
			$lanes[] 		= chr($squareFile).$squareRank;
		}
	}elseif(ord($oldSpot{0}) > ord($newSpot{0}) && $oldSpot{1} < $newSpot{1}){ 	
	// [-+] descending lane (right to left)
		$num				= $newSpot{1} - $oldSpot{1};
		for($x=1;$x<=$num;++$x){
			$squareFile		= ord($oldSpot{0}) - $x;
			$squareRank		= $oldSpot{1} + $x;
			$lanes[] 		= chr($squareFile).$squareRank;
		}
	}elseif(ord($oldSpot{0}) < ord($newSpot{0}) && $oldSpot{1} > $newSpot{1}){ 	
	// [+-] descending lane (right to left)
		$num				= $oldSpot{1} - $newSpot{1};
		for($x=1;$x<=$num;++$x){
			$squareFile		= ord($oldSpot{0}) + $x;
			$squareRank		= $oldSpot{1} - $x;
			$lanes[] 		= chr($squareFile).$squareRank;
		}
	}
	$sqKey						= array_search($newSpot,$lanes);
	if($sqKey === false){
		$bishopMove['error'] = $bishopStr[1];
	}else{
		for($x=0;$x<$sqKey;++$x){
			$square					= $lanes[$x];
			if($locations[$square] != '') $bishopMove['error'] = $bishopStr[0];
		}
	}
	return $bishopMove;
}
?>