<template>
    <div class="box box-primary" style="height: 400px;">
        <div class="box-header with-border">
            <h3 class="box-title">{{ title}}</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" :class="{'highlight': filter == 'week'}" @click="updateChart('week')">2 {{trans('admin.Monate')}}</button>
                <button class="btn btn-box-tool" :class="{'highlight': filter == 'month'}" @click="updateChart('month')">{{trans('admin.Jahr')}}</button>
                <span class="form-inline form-group">
                <select v-if="filter == 'month'" v-model="year" @change="updateChart('month')" class="form-control input-sm">
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                </select>
                </span>
            </div>
        </div>
        <div class="box-body">
            <canvas ref="canvas" width="1000" height="400"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        data() {
            return {
                chart: '',
                filter: this.groupBy,
                year: 2019,
                backgroundColor: ['#1976d2', '#4caf50']
            }
        },
        props: ['url', 'title' ,'groupBy'],
        methods: {
            buildGraph() {

                let canvas = this.$refs.canvas.getContext("2d");

                this.chart = new Chart(canvas, {
                    type: 'bar',
                    data: {
                        datasets: [
                            {
                                yAxisID: 'y-axis-0',
                            },
                            {
                                yAxisID: 'y-axis-1',
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [
                                {
                                    position: 'left',
                                    id: 'y-axis-0',
                                    ticks: {
                                        beginAtZero: true
                                    }
                                },
                                {
                                    position: 'right',
                                    id: 'y-axis-1',
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    gridLines: {
                                        drawOnChartArea: false
                                    }
                                }
                            ]
                        }
                    }
                });
            },

            updateChart(groupBy) {

                axios.get(this.url + '?groupBy=' + groupBy + '&year=' + this.year).then((response) => {

                    const data = response.data;

                    this.filter = groupBy;

                    this.chart.data.labels = data.labels;

                    for (let key in data.datasets) {
                        this.chart.data.datasets[key].backgroundColor = this.backgroundColor[key];
                        let lables = data.datasets[key].label;
                        lables = lables.replace(".", "");
                        if(lables == "Betrag in Euro"){
                            this.chart.data.datasets[key].label = "Amount in Euro";
                        }else{
                            this.chart.data.datasets[key].label = trans('admin.'+lables);
                        }
                        console.log(data.datasets[key].values);
                        this.chart.data.datasets[key].data  = trans('admin.'+data.datasets[key].values);
                    };

                    this.chart.update();
                });
            }
        },
        mounted: function () {
            this.buildGraph();

            this.updateChart(this.groupBy);
        }
    }
</script>