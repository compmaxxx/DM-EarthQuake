<?php include_once "template/header.php" ?>

<!--dmin = [0,44.507], gap = [10,356.4]-->
<!-- <link rel="stylesheet" href="style.css"/> -->

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

<script src="asset/d3/d3.v2.min.js"></script>
<style>

svg {
	width: 1280px;
	height: 800px;
	pointer-events: all;
}

circle {
	fill: #f70000;
}

path {
	fill: #b217c3;
	stroke: #fff;
}

</style>


<div>
	<p>Latitude: <span id="lati"></span></p>
	<p>Longitude: <span id="long"></span></p>
</div>
<div id="body">

</div>

<script>
function showPosition() {
	var position = projection.invert(d3.mouse(this));
	var long = isNaN(position[0])? 0:position[0];
	var lat = isNaN(position[1])? 0:position[1];


	$("#lati").text(lat);
	$("#long").text(long);
}
function inputPosition()
{
	var position = projection.invert(d3.mouse(this));
	var long = isNaN(position[0])? 0:position[0];
	var lat = isNaN(position[1])? 0:position[1];

	$('input[name^="lat"]').val(lat);
	$('input[name^="lng"]').val(long);
}
$(document).ready(function(){
	d3.select("svg").on("mousemove.log",showPosition);
	d3.select("svg").on("mousedown.log",inputPosition);
});

</script>

<script>

	var feature;
	var quakes;

	var projection = d3.geo.azimuthal()
	.scale(380)
	.origin([-71.03,42.37])
	.mode("orthographic")
	.translate([640, 400]);

	var circle = d3.geo.circle()
	.origin(projection.origin());

	// TODO fix d3.geo.azimuthal to be consistent with scale
	var scale = {
		orthographic: 380,
		stereographic: 380,
		gnomonic: 380,
		equidistant: 380 / Math.PI * 2,
		equalarea: 380 / Math.SQRT2
	};

	var path = d3.geo.path()
	.projection(projection);

	var svg = d3.select("#body").append("svg:svg")
	.attr("width", 1280)
	.attr("height", 800)
	.on("mousedown", mousedown);


	d3.json("asset/d3/world-countries.json", function(collection) {
		feature = svg.selectAll("path")
		.data(collection.features)
		.enter().append("svg:path")
		.attr("d", clip);

		feature.append("svg:title")
		.text(function(d) { return d.properties.name; });

		/*Copy*/
		var qCXNs=[];
		function processQuakes(collection) {
			quakes = svg.selectAll("quakes")
			.data(collection.features)
			.enter()
			.append("svg:circle")
			// .on("mouseover", function(d) {
			//   // First unhighlight the rest of quakes
			//   quakes
			//   .attr("class", "quake");
			//
			//   element = d3.select(this);
			//   element
			//   .attr("class", "quake-selected");
			//
			//   var quakeDate = new Date(d.properties.time * 1000);
			//   quakeText
			//   .attr("href", d.properties.url)
			//   .attr("class", "true-quake-text")
			//   .text(d.properties.mag.toString() + "-magnitude earthquake " +
			//   d.properties.place + " at " + quakeDate.toString());
			//   quakeLink
			//   .attr('href', d.properties.url)
			//   .text("  (Link)  ");
			//
			//   var demoQuake = quakeSVG.selectAll("circle");
			//
			//   demoQuake
			//   .attr("stroke", highlightColor)
			//   .attr("r", richterSize(d.properties.mag))
			//   .attr("opacity", richterOpacity(d.properties.mag))
			//   .attr("fill", richterColors(d.properties.mag));
			//
			// })
			.attr("class", "quake")
			.attr("stroke", "#aaa")
			.attr("stroke-width", 1)
			.attr("fill", function(d) {
				return "red";
			})
			.attr("cx", function(d) {
				return projection([d.long,d.lat])[0];
			})
			.attr("cy", function(d) {
				return projection([d.long,d.lat])[1];
			})
			.attr("r", function(d) {
				return 5;
			});
			refresh();
		}

		function ajaxHelper(data) {
			qCXNs.features = data;
			// if (qCXNs === null) {
			//   qCXNs = data;
			// } else {
			//   qCXNs.push(data);
			// }
			processQuakes(qCXNs);

		}

		d3.csv("data/station/temp.csv", function(data) {
			ajaxHelper(data);
		});

	});



	d3.select(window)
	.on("mousemove", mousemove)
	.on("mouseup", mouseup);

	d3.select("select").on("change", function() {
		projection.mode(this.value).scale(scale[this.value]);
		refresh(750);
	});

	var m0,
	o0;

	function mousedown() {
		m0 = [d3.event.pageX, d3.event.pageY];
		o0 = projection.origin();
		d3.event.preventDefault();
	}

	function mousemove() {
		if (m0) {
			var m1 = [d3.event.pageX, d3.event.pageY],
			o1 = [o0[0] + (m0[0] - m1[0]) / 8, o0[1] + (m1[1] - m0[1]) / 8];
			projection.origin(o1);
			circle.origin(o1)
			refresh();
		}
	}

	function mouseup() {
		if (m0) {
			mousemove();
			m0 = null;
		}
	}


	function refresh(duration) {
		function updateQuake(data) {
			var d = {type: "Point", coordinates: [data.long, data.lat]}
			//  console.log(d);

			var coords = [];
			clipped = circle.clip(d);
			if (clipped !== null) {
				coords[0] = projection(clipped.coordinates)[0];
				coords[1] = projection(clipped.coordinates)[1];
				coords[2] = 1;
			} else {
				coords[0] = projection(d.coordinates)[0];
				coords[1] = projection(d.coordinates)[1];
				coords[2] = 0;
			}
			return coords;
		}


		if (duration) {
			feature.transition().duration(duration).attr("d", clip);
			quakes.transition().duration(duration).attr({
				"cx": function(d) {
					return updateQuake(d)[0];
				},
				"cy": function(d) {
					return updateQuake(d)[1];
				},
				"r": function(d) {
					if (updateQuake(d)[2] === 1) {
						return 5;
					} else {
						return 0;
					}
				}
			});
		} else {
			feature.attr("d", clip);
			quakes.attr({
				"cx": function(d) {
					return updateQuake(d)[0];
				},
				"cy": function(d) {
					return updateQuake(d)[1];
				},
				"r": function(d) {
					if (updateQuake(d)[2] === 1) {
						return 5;
					} else {
						return 0;
					}
				}
			});
		}
	}

	function clip(d) {
		return path(circle.clip(d));
	}

</script>





<?php include_once "template/footer.php" ?>
