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
                sensorData: [],
                loaded: false,
            }
        },
        watch: {
            sensorData () {
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
                            label: 'Sensor values',
                            backgroundColor: "#38b5e6",
                            borderColor: "#38b5e6",
                            order: 10,
                            fill: false,
                            data: this.sensorData,
                        }
                    ]
                }
            },

                getSensorValues(patientId) {
                    axios.get('http://localhost:8000/api/patient/' + patientId + '/data').then(res => {
                       res.data.map(el => {
                           if (this.labels.length > 9) {
                               this.labels.shift();
                               this.sensorData.shift();
                           }
                           this.labels.push(el.created_at);
                           this.sensorData.push(el.min_value_measured);
                       });
                           this.loaded = true;
                    }).catch(e => {
                        alert('An error has occurred');
                    })
                },

                readLiveData() {
                    var self = this;
                    Echo.private('patient.' + this.patientId).listen('StreamingChart', function (e) {
                        e.data.map(el => {
                            if (self.labels.length > 9) {
                                self.labels.shift();
                                self.sensorData.shift();
                            }
                            self.labels.push(el.created_at);
                            self.sensorData.push(el.min_value_measured);
                        });
                        console.log(self.labels);
                        console.log(self.sensorData);
                    })
                }
        },

    }
</script>

<style>

</style>
