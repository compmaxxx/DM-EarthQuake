<?php include_once "template/header.php" ?>

<style>
body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  width: 960px;
  height: 500px;
  position: relative;
}
path.slice{
	stroke-width:2px;
}
polyline{
	opacity: .3;
	stroke: black;
	stroke-width: 2px;
	fill: none;
} 
svg text.percent{
	fill:white;
	text-anchor:middle;
	font-size:12px;
}
</style>

<!-- compute INPUT for SunamiValue -->
<?php
	$input_ctn = $_POST["continent"];
	$input_mag = $_POST["magnitude"];
	$input_lat = $_POST["latitude"];
	$input_lng = $_POST["longtitude"];

	//array: all, africa, antarctica, asia, europe, north, oceanic, south
	$mag = array(0.017,0,0.178,0.025,0,0.014,0.080,0);
	$lat = array(0.003,0,0,0,0,0.003,0.042,0);
	$lng = array(-0.007,0,0,0,0,0,-0.033,0);
	$oth = array(0.004,0,0.034,0.006,0,0.003,0.025,0);

	$sum = 0;
	$i = 0;

	$sd_mag = array(1.155,1,0.465,0.442,1,0.834,0.963,1);
	$mean_mag = array(1.669,0,5.144,4.736,0,1.451,4.593,0);

	$sd_lat = array(17.215,1,1.498,17.107,1,13.048,31.321,1);
	$mean_lat = array(41.336,0,-56.263,16.330,0,43.607,0.352,0);

	$sd_lng = array(58.913,1,4.626,29.546,1,33.404,142.013,1);
	$mean_lng = array(-113.013,0,-28.153,108.464,0,-123.705,0.353,0);

	$max = array(0.081,1,0.247,0.153,1,0.087,0.241,1);
	$min = array(-0.033,0,-0.174,-0.037,0,-0.036,-0.206,0);

	if ($input_ctn == "all") {
		$i = 0;
	}
	elseif ($input_ctn == "africa") {
		$i = 1;
	}
	elseif ($input_ctn == "antarctica") {
		$i = 2;
	}
	elseif ($input_ctn == "asia") {
		$i = 3;
	}
	elseif ($input_ctn == "europe") {
		$i = 4;
	}
	elseif ($input_ctn == "north") {
		$i = 5;
	}
	elseif ($input_ctn == "oceanic") {
		$i = 6;
	}
	elseif ($input_ctn == "south") {
		$i = 7;
	}
?>

Result: Linear-Regession
<br><?php echo "continent: $input_ctn"; ?>
<br><br><?php echo "mag: $input_mag"; ?>
<br><?php 
	$nor_mag = ($input_mag - $mean_mag[$i]) / $sd_mag[$i];
	echo "nor_mag: $nor_mag"; ?>
<br><br><?php echo "lat: $input_lat"; ?>
<br><?php 
	$nor_lat = ($input_lat - $mean_lat[$i]) / $sd_lat[$i];
	echo "nor_lat: $nor_lat"; ?>
<br><br><?php echo "lng: $input_lng"; ?>
<br>

<?php
	$nor_lng = ($input_lng - $mean_lng[$i]) / $sd_lng[$i];
	echo "nor_lng: $nor_lng"; ?>
<br><br><?php
	$sum = ($nor_mag * $mag[$i]) + ($nor_lat * $lat[$i]) + ($nor_lng * $lng[$i]) + $oth[$i];
	echo "regession: $sum"; ?>
<br><?php
	if ($sum < $min[$i]) {
		$nor_sum = 0;
	}
	elseif ($sum > $max[$i]) {
		$nor_sum = 1;
	}
	else {
		$nor_sum = ($sum - $min[$i]) / ($max[$i] - $min[$i]);
	}
	echo "nor_regession: $nor_sum"; ?>

<!-- configure for pass data from PHP to JS -->
<br><br><?php 
	$bValue = 0;
	$pValue = 1;
	if ($nor_sum < 0.5) { 
		$bValue = 1-$nor_sum;
		$pValue = $nor_sum;
	}
	else { 
		$bValue = 1-$nor_sum;
		$pValue = $nor_sum;
	} ?>

จากการคำนวณ Linear Regession สามารถแสดงผลในรูป % ของการเกิด sunami จากเหตุการร์แผ่นดินไหวได้ดังนี้<br>
โดย	<br>
- สีน้ำเงิน : ไม่มีโอกาสเกิด sunami <br>
- สีแดง : มีโอกาสเกิด sunami <br>

<script src="asset/d3/Donut3D.js"></script>
<script>
var salesData=[
	{label:"Basic", color:"#3366CC", text:"no-sunami", value:<?php echo $bValue; ?>},
	{label:"Plus", color:"#DC3912", text:"sunami", value:<?php echo $pValue; ?>}
	];

var svg = d3.select("body").append("svg").attr("width",700).attr("height",300);

svg.append("g").attr("id","salesDonut");

Donut3D.draw("salesDonut", Data(), 150, 150, 130, 100, 30, 0.4);

function Data(){
	return salesData.map(function(d){ 
		return {label:d.label, value:d.value, color:d.color, text:d.text};
	});
}
</script>

<?php include_once "template/footer.php" ?>
