<?php include_once "template/header.php" ?>
<script src="asset/d3/d3.geo.js"></script>
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
    fill: #0c7c1b;
    stroke: #fff;
  }

</style>

<div id="body">

</div>


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


  d3.json("asset/d3/world-countries.json", function(error, collection) {
    feature = svg.selectAll("path")
    .data(collection.features)
    .enter().append("svg:path")
    .attr("d", clip);

    feature.append("svg:title")
    .text(function(d) { return d.properties.name; });

    /*Copy*/
    var qCXNs=null;
    function processQuakes(collection) {
        quakes = svg.selectAll("quakes")
        .data(collection)
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
        qCXNs = data;
        // if (qCXNs === null) {
        //   qCXNs = data;
        // } else {
        //   qCXNs.push(data);
        // }
        processQuakes(qCXNs);

      }

      d3.csv("data/station/clusterA.csv", function(error, data) {
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

  function richterColors(d) {
    return d3.rgb(colorScale(d)).darker(0.0).toString();
  }

  function refresh(duration) {
    function updateQuake(d) {
      var coords = [];
      clipped = circle.clip(d);
      if (clipped !== undefined) {
        coords[0] = projection([clipped.long,clipped.lat])[0];
        coords[1] = projection([clipped.long,clipped.lat])[1];
        coords[2] = 1;
      } else {
        coords[0] = projection([d.long,d.lat])[0];
        coords[1] = projection([d.long,d.lat])[1];
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
          return 5;
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
          return 5;
        }
      });
    }
  }

  function clip(d) {
    return path(circle.clip(d));
  }


</script>
<?php include_once "template/footer.php" ?>
