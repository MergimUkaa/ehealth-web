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
                            min:40,
                            max: 140
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Pulse'
                        },
                        afterTickToLabelConversion : function(q){
                            for(var tick in q.ticks){
                                q.ticks[tick] += ' rrahje';
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
