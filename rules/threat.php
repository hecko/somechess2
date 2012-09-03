<?php
function aThreat($kingSq,$locations,$attackColor){
	if($attackColor == 'd'){$defenseColor = 'l';}else{$defenseColor = 'd';}
	//--see if king is in check along COLUMN
	//ascending
	$num				= 8 - $kingSq{1};
	for($x=1;$x<=$num;++$x){
		$square			= $kingSq{0}.($kingSq{1} + $x);
		$piece			= $locations[$square];
		if($piece{1} == $defenseColor){
			$blocking	= true;
		}elseif($piece{1} == $attackColor && !$blocking){
			if($piece{0} == 'r' || $piece{0} == 'q'){
				$check[]	= $square;
			}elseif($piece{0} == 'k' && $x == 1){
				$check[]	= $square;
			}else{
				$blocking	= true;
			}
		}
	}
	//desceneding
	unset($blocking);
	$num				= $kingSq{1} - 1;
	for($x=1;$x<=$num;++$x){
		$square			= $kingSq{0}.($kingSq{1} - $x);
		$piece			= $locations[$square];
		if($piece{1} == $defenseColor){
			$blocking	= true;
		}elseif($piece{1} == $attackColor && !$blocking){
			if($piece{0} == 'r' || $piece{0} == 'q'){
				$check[]	= $square;
			}elseif($piece{0} == 'k' && $x == 1){
				$check[]	= $square;
			}else{
				$blocking	= true;
			}
		}
	}
	//--see if king is in check along ROW
	//left to right
	unset($blocking);
	$num				= 104 - ord($kingSq{0});
	for($x=1;$x<=$num;++$x){
		$square			= chr(ord($kingSq{0}) + $x).$kingSq{1};
		$piece			= $locations[$square];	
		if($piece{1} == $defenseColor){
			$blocking	= true;
		}elseif($piece{1} == $attackColor && !$blocking){
			if($piece{0} == 'r' || $piece{0} == 'q'){
				$check[]	= $square;
			}elseif($piece{0} == 'k' && $x == 1){
				$check[]	= $square;
			}else{
				$blocking	= true;
			}
		}
	}
	//right to left
	unset($blocking);
	$num				= ord($kingSq{0}) - 97;
	for($x=1;$x<=$num;++$x){
		$square			= chr(ord($kingSq{0}) - $x).$kingSq{1};
		$piece			= $locations[$square];
		if($piece{1} == $defenseColor){
			$blocking	= true;
		}elseif($piece{1} == $attackColor && !$blocking){
			if($piece{0} == 'r' || $piece{0} == 'q'){
				$check[]	= $square;
			}elseif($piece{0} == 'k' && $x == 1){
				$check[]	= $square;
			}else{
				$blocking	= true;
			}
		}
	}
	//--see if king is in check along DIAGONALS
	//up and right
	unset($blocking);
	$num				= 8-$kingSq{1};
	for($x=1;$x<=$num;++$x){
		$squareA				= ord($kingSq{0}) + $x;
		if($squareA <= 104){
			$square 			= chr($squareA).($kingSq{1} + $x);
			$piece				= $locations[$square];
			if($piece{1} == $defenseColor){
				$blocking	= true;
			}elseif($piece{1} == $attackColor && !$blocking){
				if($piece{0} == 'b' || $piece{0} == 'q'){
					$check[]	= $square;
				}elseif($piece{0} == 'p' && $x == 1 && $attackColor != 'l'){
					$check[]	= $square;
				}elseif($piece{0} == 'k' && $x == 1){
					$check[]	= $square;
				}else{
					$blocking	= true;
				}
			}
		}
	}
	//up and left
	unset($blocking);
	$num				= 8-$kingSq{1};
	for($x=1;$x<=$num;++$x){
		$squareA				= ord($kingSq{0}) - $x;
		if($squareA >= 97){
			$square 			= chr($squareA).($kingSq{1} + $x);
			$piece				= $locations[$square];
			if($piece{1} == $defenseColor){
				$blocking	= true;
			}elseif($piece{1} == $attackColor && !$blocking){			
				if($piece{0} == 'b' || $piece{0} == 'q'){
					$check[]	= $square;
				}elseif($piece{0} == 'p' && $x == 1 && $attackColor != 'l'){
					$check[]	= $square;
				}elseif($piece{0} == 'k' && $x == 1){
					$check[]	= $square;
				}else{
					$blocking	= true;
				}
			}
		}
	}		
	//down and left
	unset($blocking);
	$num				= $kingSq{1}-1;
	for($x=1;$x<=$num;++$x){
		$squareA				= ord($kingSq{0}) + $x;
		if($squareA <= 104){
			$square 			= chr($squareA).($kingSq{1} - $x);
			$piece				= $locations[$square];
			if($piece{1} == $defenseColor){
				$blocking	= true;
			}elseif($piece{1} == $attackColor && !$blocking){
				if($piece{0} == 'b' || $piece{0} == 'q'){
					$check[]	= $square;
				}elseif($piece{0} == 'p' && $x == 1 && $attackColor != 'd'){
					$check[]	= $square;
				}elseif($piece{0} == 'k' && $x == 1){
					$check[]	= $square;
				}else{
					$blocking	= true;
				}
			}
		}
	}
	//down and right
	unset($blocking);
	$num				= $kingSq{1}-1;
	for($x=1;$x<=$num;++$x){
		$squareA				= ord($kingSq{0}) - $x;
		if($squareA >= 97){
			$square 			= chr($squareA).($kingSq{1} - $x);
			$piece				= $locations[$square];
			if($piece{1} == $defenseColor){
				$blocking	= true;
			}elseif($piece{1} == $attackColor && !$blocking){
				if($piece{0} == 'b' || $piece{0} == 'q'){
					$check[]	= $square;
				}elseif($piece{0} == 'p' && $x == 1 && $attackColor != 'd'){
					$check[]	= $square;
				}elseif($piece{0} == 'k' && $x == 1){
					$check[]	= $square;
				}else{
					$blocking	= true;
				}
			}
		}
	}
	//--see if king is in check from KNIGHT
	//from far right
	$squareN[]	= chr(ord($kingSq{0}) - 2).($kingSq{1} + 1);
	$squareN[]	= chr(ord($kingSq{0}) - 2).($kingSq{1} - 1);
	//from far left
	$squareN[]	= chr(ord($kingSq{0}) + 2).($kingSq{1} + 1);
	$squareN[]	= chr(ord($kingSq{0}) + 2).($kingSq{1} - 1);
	//from near right
	$squareN[]	= chr(ord($kingSq{0}) - 1).($kingSq{1} + 2);
	$squareN[]	= chr(ord($kingSq{0}) - 1).($kingSq{1} - 2);
	//from near left
	$squareN[]	= chr(ord($kingSq{0}) + 1).($kingSq{1} + 2);
	$squareN[]	= chr(ord($kingSq{0}) + 1).($kingSq{1} - 2);
	//with the above array check for threatening knights
	for($x=0;$x<8;++$x){
		$square = $squareN[$x];
		$piece	= $locations[$square];
		if($piece{1} == $attackColor && $piece{0} == 'n'){
			$check[]	= $square;
		}
	}
	return $check;
}
?>