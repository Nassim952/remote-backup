function datachart(){
    var labelsYear = [];
    var datasYear = [];

    totalReservationArray.years.forEach(function(yearArray) { 
        labelsYear.push(yearArray.year);
        datasYear.push(yearArray.total);
    });

    var labelsMonth = [];
    var datasMonth = [];

    var months = [
        'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai',
        'Juin', 'Juillet', 'Aout', 'Septembre',
        'Octobre', 'Novembre', 'Decembre'
        ];

    var d = new Date();
    var n = d.getFullYear();

    totalReservationArray.month.forEach(function(monthArray) { 
        if(monthArray.year == n) {
            var mois = monthArray.month - 1
            labelsMonth.push(months[mois]);
            datasMonth.push(monthArray.total);
        }
    });

    dataMap = {
        'annee': {
            labels: labelsYear,
            datasets: [{
                label: 'Nb ticket vendus',
                data: datasYear,
                backgroundColor: [
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)'
                ],
                borderColor: [
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)'
                ],
                borderWidth: 1
            }]
        },
        'mois': {
            labels: labelsMonth,
            datasets: [{
                label: 'Nb tickets vendus',
                data: datasMonth,
                backgroundColor: [
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)',
                    'rgba(239, 53, 53, 0.37)'
                ],
                borderColor: [
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)',
                    'rgba(239, 53, 53, 1)'
                ],
                borderWidth: 1
            }]
        }
    };

    options = {

            scales: {
                yAxes: [{
                    ticks: { // utile pour que les valeurs min et max ne soient pas celles du dataset
                        beginAtZero:true, 
                        suggestedMax: 15
                    }
                }]
            },
            layout: {
                padding: {
                    left: 50,
                    right: 0,
                    top: 20,
                    bottom: 20
                }
            },
            title: {
                display: true,
                text: 'Nombre de ticket vendus',
                fontSize: 20
            },
            legend: {
                display: false,
            }
        }

        var params = dataMap['annee']

        currentChart = new Chart(ctx, {
            type: 'bar',
            data: params,
            options: options
        });

        
        $('#chartType').on('change', updateChart)
}

function updateChart() {
    if(typeof currentChart !== 'undefined'){currentChart.destroy();}

    var determineChart = $("#chartType").val();

    var params = dataMap[determineChart]

    currentChart = new Chart(ctx, {
        type: 'bar',
        data: params,
        options: options
    });
}
