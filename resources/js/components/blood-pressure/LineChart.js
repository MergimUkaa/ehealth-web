import { Line, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins;

export default {
    extends: Line,
    mixins: [reactiveProp],
    // props: ['options'],
    data() {
        return {
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Te dhenat e gjeneruara ne kohe reale'
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true
                        },
                    }],
                    yAxes: [{
                        ticks: {
                            min:30,
                            max: 130
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Blood Pressure'
                        },
                        afterTickToLabelConversion : function(q){
                            for(var tick in q.ticks){
                                q.ticks[tick] += ' mmHg';
                            }
                        }
                    }]
                }
            }
        }
    },
    watch: {
        chartData () {
            // this.$data._chart.update()
        }
    },
    mounted () {
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        this.renderChart(this.chartData, this.options)
    }
}
