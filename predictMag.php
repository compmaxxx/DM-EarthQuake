<?php include_once "template/header.php" ?>

<!--dmin = [0,44.507], gap = [10,356.4]-->
<link rel="stylesheet" href="style.css"/>

<form action="magRegression.php" class="form-inline" role="form">
	<div class="form-group">
		<div class="row">
  			<div class="col-lg-3">DMIN (km.)</div>
  			<div class="col-lg-3">GAP</div>
  			<div class="col-lg-3">LATITUDE (degree)</div> 	
  			<div class="col-lg-3">LONGITUDE (degree)</div> 
		<br>
		<input class="form-control col-lg-3" name="dmin" type="number" min="0" max="44.507" step="any" placeholder="Enter DMIN Value">
		<input class="form-control col-lg-3" name="gap" type="number" min="10" max="356.4" step="any" placeholder="Enter GAP Value">
		<input class="form-control col-lg-3" name="lat" type="number" min="-90" max="90" step="any" placeholder="Enter Latitude Value">	
		<input class="form-control col-lg-3" name="lng" type="number" min="-180" max="180" step="any" placeholder="Enter Longitude Value">
		
		<button name="enter" type="submit" class="btn btn-default">Enter</button>
		</div>
	</div>
</form>

<div id="result" style="visibility: hidden;">
	<p id="dmin">DMIN = </p>
	<p id="gap">GAP = </p>
	<p id="lat">Latitude = </p>
	<p id="lng">Longitude = </p>
	<h3><p>
		<div id="mag" class="label label-warning">Magnitude = </div>
	</p></h3>
</div>

<script type="text/javascript">
	$('button[name^="enter"]').click(function(){
		
		$.get("magRegression.php", {
			dmin:$('input[name^="dmin"]').val(),
			gap:$('input[name^="gap"]').val(),
			lat:$('input[name^="lat"]').val(),
			lng:$('input[name^="lng"]').val()})
			.done(function(data){
				data = $.parseJSON(data);
				$('#result').css('visibility', 'visible');
				$('#dmin').text("DMIN = "+$('input[name^="dmin"]').val()+" km.");
				$('#gap').text("GAP = "+$('input[name^="gap"]').val());
				$('#lat').text("Latitude = "+$('input[name^="lat"]').val()+" degree");
				$('#lng').text("Longitude = "+$('input[name^="lng"]').val()+" degree");
				$('#mag').text("Magnitude = "+data[0]+" richter" + "  ( " + data[1] + " Level )");
			})
		return false;
	});
</script>

<?php include_once "template/footer.php" ?>
