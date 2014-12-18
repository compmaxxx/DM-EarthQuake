<?php
	$level = "";
	$dmin=($_GET["dmin"]-0.277)/1.002;
	$gap=($_GET["gap"]-126.661)/60.489;
	$lat=($_GET["lat"]-42.759)/15.082;
	$lng=($_GET["lng"]+121.011)/41.594;
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