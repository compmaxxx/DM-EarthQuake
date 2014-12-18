<?php include_once "template/header.php" ?>

<!--dmin = [0,44.507], gap = [10,356.4]-->


<form action="magRegression.php" method="post" class="form-inline" role="form">
	<div class="form-group">
		<input class="form-control" name="dmin" type="number" min="0" max="44.507" step="any" placeholder="Enter DMIN Value">
		<input class="form-control" name="gap" type="number" min="10" max="356.4" step="any" placeholder="Enter GAP Value">
		<input class="form-control" name="lat" type="number" min="-90" max="90" step="any" placeholder="Enter Latitude Value">	
		<input class="form-control" name="lng" type="number" min="-180" max="180" step="any" placeholder="Enter Longitude Value">
		
	<button type="submit" class="btn btn-default">Enter</button>
	</div>
</form>


<?php include_once "template/footer.php" ?>
