<?php include_once "template/header.php" ?>

<?php
	$input_mag = $_POST["magnitude"];
	$input_lat = $_POST["latitude"];
	$input_lng = $_POST["longtitude"];

	$mag = array(0.123,0,0.139);
	$lat = array(0.029,0,0.016);
	$lng = array(-0.042,0,0);
	$oth = array(-0.047,0,-0.045);

	$sum = 0;
	
	$sd_mag = array(1.155,1,0.834);
	$mean_mag = array(1.669,0,1.451);

	$sd_lat = array(17.215,1,13.048);
	$mean_lat = array(41.336,0,43.607);

	$sd_lng = array(58.913,1,33.404);
	$mean_lng = array(-113.013,0,-123.705);
	
?>

TEST KiE
<br>
<?php echo "mag: $input_mag"; ?>
<br>
<?php 
	$nor_mag = ($input_mag - $mean_mag) / $sd_mag;
	echo "nor_mag: $nor_mag"; ?>
<br><br>
<?php echo "lat: $input_lat"; ?>
<br>
<?php 
	$nor_lat = ($input_lat - $mean_lat) / $sd_lat;
	echo "nor_lat: $nor_lat"; ?>
<br>
<br><br>
<?php echo "lng: $input_lng"; ?>
<br>
<?php 
	$nor_lng = ($input_lng - $mean_lng) / $sd_lng;
	echo "nor_lng: $nor_lng"; ?>
<br>

<br>
<?php
	$sum = ($nor_mag * $mag[0]) + ($nor_lat * $lat) + ($nor_lng * $lng) + $oth;
	echo "regession: $sum";
?>

<?php include_once "template/footer.php" ?>
