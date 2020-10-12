'use strict';

(function () {

    /**
     * Draws pie chart
     * @see https://developers.google.com/chart/interactive/docs/gallery/piechart
     */
    var drawChart = function(response) {
        // Create the data table.
        var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows(response);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_pie'));
            chart.draw(data, options);
    }

    /**
     * Draws 3d pie chart
     * @see https://developers.google.com/chart/interactive/docs/gallery/piechart#making-a-3d-pie-chart
     */
    var drawPieChart3d = function(response) {

        response.unshift(['Task', 'Hours per Day']);
        var data = google.visualization.arrayToDataTable(
            // ['Task', 'Hours per Day'],
            // ['Work',     11],
            // ['Eat',      2],
            // ['Commute',  2],
            // ['Watch TV', 2],
            // ['Sleep',    7]
            response
        );

        var options = {
            title: 'My Daily Activities',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }

    /**
     * Draws basic column chart with multiple series
     * @see https://developers.google.com/chart/interactive/docs/gallery/columnchart#examples
     */
    var drawBasic = function() {

        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time of Day');
        data.addColumn('number', 'Motivation Level');

        data.addRows([
            [{v: [8, 0, 0], f: '8 am'}, 1],
            [{v: [9, 0, 0], f: '9 am'}, 2],
            [{v: [10, 0, 0], f:'10 am'}, 3],
            [{v: [11, 0, 0], f: '11 am'}, 4],
            [{v: [12, 0, 0], f: '12 pm'}, 5],
            [{v: [13, 0, 0], f: '1 pm'}, 6],
            [{v: [14, 0, 0], f: '2 pm'}, 7],
            [{v: [15, 0, 0], f: '3 pm'}, 8],
            [{v: [16, 0, 0], f: '4 pm'}, 9],
            [{v: [17, 0, 0], f: '5 pm'}, 10],
        ]);

        var options = {
            title: 'Motivation Level Throughout the Day',
            hAxis: {
            title: 'Time of Day',
            format: 'h:mm a',
            viewWindow: {
                min: [7, 30, 0],
                max: [17, 30, 0]
            }
            },
            vAxis: {
            title: 'Rating (scale of 1-10)'
            }
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div'));

        chart.draw(data, options);
    }

    /**
     * Draws area chart
     * @see https://developers.google.com/chart/interactive/docs/gallery/areachart
     */
    var drawAreaChart = function() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2013',  1000,      400],
            ['2014',  1170,      460],
            ['2015',  660,       1120],
            ['2016',  1030,      540]
        ]);

        var options = {
        title: 'Company Performance',
        hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_area'));
        chart.draw(data, options);
    }

    /**
     * Draws Visualization: Combo Chart
     * @see https://developers.google.com/chart/interactive/docs/gallery/combochart#example
     */
    var drawVisualization = function() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
            ['2004/05',  165,      938,         522,             998,           450,      614.6],
            ['2005/06',  135,      1120,        599,             1268,          288,      682],
            ['2006/07',  157,      1167,        587,             807,           397,      623],
            ['2007/08',  139,      1110,        615,             968,           215,      609.4],
            ['2008/09',  136,      691,         629,             1026,          366,      569.6]
        ]);

        var options = {
        title : 'Monthly Coffee Production by Country',
        vAxis: {title: 'Cups'},
        hAxis: {title: 'Month'},
        seriesType: 'bars',
        series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_visual'));
        chart.draw(data, options);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart', 'bar']});

        // Set a callback to run when the Google Visualization API is loaded.
        // google.charts.setOnLoadCallback(drawChart);
        // google.charts.setOnLoadCallback(drawBasic);
        // google.charts.setOnLoadCallback(drawAreaChart);
        // google.charts.setOnLoadCallback(drawPieChart3d);
        // google.charts.setOnLoadCallback(drawVisualization);

        $.ajax({
            url: "https://127.0.0.1:5000/api/v1/orders",
            success: function(response){
                google.charts.setOnLoadCallback(function () { 
                    drawChart(response);
                    drawPieChart3d(response);
                });
            }
        });
    });

})();

