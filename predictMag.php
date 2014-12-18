<?php include_once "template/header.php" ?>

<!--dmin = [0,44.507], gap = [10,356.4]-->

<form action="magRegression.php" class="form-inline" role="form">
	<div class="form-group">
		<input class="form-control" name="dmin" type="number" min="0" max="44.507" step="any" placeholder="Enter DMIN Value">
		<input class="form-control" name="gap" type="number" min="10" max="356.4" step="any" placeholder="Enter GAP Value">
		<input class="form-control" name="lat" type="number" min="-90" max="90" step="any" placeholder="Enter Latitude Value">	
		<input class="form-control" name="lng" type="number" min="-180" max="180" step="any" placeholder="Enter Longitude Value">
		
	<button name="enter" type="submit" class="btn btn-default">Enter</button>
	</div>
</form>

<div id="result" style="visibility: hidden;">
	<p id="dmin">DMIN = </p>
	<p id="gap">GAP = </p>
	<p id="lat">Latitude = </p>
	<p id="lng">Longitude = </p>
	<p id="mag">MAGNITUDE = </p>
</div>

<script type="text/javascript">
	$('button[name^="enter"]').click(function(){
		
		$.get("magRegression.php", {
			dmin:$('input[name^="dmin"]').val(),
			gap:$('input[name^="gap"]').val(),
			lat:$('input[name^="lat"]').val(),
			lng:$('input[name^="lng"]').val()})
			.done(function(data){
				$('#result').css('visibility', 'visible');
				$('#dmin').text($('#dmin').text()+$('input[name^="dmin"]').val());
				$('#gap').text($('#gap').text()+$('input[name^="gap"]').val());
				$('#lat').text($('#lat').text()+$('input[name^="lat"]').val());
				$('#lng').text($('#lng').text()+$('input[name^="lng"]').val());
				$('#mag').text($('#mag').text()+data);
			})
		return false;
	});
</script>

<?php include_once "template/footer.php" ?>
