function datachart(){
    var ctx = document.getElementById("graph1").getContext('2d');
    var data = {
        labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre","Décembre"],
        datasets: [{
                label: 'Nb client',
                data: [698, 876, 387, 903, 508, 398, 457, 263, 1246, 2167, 3098, 2098],
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
        };

    var options = {

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
                text: 'Nombre de clients',
                fontSize: 20
            },
            legend: {
                display: false,
            }
        }
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
    });
}