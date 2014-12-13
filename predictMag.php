<?php include_once "template/header.inc.php" ?>
PREDICT MAGNITUDE BY REGRESSION
<!--dmin = [0,44.507], gap = [10,356.4]-->

<form action="magRegression.php" method="post">
	dmin	: <input name="dmin" type="number" min="0" max="44.507" step="any"><br>
	gap		: <input name="gap" type="number" min="10" max="356.4" step="any"><br>
	lat		: <input name="lat" type="number" min="-90" max="90" step="any"><br>
	lng		: <input name="lng" type="number" min="-180" max="180" step="any"><br>
	<button type="submit">Enter</button>
</form>


<?php include_once "template/footer.inc.php" ?>
