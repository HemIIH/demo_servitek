<template>
    <canvas></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        data: function () {
            return {
                chart: ''
            }
        },
        props: ['title', 'url'],
        methods: {
            buildGraph () {

                axios.get(this.url).then((response) => {

                    let canvas = this.$el.getContext('2d');

                    const data = response.data;
                    console.log(data);
                    this.chart = new Chart(canvas, {
                        type: 'pie',
                        data : {
                            labels: Object.keys(data),
                            datasets: [{
                                data: Object.keys(data).map(key => data[key]),
                                backgroundColor: [
                                    '#1976d2',
                                    '#4caf50'
                                ]
                            }]
                        },
                        options: {
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                                display: true,
                                text: this.title
                            }
                        }
                    })

                });
                console.log(this.title);
            }
        },

        mounted() {
            this.buildGraph();
        }
    }
</script>