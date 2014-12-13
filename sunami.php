<?php include_once "template/header.inc.php" ?>

<form action="action_sunami.php" method="POST">
	<fieldset>
	<legend>Input :</legend>
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

<?php include_once "template/footer.inc.php" ?>
