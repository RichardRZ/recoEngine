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
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="http://getbootstrap.com/examples/navbar/navbar.css" rel="stylesheet">
 -->
 <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Average Rating HeatMap by Genres and Ages</title>
    <style>
      rect.bordered {
        stroke: #E6E6E6;
        stroke-width:2px;   
      }

      text.mono {
        font-size: 9pt;
        font-family: Consolas, courier;
        fill: #aaa;
      }

      text.axis-workweek {
        fill: #000;
      }

      text.axis-worktime {
        fill: #000;
      }
    </style>
    <script src="http://d3js.org/d3.v3.js"></script>

  </head>
<body>

    <div class="container">
           <?php include 'header.php' ?>
           <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="page-header center">
                <h1> Heatmap of Average Rating</h1>
            </div>
              
            <h2></h2>
            </p>
            <div class="col-md-2"></div>
            <div id="chart"></div>
            <script type="text/javascript">
            var margin = { top: 50, right: 100, bottom: 400, left: 140 },
                width = 960 - margin.left - margin.right,
                height = 1260 - margin.top - margin.bottom,
                gridSize = Math.floor(width / 18),
                legendElementWidth = gridSize*2.4,
                buckets = 10,
                colors = ["#ffffd9","#edf8b1","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#253494","#081d58","#000000"], // alternatively colorbrewer.YlGnBu[9]
                genres = ["GENERAL","ACTION","ADVENTURE","ANIMATION","CHILDREN","COMEDY","CRIME","DRAMA","DOCUMENTARY","FANTASY","FILM-NOIR","HORROR","MUSICAL","MYSTERY","ROMANCE","SCI-FI","THRILLER","WAR","WESTERN"],
                ages = ["0-18", "18-25", "25-34", "35-44", "45-49", "50-55", "56+"];


            d3.tsv("data/average_rating.tsv",
                function(d) {
                    return {
                        genre: +d.genre,
                        age: +d.age,
                        value: +d.value
                    };
                },
                function(error, data) {
                    var colorScale = d3.scale.quantile()
                        //.domain([0, buckets - 1, d3.max(data, function (d) { return d.value; })])
                        .domain([3.0,4.5])
                        .range(colors);

                    var svg = d3.select("#chart").append("svg")
                        .attr("width", width + margin.left + margin.right)
                        .attr("height", height + margin.top + margin.bottom)
                        .append("g")
                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                    var genreLabels = svg.selectAll(".genreLabel")
                        .data(genres)
                        .enter().append("text")
                            .text(function (d) { return d; })
                            .attr("x", 0)
                            .attr("y", function (d, i) { return i * gridSize; })
                            .style("text-anchor", "end")
                            .attr("transform", "translate(-6," + gridSize / 1.5 + ")")
                            .attr("class", function (d, i) { return ((i >= 0 && i <= 18) ? "genreLabel mono axis axis-workweek" : "genreLabel mono axis"); });

                    var ageLabels = svg.selectAll(".ageLabel")
                        .data(ages)
                        .enter().append("text")
                            .text(function(d) { return d; })
                            .attr("x", function(d, i) { return i * gridSize; })
                            .attr("y", 0)
                            .style("text-anchor", "middle")
                            .attr("transform", "translate(" + gridSize / 2 + ", -6)")
                            .attr("class", function(d, i) { return ((i >= 0 && i <= 6) ? "ageLabel mono axis axis-worktime" : "ageLabel mono axis"); });

                    var heatMap = svg.selectAll(".age")
                        .data(data)
                        .enter().append("rect")
                            .attr("x", function(d) { return (d.age - 1) * gridSize; })
                            .attr("y", function(d) { return (d.genre - 1) * gridSize; })
                            .attr("rx", 4)
                            .attr("ry", 4)
                            .attr("class", "hour bordered")
                            .attr("width", gridSize)
                            .attr("height", gridSize)
                            .style("fill", colors[0]);

                    heatMap.transition().duration(1000)
                        .style("fill", function(d) { return colors[Math.ceil((d.value*1000-3150)/150)]; });

                    heatMap.append("title").text(function(d) { return d.value; });
              
                    var legend = svg.selectAll(".legend")
                        .data([0].concat(colorScale.quantiles()), function(d) { return d; })
                        .enter().append("g")
                        .attr("class", "legend");

                    legend.append("rect")
                        .attr("x", function(d, i) { return legendElementWidth/2 * i; })
                        .attr("y", height)
                        .attr("width", legendElementWidth/2)
                        .attr("height", gridSize / 2)
                        .style("fill", function(d, i) { return colors[i]; });

                    legend.append("text")
                        .attr("class", "mono")
                        .text(function(d) { return "≥ " + Math.round(d*100)/100; })
                        .attr("x", function(d, i) { return legendElementWidth/2 * i; })
                        .attr("y", height + gridSize);
            });
            </script>

        
    </div>
  </div>
  <script src="http://d3js.org/d3.v3.min.js"></script>
	<script>

</body>
</html>
