<?php include_once "template/header.php" ?>
<form action="action_sunami.php" method="POST" class="form-inline" role="form">
	<div class="form-group">
		<h3>Continent</h3>
		<div class="input-group">
			<input type="radio" name="continent" value="all">All
			<input type="radio" name="continent" value="africa">Africa
			<input type="radio" name="continent" value="antarctica">Antarctica
			<input type="radio" name="continent" value="asia">Asia
			<input type="radio" name="continent" value="europe">Europe
			<input type="radio" name="continent" value="north">North-Amarica
			<input type="radio" name="continent" value="oceanic">Oceanic
			<input type="radio" name="continent" value="south">South-Amarica
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<div class="input-group-addon">@</div>
			<input type="text" class="form-control" name="magnitude" placeholder="Magnitude Value">
		</div>

		<div class="input-group">
			<div class="input-group-addon">@</div>
			<input type="text" class="form-control" name="latitude" placeholder="Latitude Value">
		</div>

		<div class="input-group">
			<div class="input-group-addon">@</div>
			<input type="text" class="form-control" name="longtitude" placeholder="Longitude Value">
		</div>
	</div>
	<div class="input-group">
		<input type="submit" class="btn btn-default" value="Submit">
	</div>
</form>
<?php include_once "template/footer.php" ?>
