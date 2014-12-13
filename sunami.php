<?php include_once "template/header.php" ?>

<form action="action_sunami.php" method="POST">
	<fieldset>
	<legend>Input :</legend>
	Continent: 
	<input type="radio" name="continent" value="all">All
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

<?php include_once "template/footer.php" ?>
