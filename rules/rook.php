<?php
function rookRules($locations,$newSpot,$oldSpot,$movingPiece,$rookStr=null){
	if($oldSpot{0} == $newSpot{0}){
		//forward COLUMN movement
		if($newSpot{1} > $oldSpot{1}){
			$ignore			= 'down';
			$num			= ($newSpot{1} - $oldSpot{1}) - 1;
			for($x=0;$x<$num;++$x){
				$sqCheck 	= $newSpot{0}.($oldSpot{1} + 1 + $x);
				if($locations[$sqCheck] != '') $rookMove['error'] = $rookStr[0];
			}
		}else{
		//backward COLUMN movement
			$ignore			= 'up';
			$num			= ($oldSpot{1} - $newSpot{1}) - 1;
			for($x=0;$x<$num;++$x){
				$sqCheck 	= $newSpot{0}.($oldSpot{1} - 1 - $x);
				if($locations[$sqCheck] != '') $rookMove['error'] = $rookStr[0];
			}
		}
	}elseif($oldSpot{1} == $newSpot{1}){
		//right ROW movement
		if(ord($newSpot{0}) > ord($oldSpot{0})){
			$ignore			= 'left';
			$num			= (ord($newSpot{0}) - ord($oldSpot{0})) - 1;
			for($x=0;$x<$num;++$x){
				$sqCheck 	= chr(ord($oldSpot{0}) + 1 + $x).$newSpot{1};
				if($locations[$sqCheck] != '') $rookMove['error'] = $rookStr[0];
			}
		}else{
		//left ROW movement
			$ignore			= 'right';
			$num			= (ord($oldSpot{0}) - ord($newSpot{0})) - 1;
			for($x=0;$x<$num;++$x){
				$sqCheck 	= chr(ord($oldSpot{0}) - 1 - $x).$newSpot{1};
				if($locations[$sqCheck] != '') $rookMove['error'] = $rookStr[0];
			}
		}
	}else{
		$rookMove['error'] = $rookStr[1];
	}
	if($rookMove[0] != 'error'){		//do we need to be specific about the notation
		if($oldSpot{0} == $newSpot{0}){ $spcNote = $oldSpot{1}; }else{ $spcNote = $oldSpot{0}; }
		if($ignore != 'up'){			//along file UP		
			$num				= 8-$newSpot{1};
			for($x=1;$x<=$num;++$x){
				if(!$nearPiece)$nearPiece	= $locations[$newSpot{0}.($newSpot{1}+$x)];
			}
			if($nearPiece == $movingPiece) $rookMove['notePiece'] = 'R'.$spcNote;
		}
		if(!isset($rookMove['notePiece']) && $ignore != 'down'){		//along file DOWN
			unset($nearPiece);
			$num				= $newSpot{1}-1;
			for($x=1;$x<=$num;++$x){
				if(!$nearPiece)$nearPiece	= $locations[$newSpot{0}.($newSpot{1}-$x)];
			}
			if($nearPiece == $movingPiece) $rookMove['notePiece'] = 'R'.$spcNote;
		}
		if(!isset($rookMove['notePiece']) && $ignore != 'left'){		//along rank RIGHT
			unset($nearPiece);
			$num				= ord($newSpot{0})-97;
			for($x=1;$x<=$num;++$x){
				if(!$nearPiece)$nearPiece	= $locations[chr(ord($newSpot{0})-$x).$newSpot{1}];
			}
			if($nearPiece == $movingPiece) $rookMove['notePiece'] = 'R'.$spcNote;
		}
		if(!isset($rookMove['notePiece']) && $ignore != 'right'){		//along rank LEFT
			unset($nearPiece);
			$num				= 104-ord($newSpot{0});
			for($x=1;$x<=$num;++$x){
				$thing = chr(ord($newSpot{0})+$x).$newSpot{1};
				if(!$nearPiece)$nearPiece	= $locations[chr(ord($newSpot{0})+$x).$newSpot{1}];
			}
			if($nearPiece == $movingPiece) $rookMove['notePiece'] = 'R'.$spcNote;
		}
	}
	return $rookMove;
}
?>