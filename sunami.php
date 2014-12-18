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
<!--
<<<<<<< HEAD
<form action="action_sunami.php" method="POST">
	<fieldset>
	<legend>Input :</legend>
	Continent: 
	<input type="radio" name="continent" value="all" checked>All
	<input type="radio" name="continent" value="africa">Africa
	<input type="radio" name="continent" value="antarctica">Antarctica
	<input type="radio" name="continent" value="asia">Asia
	<input type="radio" name="continent" value="europe">Europe
	<input type="radio" name="continent" value="north">North-Amarica
	<input type="radio" name="continent" value="oceanic">Oceanic
	<input type="radio" name="continent" value="south">South-Amarica
	<br>
	Magnitude value: 
	<input type="text" name="magnitude">
	<br>
	Latitude value:
	<input type="text" name="latitude">
	<br>
	Longtitude value:
	<input type="text" name="longtitude">
	<br><br>
	<input type="submit" value="Submit">
	</fieldset>
</form>
=======
>>>>>>> FETCH_HEAD
-->
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
