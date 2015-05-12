<?php  //Start the Session

require('connect.php');
require_once("./include/config.php");
if(!$usersite->CheckLogin())
{
    $usersite->RedirectToURL("logout.php");
    exit;
}
?>
<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/navbar/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="http://getbootstrap.com/examples/navbar/navbar.css" rel="stylesheet">
 -->

  </head>
<body>

    <div class="container">
           <?php include 'header.php' ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <div id="map"></div>
        <div id="legend"></div>
        <script src="js/jquery.min.js"></script>

        <script src="js/d3.v3.min.js"></script>
        <script src="js/queue.v1.min.js"></script>
        <script src="js/topojson.v1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>


        var width = 800,
        height = 500;

        queue()
        .defer(d3.json, "data/us.json")
        .defer(d3.csv, "data/state_avg_rating.csv", function(d) { 
            rateById.set(d.id, +d.rate); 
            nameById.set(d.id, d.name);
        })
        .await(ready);

        var rateById = d3.map();
        var nameById = d3.map();

        var quantize = d3.scale.quantize()
        .domain([3.38727415554, 3.99640933573])
        .range(d3.range(9).map(function(i) {return "q" + (i) + "-9";}));

        var projection = d3.geo.albersUsa()
        .scale(900)
        .translate([width / 2, height / 2]);

        var path = d3.geo.path()
        .projection(projection);

        var svg = d3.select("#map").append("svg")
        .attr("width", width)
        .attr("height", height);

        var div = d3.select("#map").append("div")   
        .attr("class", "tooltip")               
        .style("opacity", 0);

        function ready(error, us) {

          svg.append("g")
          .attr("class", "states_avg")
          .selectAll("path")
          .data(topojson.feature(us, us.objects.states).features)
          .enter().append("path")
          .attr("class", function(d) { 
            return quantize(rateById.get(d.id))+" "+d.id;
          })
          .attr("d", path)
          .on("mouseover", function(d) { 

            d3.select(".mouseOver_avg")
            .classed("mouseOver_avg", false);
            $(".name_text").html(nameById.get(d.id));
            $(".rating_text").html(rateById.get(d.id));

            d3.select(this)
            .classed("mouseOver_avg", true);

        })                  
          .on("mouseout", function(d) {       
            div.transition()        
            .duration(500)      
            .style("opacity", 0);   
        });

/*
          var legendColors = [" rgb(247,251,255)"," rgb(222,235,247)"," rgb(198,219,239)"," rgb(158,202,225)",
          " rgb(107,174,214)"," rgb(153, 166, 255)"," rgb(33,113,181)"," rgb(8,81,156)"," rgb(8,48,107)"];

          legendElementWidth = width/legendColors.length

          var legendSvg = d3.select("#legend").append("svg")
          .attr("width", width)
          .attr("height", 200);

          var legend = legendSvg.selectAll(".legend")
          .data(legendColors)
          .enter().append("g")
          .attr("class", "legend");


          legend.append("rect")
          .attr("x", function(d, i) { return legendElementWidth * i; })
          .attr("y", 100)
          .attr("width", legendElementWidth)
          .attr("height", 30)
          .style("fill", function(d, i) { return legendColors[i]; });

          legend.append("text")
          .attr("class", "mono")
          .text(function(d,i) { 
            return "≥ " + "." + (i) })
          .attr("x", function(d, i) { return legendElementWidth * i + legendElementWidth/5; })
          .attr("y", 150)*/

      }

      d3.select(self.frameElement).style("height", height + "px");

      </script>
      <div class="col-md-2"></div>
      <div class="panel panel-primary">
        <div class="panel-heading">Average Rating by State</div>
        <div class="panel-body name_text">
          -
        </div>
        <div class="panel-body rating_text">
          -
        </div>
      </div>

  
        </sent>


    </div>
  </div>
  </div>
</body>
</html>
