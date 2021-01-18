<?php
  session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
    $ProjectID = $_SESSION['ProjectID'];
    if ($_SERVER["SERVER_NAME"] =="localhost")
      $ServerName = $_SERVER["SERVER_NAME"] ."/ces";
    else
      $ServerName = $_SERVER["SERVER_NAME"];
   //echo $ServerName;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Firmogram - Treemap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets3/css/bootstrap.css" rel="stylesheet">
    <link href="../assets3/css/bootstrap-glyphicons.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }


      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar2 .navbar-inner {
        padding: 0;
      }
      .navbar2 .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar2 .nav li {
        display: table-cell;
        width: 1%;
        float: none;
      }
      .navbar2 .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar2 .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar2 .nav li:last-child a {
        border-right: 0;
      }
    </style>
    <link href="../assets3/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets3/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets3/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets3/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets3/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets3/ico/favicon.png">

      <script src="../assets3/js/jquery.js"></script>
      <script src="../assets3/js/bootstrap.min.js"/>
      <script type="text/javascript">
          $('.alert .close').live("click", function(e) {
              $(this).parent().hide();
          });
      </script>
    <style>

    #chart {
      width: 820px;
      height: 700px;
      background: #bbb;
      margin: 1px auto;
      position: relative;
      -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
          box-sizing: border-box;
    }

    text {
      pointer-events: none;
    }

    .grandparent text { /* header text */
      font-weight: bold;
      font-size: medium;
      font-family: "Open Sans", Helvetica, Arial, sans-serif; 
    }

    rect {
      fill: none;
      stroke: #fff;
    }

    rect.parent,
    .grandparent rect {
      stroke-width: 2px;
    }

    .grandparent rect {
      fill: #fff;
    }

    .children rect.parent,
    .grandparent rect {
      cursor: pointer;
    }

    rect.parent {
      pointer-events: all; 
    }

    .children:hover rect.child,
    .grandparent:hover rect {
      fill: #aaa;
    }

    .textdiv { /* text in the boxes */
      font-size: small;
      padding: 5px;
      font-family: "Open Sans", Helvetica, Arial, sans-serif; 
    }

  </style>
<!--<script src="http://d3js.org/d3.v2.js"></script>-->
<script src="d3.v3.min.js"></script>
<script src="http://code.jquery.com/jquery-1.7.1.js"></script>

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
          <a href="list.php"><span class="glyphicon glyphicon-th"></span> Data </a>
        </li>
        <li class="active">
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> Map </a>
        </li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<li><a href="concept4.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
            else 
                echo '<li><a href="concept10.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
          ?>
        <li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="analytics2.php"><span class="glyphicon glyphicon-stats"></span> Analytics </a>';
            else 
                echo '<a href="analytics.php"><span class="glyphicon glyphicon-stats"></span> Analytics </a>';
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

    <div style="clear:both"></div>
    <div class="container">
      <br/><br/><br/>
