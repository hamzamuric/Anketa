const Chart = require('chart.js');

function p0() {
    var data = {
        labels: ["match1", "match2", "match3", "match4", "match5"],
        datasets: [{
                label: "TeamA Score",
                data: [10, 50, 25, 70, 40],
                backgroundColor: [
                    "rgba(10,20,30,0.3)",
                    "rgba(10,20,30,0.3)",
                    "rgba(10,20,30,0.3)",
                    "rgba(10,20,30,0.3)",
                    "rgba(10,20,30,0.3)"
                ],
                borderColor: [
                    "rgba(10,20,30,1)",
                    "rgba(10,20,30,1)",
                    "rgba(10,20,30,1)",
                    "rgba(10,20,30,1)",
                    "rgba(10,20,30,1)"
                ],
                borderWidth: 1
            }, {
                label: "TeamB Score",
                data: [20, 35, 40, 60, 50],
                backgroundColor: [
                    "rgba(50,150,200,0.3)",
                    "rgba(50,150,200,0.3)",
                    "rgba(50,150,200,0.3)",
                    "rgba(50,150,200,0.3)",
                    "rgba(50,150,200,0.3)"
                ],
                borderColor: [
                    "rgba(50,150,200,1)",
                    "rgba(50,150,200,1)",
                    "rgba(50,150,200,1)",
                    "rgba(50,150,200,1)",
                    "rgba(50,150,200,1)"
                ],
                borderWidth: 1
            }
        ]
    };

    var options = {
        responsive: true,
        title: {
            display: true,
            position: "top",
            text: "Bar Graph",
            fontSize: 18,
            fontColor: "#111"
        },
        legend: {
            display: true,
            position: "bottom",
            labels: {
                fontColor: "#333",
                fontSize: 16
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0
                }
            }]
        }
    };
    let ctx = document.getElementById('p0').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Da', 'Ne'],
            datasets: [{
                label: 'Broj odgovora',
                data: [12, 8]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

window.onload(() => p0());