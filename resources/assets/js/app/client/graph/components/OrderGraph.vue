<template>
    <div class="box box-primary" style="height: 400px;">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.Aufträge')}}</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" :class="{'highlight': filter == 'week'}" @click="updateChart('week')">{{trans('admin.Woche')}}</button>
                <button class="btn btn-box-tool" :class="{'highlight': filter == 'month'}" @click="updateChart('month')">{{trans('admin.Monat')}}</button>
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
                filter: this.groupBy
            }
        },
        props: ['groupBy'],
        methods: {
            buildGraph() {

                let canvas = this.$refs.canvas.getContext("2d");

                this.chart = new Chart(canvas, {
                    type: 'bar',
                    data: {
                        datasets: [
                            {
                                label: trans('admin.Zahl der Aufträge'),
                                backgroundColor: '#1976d2',
                                yAxisID: 'y-axis-0',
                            },
                            {
                                label: trans('admin.Gesamtzeit (Std)'),
                                backgroundColor: '#4caf50',
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

                axios.get('/api/c/report/chart/orders?groupBy=' + groupBy).then((response) => {

                    const data = response.data;

                    this.filter = groupBy;

                    this.chart.data.labels = data.labels;
                    this.chart.data.datasets[0].data = data.orders;
                    this.chart.data.datasets[1].data = data.total_time;

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