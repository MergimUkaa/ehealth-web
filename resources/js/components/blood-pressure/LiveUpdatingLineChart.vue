<template>
    <div class="small">
        <line-chart v-if="loaded" :chart-data="datacollection"  :height="200"></line-chart>
    </div>
</template>

<script>
    import LineChart from './LineChart.js'

    export default {
        components: {
            LineChart
        },
        data() {
            return {
                datacollection: {},
                labels: [],
                sensorDataMin: [],
                sensorDataMax: [],
                patientId: null,
                loaded: false,
            }
        },
        watch: {
            sensorDataMin () {
               this.fillData();
            },
        },
        mounted() {
            this.patientId = window.location.pathname.split('/')[2];
            this.fillData();
            this.getSensorValues(this.patientId);
            this.readLiveData();
        },
        methods: {
            fillData() {
                this.datacollection = {
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Blood Pressure Min',
                            backgroundColor: "#38b5e6",
                            borderColor: "#38b5e6",
                            order: 10,
                            fill: false,
                            data: this.sensorDataMin,
                        },
                        {
                            label: 'Blood Pressure Max',
                            backgroundColor: "#ff6600",
                            borderColor: "#ff6600",
                            order: 10,
                            fill: false,
                            data: this.sensorDataMax,
                        }
                    ]
                }
            },

                getSensorValues(patientId) {
                    axios.get('http://localhost:8000/api/patient/' + patientId + '/data').then(res => {
                       res.data.map(el => {
                           if (this.labels.length > 9) {
                               this.labels.shift();
                               this.sensorDataMin.shift();
                               this.sensorDataMax.shift();
                           }
                           this.labels.push(el.created_at);
                           this.sensorDataMin.push(el.min_value_measured);
                           this.sensorDataMax.push(el.max_value_measured);
                       });
                           this.loaded = true;
                    }).catch(e => {
                        alert('An error has occurred');
                    });
                },
                readLiveData() {
                    var self = this;
                    Echo.private('patient.' + this.patientId ).listen('StreamingChart', function (e) {
                        e.data.map(el => {
                            if (self.labels.length > 9) {
                                self.labels.shift();
                                self.sensorDataMin.shift();
                                self.sensorDataMax.shift();
                            }
                            self.labels.push(el.created_at);
                            self.sensorDataMin.push(el.min_value_measured);
                            self.sensorDataMax.push(el.max_value_measured);
                        });
                    })
                }
        },

    }
</script>

<style>

</style>
