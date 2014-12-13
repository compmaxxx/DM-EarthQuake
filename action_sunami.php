<?php include_once "template/header.php" ?>

<?php
	$input_mag = $_POST["magnitude"];
	$input_lat = $_POST["latitude"];
	$input_lng = $_POST["longtitude"];

	$mag = 0.123;
	$lat = 0.029;
	$lng = -0.042;
	$oth = -0.047;

	$sum = 0;
?>

TEST KiE
<br>
<?php echo "mag: $input_mag"; ?>
<br>
<?php echo "lat: $input_lat"; ?>
<br>
<?php echo "lng: $input_lng"; ?>

<?php
	//$sum = $sum + ($input_mag * $mag) + ($input_lat * $lat) + ($input_lng * $lng) + $oth;
?>

<?php include_once "template/footer.php" ?>
