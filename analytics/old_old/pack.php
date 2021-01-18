<?php
  session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
    if ($_SESSION['ProjectType'] !=='3') 
      header("Location: view.php");
    $ProjectID = $_SESSION['ProjectID'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link type="text/css" rel="stylesheet" href="pack.css"/>
    <!-- Le styles -->
    <link href="../assets3/css/bootstrap.css" rel="stylesheet">
    <link href="../assets3/css/bootstrap-glyphicons.css" rel="stylesheet">
    <style type="text/css">

text {
  font-size: 11px;
  pointer-events: none;
}

text.parent {
  fill: #1f77b4;
}

circle {
  fill: #ccc;
  stroke: #999;
  pointer-events: all;
}

circle.parent {
  fill: #1f77b4;
  fill-opacity: .1;
  stroke: steelblue;
}

circle.parent:hover {
  stroke: #ff7f0e;
  stroke-width: .5px;
}

circle.child {
  pointer-events: none;
}

    </style>
  </head>
  <body>
  <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php 
           if ($_SESSION["ReadOnly"]=="NO")  {
            ?>
          <a class="navbar-brand" href="projects.php"><span class="glyphicon glyphicon-list"></span> Projects</a>
          <?php 
           }
            ?>
        </div>

    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <?php 
           if ($_SESSION["ReadOnly"]=="NO") 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="import.php"><span class="glyphicon glyphicon-import"></span> Build</a>';
            else 
                echo '<a href="build.php"><span class="glyphicon glyphicon-check"></span> Build</a>';
          ?>
        </li>
        <li>
          <a href="list.php"><span class="glyphicon glyphicon-th"></span> Data</a>
        </li>
        <li>
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> Map </a>
        </li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<li class="active"><a href="concept4.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
            else if ($_SESSION['ProjectType'] =='3') 
                echo '<li class="active"><a href="concept24.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
            else 
                echo '<li class="active"><a href="concept10.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
          ?>
        <li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="analytics2.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>';
            else 
                echo '<a href="analytics.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>';
          ?>
        </li>
        <li><a href="export.php"><span class="glyphicon glyphicon-export"></span> Export </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php 
          if ($_SESSION['ViewerCount'] >0) 
            echo '<li><a href="viewers.php"><span class="glyphicon glyphicon-user"></span> Viewers</a></li>';
        ?>
        <li>
          <a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a>
        </li>
      </ul>
    </nav>
    </div><!-- /.container -->
    </div><!-- /.navbar -->
    <br/><br/><br/>
      
    <h2>
      Surrey Sample Database<br/>
      Manufacturing<br/>      
      <a href="concept24.php" role="button" class="btn btn-primary" style="color:white">Eco-system</a>     
    </h2>
    <script type="text/javascript" src="js/d3.js"></script>
    <script type="text/javascript" src="js/d3.layout.js"></script>
    <script type="text/javascript">

var w = 1280,
    h = 800,
    r = 620,
    x = d3.scale.linear().range([0, r]),
    y = d3.scale.linear().range([0, r]),
    node,
    root;

var pack = d3.layout.pack()
    .size([r, r])
    .value(function(d) { return d.size; })

var vis = d3.select("body").insert("svg:svg", "h2")
    .attr("width", w)
    .attr("height", h)
  .append("svg:g")
    .attr("transform", "translate(" + (w - r) / 2 + "," + (h+200 - r) / 2 +  ")");

d3.json("packjson.php", function(data) {
  node = root = data;

  var nodes = pack.nodes(root);

  vis.selectAll("circle")
      .data(nodes)
    .enter().append("svg:circle")
      .attr("class", function(d) { return d.children ? "parent" : "child"; })
      .attr("cx", function(d) { return d.x; })
      .attr("cy", function(d) { return d.y; })
      .attr("r", function(d) { return d.r; })
      .on("click", function(d) { return zoom(node == d ? root : d); });

  vis.selectAll("text")
      .data(nodes)
    .enter().append("svg:text")
      .attr("class", function(d) { return d.children ? "parent" : "child"; })
      .attr("x", function(d) { return d.x; })
      .attr("y", function(d) { return d.y+Math.random()*50; })
      .attr("dy", ".35em")
      .attr("text-anchor", "middle")
      .style("opacity", function(d) { return d.r > 20 ? 1 : 0; })
      .text(function(d) { return d.name; });

  d3.select(window).on("click", function() { zoom(root); });
});

function zoom(d, i) {
  var k = r / d.r / 2;
  x.domain([d.x - d.r, d.x + d.r]);
  y.domain([d.y - d.r, d.y + d.r]);

  var t = vis.transition()
      .duration(d3.event.altKey ? 7500 : 750);

  t.selectAll("circle")
      .attr("cx", function(d) { return x(d.x); })
      .attr("cy", function(d) { return y(d.y); })
      .attr("r", function(d) { return k * d.r; });

  t.selectAll("text")
      .attr("x", function(d) { return x(d.x); })
      .attr("y", function(d) { return y(d.y); })
      .style("opacity", function(d) { return k * d.r > 20 ? 1 : 0; });

  node = d;
  d3.event.stopPropagation();
}

    </script>
  </body>
</html>
