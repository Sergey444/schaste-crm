'use strict';

(function () {

    var programs = {
        'Логопед': '#3366cc',
        'Мини-сад': '#dc3912',
        'Подготовка к школе': '#ff9900',
        'Птенчики': '#109618',
        'Счастье в ладошках': '#990099',
        'Умничка': '#0099c6',
        'Разовое занятие': '#ff9900',
        'Новогодний утренник': '#dc3912',
        'Абонемент': '#3366cc'
    }

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
        var options = {'title':'Количество проданных типов'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_pie'));
            chart.draw(data, options);
    }

    /**
     * Draws 3d pie chart
     * @see https://developers.google.com/chart/interactive/docs/gallery/piechart#making-a-3d-pie-chart
     */
    var drawPieChart3d = function(response) {
        var response= response.slice()
            response.unshift(['', '']);

        var data = google.visualization.arrayToDataTable(response);

        var options = {
            title: 'Отчёт по программам',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }

    /**
     * Draws basic column chart with multiple series
     * @see https://developers.google.com/chart/interactive/docs/gallery/columnchart#examples
     * 
     * @param {array} response
     * @param {string} nodeId
     */
    var drawBasic = function(response, nodeId = 'chart_div') {
        var response = response.slice()
            response = response.map(function (item) {
                item.push(programs[item[0]]);
                return item;
            });
            response.unshift(['', '', {role: 'style'}]);

        var data = google.visualization.arrayToDataTable(response);
        var view = new google.visualization.DataView(data);

        var options = {
            title: 'Сумма стоимости занятий',
            hAxis: {
                title: '',
                viewWindow: {
                    min: [7, 30, 0],
                    max: [17, 30, 0]
                }
            },
            vAxis: {
                title: '',
                viewWindow: {
                    max: 'auto'
                }
            }
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById(nodeId));

        chart.draw(view, options);
    }

    /**
     * Draws area chart
     * @see https://developers.google.com/chart/interactive/docs/gallery/areachart
     */
    var drawAreaChart = function(response) {

        var response = response.slice()
        var obj = {};
        var result = [['Дата', '']];
            response.forEach(function (item) {
                if (!obj[item[0]]) {
                    obj[item[0]] = 0;
                }
                obj[item[0]] += item[2];
            });
            for (var key in obj) {
                result.push([key, obj[key]]);
            }

        var data = google.visualization.arrayToDataTable(result);

        var options = {
            title: 'График оплат',
            hAxis: {title: 'Время', titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_area'));
        chart.draw(data, options);
    }

    /**
     * Draws area chart
     * @see https://developers.google.com/chart/interactive/docs/gallery/areachart
     */
    var drawCustomerAreaChart = function(response, chart) {
        var data = new google.visualization.DataTable();
            data.addColumn('string', 'Месяц');
            data.addColumn('number', '');
            data.addRows(response);

        var options = {
            title: 'График поступления новых клиентов',
            hAxis: {title: 'Время', titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };
        
        var chart = new google.visualization.AreaChart(document.getElementById('chart_area_customer'));
            chart.draw(data, options);
    }

    /**
     * Draws Visualization: Combo Chart
     * @see https://developers.google.com/chart/interactive/docs/gallery/combochart#example
     */
    var drawVisualization = function(response) {
        // Some raw data (not necessarily accurate)
        var obj = {};
        var topArr = [];
        response.forEach(function (item) {
            if (topArr.indexOf( item[1] ) === -1) {
                topArr.push(item[1]);
            }
            if (!obj[item[0]]) {
                obj[item[0]] = {};
            }
            obj[item[0]][item[1]] = item[2];
        });

        topArr = topArr.sort();
        
        var result = [];
        for (var index in obj) {
            var newArr = [index];
            topArr.forEach(function (item) {
                if (obj[index][item]) {
                    newArr.push(obj[index][item]);
                } else {
                    newArr.push(null);
                }
            });
            result.push(newArr);
        }

        var data = new google.visualization.DataTable();
            data.addColumn('string', 'Месяц');

            topArr.forEach(function (item) {
                data.addColumn('number', item);
            });

            data.addRows(result);

        var options = {
            title : 'Доходы с занятий по месяцам',
            vAxis: {
                gridlines: {
                    count: 20,
                }
            },
            hAxis: {title: 'Месяц'},
            seriesType: 'bars',
            // series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_visual'));
        chart.draw(data, options);
    }



    
    var showOrder = function(action) {
        var start = +new Date($('[name="date_start"]').val()) / 1000;
        var finish = +new Date($('[name="date_end"]').val()) / 1000;

        if (action === 'customer') {
            $.ajax({
                type: "GET",
                url: "https://127.0.0.1:5000/api/v1/customers",
                data: {'start': start, 'finish': finish},
                success: function(response) {
                    // console.log(response);
                    $('#customer-panel').slideDown('slow');

                    var test = drawCustomerAreaChart(response);

                    console.log(test);
                }
            });
        }

        if (action === 'order') {
            // Set a callback to run when the Google Visualization API is loaded.
            $.ajax({
                type: "GET",
                url: "https://127.0.0.1:5000/api/v1/orders",
                data: {'start': start, 'finish': finish},
                success: function(response){
                    console.log('response', response);
                    $('#order-panel').slideDown('slow');
                    // google.charts.setOnLoadCallback(function () { 
                        drawChart(response.corders);
                        drawPieChart3d(response.cprograms);

                        drawBasic(response.programs);
                        drawBasic(response.orders, 'chart_div_order');

                        drawVisualization(response.payments);
                        drawAreaChart(response.payments);
                    // });
                }
            });
        }


    }


    document.addEventListener('DOMContentLoaded', function() {
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart', 'bar']});
        google.charts.setOnLoadCallback(function () { 

            $('[name="type-order"]').on('change', function (evt) {
                $('#order-panel').slideUp(100);
                $('#customer-panel').slideUp(100);
                showOrder($(this).val());
            });

            $('#filter-form').on('submit', function (evt) {
                evt.preventDefault();
                var action = $('[name="type-order"]').val();
                showOrder(action);
            });
        });
    });

})();

