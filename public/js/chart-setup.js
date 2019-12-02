document.addEventListener("DOMContentLoaded", function(){
    if(document.getElementById("canvas")) {
        let randomScalingFactor = function() {
            return 20;
        };

        let config = {
            type: 'line',
            data: {
                labels: ['Monday', 'Tuesday', 'March', 'April', 'May', 'June', 'July'],
                datasets: [ {
                    label: 'Pulse',
                    backgroundColor: "#38b5e6",
                    borderColor: "#38b5e6",
                    order: 10,
                    fill: false,
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor()
                    ],
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Te dhenat e gjeneruara ne kohe reale'
                },
                scales: {
                    xAxes: [{
                        display: true,
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            min:10,
                            max: 200
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Temperature'
                        },
                        afterTickToLabelConversion : function(q){
                            for(var tick in q.ticks){
                                q.ticks[tick] += '\u00B0C';
                            }
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };

        document.getElementById('randomizeData').addEventListener('click', function() {
            config.data.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return randomScalingFactor();
                });

            });

            window.myLine.update();
        });
    }
})
