<?php 
if(isset($_POST['action'])) {
	$arr = array("Charbagh"=> 0 ,
		"Indira Nagar"=>10 ,
		"BBD"=> 30 ,
		"Barabanki"=>60 ,
		"Faizabad"=>100 ,
		"Basti"=>150 ,
		"Gorakhpur"=>210
	);
	function getdistance($a , $b) {
		if($a > $b) {
			$d = $a - $b;
			return $d;
		}
		else {
			$d = $b-$a;
			return $d;
		}

	}
	function calculateFare($d , $wt ,$fixedFare ,$d1 ,$d2 ,$d3 ,$d1price ,$d2price ,$d3price ,$d4price ,$charge ) {
		$w1price = 50;
		$w2price = 100;
		$w3price = 200;
		if($d == 0) {
			return 0;
		}
		elseif($d > 0 && $d  <= $d1) {
			if($wt == 0) {
				$fare = ($d1*$d1price)+ $fixedFare;
				return $fare;
			}
			elseif($wt >0 && $wt <= 10) {
				$fare = ($d*$d1price) + $w1price*$charge + $fixedFare;
				return $fare;
			}
			elseif(10 < $wt && $wt <= 20) {
				$fare = ($d*$d1price) + $w2price*$charge + $fixedFare;
				return $fare;
			}
			else {
				$fare = ($d*$d1price) + $w3price*$charge + $fixedFare;
				return $fare;
			}
		}
		elseif($d  > $d1 && $d <= ($d1+$d2)) {
			$dsub = $d-$d1;
			//echo $dsub;
			if($wt == 0) {
				$fare = ($d1*$d1price) + ($dsub*$d2price)  + $fixedFare;
				return $fare;
			}
			elseif($wt>0 && $wt <= 10) {
				$fare = ($d1*$d1price) + ($dsub*$d2price) + $w1price*$charge + $fixedFare;
				return $fare;
			}
			elseif(10 < $wt && $wt <= 20) {
				$fare = ($d1*$d1price) + ($dsub*$d2price) + $w2price*$charge + $fixedFare;
				return $fare;
			}
			else {
				$fare = ($d1*$d1price) + ($dsub*$d2price) + $w3price*$charge + $fixedFare;
				return $fare;
			}
		}
		elseif($d  > 60 && $d <= ($d1+$d2+$d3)) {
			$dsub = $d-$d2- $d1;
			if($wt == 0) {
				$fare = ($d1*$d1price) + ($d2*$d2price) + ($dsub*$d3price)  + $fixedFare;
				return $fare;
			}
			elseif($wt >0 && $wt <= 10) {
				$fare = ($d1*$d1price) + ($d2*$d2price) + ($dsub*$d3price) + $w1price*$charge + $fixedFare;
				return $fare;
			}
			elseif(10 < $wt && $wt <= 20) {
				$fare = ($d1*$d1price) + ($d2*$d2price) + ($dsub*$d3price) + $w2price*$charge + $fixedFare;
				return $fare;
			}
			else {
				$fare = ($d1*$d1price) + ($d2*$d2price) + ($dsub*$d3price) + $w3price*$charge + $fixedFare;
				return $fare;
			}
		}
		elseif($d > ($d1+$d2+$d3)) {
			$dsub = $d -$d1 -$d2 -$d3;
			if($wt == 0) {
				$fare = ($d1*$d1price) + ($d2*$d2price) + ($d3*$d3price) + ($dsub*$d4price) + $fixedFare;
				return $fare;
			}
			if($wt > 0 && $wt <= 10) {
				$fare = ($d1*$d1price) + ($d2*$d2price) + ($d3*$d3price) + ($dsub*$d4price) + $w1price*$charge + $fixedFare;
				return $fare;
			}
			elseif(10 < $wt && $wt <= 20) {
				$fare = ($d1*$d1price) + ($d2*$d2price) + ($d3*$d3price) + ($dsub*$d4price) + $w2price*$charge + $fixedFare;
				return $fare;
			}
			else {
				$fare = ($d1*$d1price) + ($d2*$d2price) + ($d3*$d3price) + ($dsub*$d4price) + $w3price*$charge + $fixedFare;
				return $fare;
			}
		}
	}
	if($_POST['action'] == 'test'){
		$pickup = isset($_POST['pickup']) ? $_POST['pickup'] : '';
		$drop = isset($_POST['drop']) ? $_POST['drop'] : '';
		$wt = isset($_POST['wt']) ? $_POST['wt'] : 0 ;
		$cab = isset($_POST['cab']) ? $_POST['cab'] :'';
		$d = null;
		$d1=10;
		$d2 =50;
		$d3 = 100;
		$fare = '';
		$html ='';
		if($cab == "CedMini") {
			$d1price= 14.50;
			$d2price = 13.00;
			$d3price = 11.2;
			$d4price = 9.5;
			$fixedFare = 150;
			$charge =1;
		}
		elseif($cab == "CedMicro") {
			$d1price= 13.50;
			$d2price = 12.00;
			$d3price = 10.2;
			$d4price = 8.5;
			$fixedFare = 50;
			$charge =1;
		}
		elseif($cab == "CedRoyal") {
			$d1price= 15.50;
			$d2price = 14.00;
			$d3price = 12.2;
			$d4price = 10.5;
			$fixedFare = 200;
			$charge =1;
		}
		elseif($cab == "CedSUV") {
			$d1price= 16.50;
			$d2price = 15.00;
			$d3price = 13.2;
			$d4price = 11.5;
			$fixedFare = 250;
			$charge = 2;
		}
		foreach($arr as $k=>$v) {
			if($pickup == $k) {
				foreach ($arr as $key => $value) {
					if($drop == $key) {
						$d = getdistance($value , $v);
							//echo $d;
						$fare = calculateFare($d ,$wt ,$fixedFare ,$d1,$d2 ,$d3 , $d1price ,$d2price ,$d3price ,$d4price ,$charge);
					}
				}
			}
		}
		$html = '<div class="right">
			<h2 class="text-center">Calculate Fare</h2>
			<p>Your Location : '.$pickup.'</p>
			<p>Drop Location : '.$drop.'</p>
			<p>Cab Type : '.$cab.'</p>
			<p>Total Fare :'.$fare.'</p>
			</div>';

		$f = array('fare'=> $html);
		echo json_encode($f);
	}
}
?>