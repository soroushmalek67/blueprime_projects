var project_id = document.getElementById("helper").getAttribute("project-id");
var capabilitiesCount = [];
var capabilitiesCountStyle = [];
var provincesCount = [];
var provincesCountStyle = [];
var provincesRevenueStyle = [];
var provincesEmployeesStyle = [];
var naicsCount = [];
var naicsCountStyle = [];
var towncentersCount = [];
var towncentersCountStyle = [];


  // Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(startAnalytics);



function startAnalytics()
{
  $.get( URL+"/api/projects/"+project_id+"/analytics", function( response ) {

      capabilitiesCount.push(['Capability' ,'# Companies']);
      capabilitiesCountStyle.push(['Capability' ,'# Companies',{ role: 'style' }]);

      for (var x in response.capabilitiesCount)
      {
          var color = '#'+Math.floor(Math.random()*16777215).toString(16);

          capabilitiesCount.push( [response.capabilitiesCount[x].title, 
                                  Number(response.capabilitiesCount[x].count)] );

          capabilitiesCountStyle.push( [response.capabilitiesCount[x].title, 
                                     Number(response.capabilitiesCount[x].count),
                                      color] );
      }


      
      provincesCount.push(['Province' ,'# Companies']);
      provincesCountStyle.push(['Province' ,'# Companies',{ role: 'style' }]);
      provincesRevenueStyle.push(['Province' ,'Total Revenue',{ role: 'style' }]);
      provincesEmployeesStyle.push(['Province' ,'# Employees',{ role: 'style' }]);
      for (var x in response.provincesStat)
      {
          var color = '#'+Math.floor(Math.random()*16777215).toString(16);

          provincesCount.push( [response.provincesStat[x].province, 
                                Number(response.provincesStat[x].count)]);

          provincesCountStyle.push( [response.provincesStat[x].province, 
                                     Number(response.provincesStat[x].count),
                                      color] );

          provincesRevenueStyle.push( [response.provincesStat[x].province, 
                                     Number(response.provincesStat[x].revenue),
                                      color] );

          provincesEmployeesStyle.push( [response.provincesStat[x].province, 
                                     Number(response.provincesStat[x].employees),
                                      color] );
      }
                  

      naicsCount.push(['NAICS' ,'# Companies']);
      naicsCountStyle.push(['NAICS' ,'# Companies',{ role: 'style' }]);

      for (var x in response.naicsCount)
      {
          var color = '#'+Math.floor(Math.random()*16777215).toString(16);

          naicsCount.push( [response.naicsCount[x].description, 
                            Number(response.naicsCount[x].count)] );

          naicsCountStyle.push( [response.naicsCount[x].description, 
                                 Number(response.naicsCount[x].count),
                                  color] );        
      }


      towncentersCount.push(['TownCenter' ,'# Companies']);
      towncentersCountStyle.push(['TownCenter' ,'# Companies',{ role: 'style' }]);

      for (var x in response.towncentersCount)
      {
          var color = '#'+Math.floor(Math.random()*16777215).toString(16);

          towncentersCount.push( [response.towncentersCount[x].town_center, 
                            Number(response.towncentersCount[x].count)] );

          towncentersCountStyle.push( [response.towncentersCount[x].town_center, 
                                 Number(response.towncentersCount[x].count),
                                  color] );        
      }



      drawChart();
  });
}


// Callback that creates and populates a data table, 
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {


var data4 = google.visualization.arrayToDataTable(capabilitiesCount);

  var options4 = {
    title: '# Companies By Capability',
    is3D: true,
    width:900,
    height:450,
  };
  var chart4 = new google.visualization.PieChart(document.getElementById('chart_div4'));
  chart4.draw(data4, options4);

var data6 = google.visualization.arrayToDataTable(provincesCount);

  var options6 = {
    title: '# Companies By Province',
    is3D: true,
    width:900,
    height:900,
  };
  var chart6 = new google.visualization.PieChart(document.getElementById('chart_div6'));
  chart6.draw(data6, options6);

var data7 = google.visualization.arrayToDataTable(provincesCountStyle);

  var options7 = {
    title: '# Companies By Province',
    width:1000,
    height:300,
    legend:{position: 'none'},
  };
  var chart7 = new google.visualization.ColumnChart(document.getElementById('chart_div7'));
  chart7.draw(data7, options7);

var data9 = google.visualization.arrayToDataTable(provincesRevenueStyle);

  var options9 = {
    title: 'Total Revenue By Province',
    width:1000,
    height:300,
    legend:{position: 'none'},
  };
  var chart9 = new google.visualization.ColumnChart(document.getElementById('chart_div9'));
  chart9.draw(data9, options9); 


var data10 = google.visualization.arrayToDataTable(provincesEmployeesStyle);

  var options10 = {
    title: 'Total Employees By Province',
    width:1000,
    height:300,
    legend:{position: 'none'},
  };
  var chart10 = new google.visualization.ColumnChart(document.getElementById('chart_div10'));
  chart10.draw(data10, options10); 



  var data11 = google.visualization.arrayToDataTable(capabilitiesCountStyle);
  var view11 = new google.visualization.DataView(data11);
  view11.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

    var options11 = {
      title: '# Companies By Capability',
      width:1000,
      height:300,
      hAxis: {slantedText:true, slantedTextAngle:45 ,textStyle: { fontSize: '12', paddingRight: '0', marginRight: '0', marginTop: '0'} },
      chartArea: {height:"30%"},
      legend:{position: 'none'},
    };
    var chart11 = new google.visualization.ColumnChart(document.getElementById('chart_div11'));
    chart11.draw(view11, options11);


  var data8 = google.visualization.arrayToDataTable(naicsCount);
  var options8 = {
    title: '# Companies By Sector',
    is3D: true,
    width:900,
    height:900,
  };
  var chart8 = new google.visualization.PieChart(document.getElementById('chart_div8'));
  chart8.draw(data8, options8);



  var data12 = google.visualization.arrayToDataTable(naicsCountStyle);
  var view12 = new google.visualization.DataView(data12);
  view12.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

    var options12 = {
      title: '# Companies By Sector',
      width:1000,
      height:300,
      chartArea: {height:"30%"},
      legend:{position: 'none'},
    };
    var chart12 = new google.visualization.ColumnChart(document.getElementById('chart_div12'));
    chart12.draw(view12, options12);



  var data13 = google.visualization.arrayToDataTable(towncentersCount);
  var options13 = {
    title: '# Companies By Local Area',
    is3D: true,
    width:900,
    height:900,
  };
  var chart13 = new google.visualization.PieChart(document.getElementById('chart_div13'));
  chart13.draw(data13, options13);



  var data14 = google.visualization.arrayToDataTable(towncentersCountStyle);
  var view14 = new google.visualization.DataView(data14);
  view14.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

    var options14 = {
      title: '# Companies By Local Area',
      width:1000,
      height:300,
      chartArea: {height:"30%"},
      legend:{position: 'none'},
    };
    var chart14 = new google.visualization.ColumnChart(document.getElementById('chart_div14'));
    chart14.draw(view14, options14);


}

