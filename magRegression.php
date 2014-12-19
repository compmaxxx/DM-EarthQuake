<?php
	$level = "";
	$dmin=$_GET["dmin"];
	$gap=$_GET["gap"];
	$lat=$_GET["lat"];
	$lng=$_GET["lng"];

	$mag = (0.332*$dmin)+(0.006*$gap)-(0.003*$lat)+(0.006*$lng)+2.357;
	$result = round($mag,3);
	if ($result <= 3.9)
		$level = "Low";
	elseif ($result <=5.9) {
		$level = "Medium";
	}
	else
		$level = "High";
	$out=[];
	$out[]=round($mag,3);
	$out[]=$level;
	echo json_encode($out);
?>