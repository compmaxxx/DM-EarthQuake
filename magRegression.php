<?php
	$dmin=($_POST["dmin"]-0.277)/1.002;
	$gap=($_POST["gap"]-126.661)/60.489;
	$lat=($_POST["lat"]-42.759)/15.082;
	$lng=($_POST["lng"]+121.011)/41.594;
	$mag = (0.332*$dmin)+(0.006*$gap)-(0.003*$lat)+(0.006*$lng)+2.357;
	echo $mag;
?>