<p id="chart">
<script>
  
  /* 
  * If running inside bl.ocks.org we want to resize the iframe to fit both graphs
  * This bit of code was shared originally at https://gist.github.com/benjchristensen/2657838
  */
   if(parent.document.getElementsByTagName("iframe")[0]) {
       parent.document.getElementsByTagName("iframe")[0].setAttribute('style', 'height: 700px !important');
     }

  var margin = {top: 20, right: 0, bottom: 0, left: 0},
  width = 820,
  height = 700 - margin.top - margin.bottom,
  formatNumber = d3.format(",d"),
  transitioning;

  /* create x and y scales */
  var x = d3.scale.linear()
    .domain([0, width])
    .range([0, width]);

  var y = d3.scale.linear()
    .domain([0, height])
    .range([0, height]);

  var treemap = d3.layout.treemap()
    .children(function(d, depth) { return depth ? null : d.children; })
    .sort(function(a, b) { return a.value - b.value; })
    .ratio(height / width * 0.5 * (1 + Math.sqrt(5)))
    .round(false);

  /* create svg */
  var svg = d3.select("#chart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.bottom + margin.top)
    .style("margin-left", -margin.left + "px")
    .style("margin.right", -margin.right + "px")
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
    .style("shape-rendering", "crispEdges");

  var color = d3.scale.category20c();

  var grandparent = svg.append("g")
    .attr("class", "grandparent");

  grandparent.append("rect")
    .attr("y", -margin.top)
    .attr("width", width)
    .attr("height", margin.top);

  grandparent.append("text")
    .attr("x", 6)
    .attr("y", 6 - margin.top)
    .attr("dy", ".75em");

  /* load in data, display root */
  d3.json("treemapjson.php", function(root) {

    initialize(root);
    accumulate(root);
    layout(root);
    display(root);

    function initialize(root) {
      root.x = root.y = 0;
      root.dx = width;
      root.dy = height;
      root.depth = 0;
    }

    // Aggregate the values for internal nodes. This is normally done by the
    // treemap layout, but not here because of the custom implementation.
    function accumulate(d) {
      return d.children
      ? d.value = d.children.reduce(function(p, v) { return p + accumulate(v); }, 0)
      : d.value;
      }

    // Compute the treemap layout recursively such that each group of siblings
    // uses the same size (1×1) rather than the dimensions of the parent cell.
    // This optimizes the layout for the current zoom state. Note that a wrapper
    // object is created for the parent node for each group of siblings so that
    // the parent’s dimensions are not discarded as we recurse. Since each group
    // of sibling was laid out in 1×1, we must rescale to fit using absolute
    // coordinates. This lets us use a viewport to zoom.
    function layout(d) {
      if (d.children) {
      treemap.nodes({children: d.children});
      d.children.forEach(function(c) {
      c.x = d.x + c.x * d.dx;
      c.y = d.y + c.y * d.dy;
      c.dx *= d.dx;
      c.dy *= d.dy;
      c.parent = d;
      layout(c);
      });
      }
    }

    /* display shows the treemap and writes the embedded transition function */
    function display(d) {
      /* create grandparent bar at top */
      grandparent
        .datum(d.parent)
        .on("click", transition)
        .select("text")
        .text(name(d));

      var g1 = svg.insert("g", ".grandparent")
        .datum(d)
        .attr("class", "depth");

      /* add in data */
      var g = g1.selectAll("g")
        .data(d.children)
        .enter().append("g");
        


      /* transition on child click */
      g.filter(function(d) { return d.children; })
        .classed("children", true)
        .on("click", transition);

      /* write children rectangles */
      g.selectAll(".child")
        .data(function(d) { return d.children || [d]; })
        .enter().append("rect")
           .attr("class", "child")
           .call(rect)
           .append("title")
           .text(function(d) { return d.name + " " + formatNumber(d.size); });
           

      /* write parent rectangle */
      g.append("rect")
        .attr("class", "parent")
        .call(rect)
        /* open new window based on the json's URL value for leaf nodes */
        /* Chrome displays this on top */
        .on("click", function(d) { 
          if(!d.children){
            window.open(d.url,'_self'); 
          }
        })
        .append("title")
        .text(function(d) { return d.name + " " + formatNumber(d.size); }); /*should be d.value*/
        

      /* Adding a foreign object instead of a text object, allows for text wrapping */
      g.append("foreignObject")
        .call(rect)
        /* open new window based on the json's URL value for leaf nodes */
        /* Firefox displays this on top */
        .on("click", function(d) { 
          if(!d.children){
            window.open(d.url,'_self'); 
        }
      })
        .attr("class","foreignobj")
        .append("xhtml:div") 
        .attr("dy", ".75em")
        .html(function(d) { return d.name; 
        })
        .attr("class","textdiv"); //textdiv class allows us to style the text easily with CSS

      /* create transition function for transitions */
      function transition(d) {
        if (transitioning || !d) return;
        transitioning = true;

        var g2 = display(d),
        t1 = g1.transition().duration(750),
        t2 = g2.transition().duration(750);

        // Update the domain only after entering new elements.
        x.domain([d.x, d.x + d.dx]);
        y.domain([d.y, d.y + d.dy]);

        // Enable anti-aliasing during the transition.
        svg.style("shape-rendering", null);

        // Draw child nodes on top of parent nodes.
        svg.selectAll(".depth").sort(function(a, b) { return a.depth - b.depth; });

        // Fade-in entering text.
        g2.selectAll("text").style("fill-opacity", 0);
        g2.selectAll("foreignObject div").style("display", "none"); /*added*/

        // Transition to the new view.
        t1.selectAll("text").call(text).style("fill-opacity", 0);
        t2.selectAll("text").call(text).style("fill-opacity", 1);
        t1.selectAll("rect").call(rect);
        t2.selectAll("rect").call(rect);

        t1.selectAll(".textdiv").style("display", "none"); /* added */
        t1.selectAll(".foreignobj").call(foreign); /* added */
        t2.selectAll(".textdiv").style("display", "block"); /* added */
        t2.selectAll(".foreignobj").call(foreign); /* added */ 

        // Remove the old node when the transition is finished.
        t1.remove().each("end", function() {
        svg.style("shape-rendering", "crispEdges");
        transitioning = false;
        });

      }//endfunc transition

      return g;
    }//endfunc display

    function text(text) {
      text.attr("x", function(d) { return x(d.x) + 6; })
      .attr("y", function(d) { return y(d.y) + 6; });
    }



    function rect(rect) {
      rect.attr("x", function(d) { return x(d.x); })
      .attr("y", function(d) { return y(d.y); })
      .attr("width", function(d) { return x(d.x + d.dx) - x(d.x); })
      .attr("height", function(d) { return y(d.y + d.dy) - y(d.y); })
      .style("background", function(d) { return d.parent ? color(d.name) : null; });
    }

    function foreign(foreign){ /* added */
      foreign.attr("x", function(d) { return x(d.x); })
      .attr("y", function(d) { return y(d.y); })
      .attr("width", function(d) { return x(d.x + d.dx) - x(d.x); })
      .attr("height", function(d) { return y(d.y + d.dy) - y(d.y); });
    }

    function name(d) {
      return d.parent
      ? name(d.parent) + "." + d.name
      : d.name;
      }
    });

</script>

    </div> <!-- /container -->
  </body>
</html>
