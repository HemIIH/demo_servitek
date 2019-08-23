<template>
    <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{trans('admin.Kalender')}}
                        <div class="pull-right">
                            <ul class="pager list-unstyled">
                                <li>
                                    <a href="#" @click="sub('months')" class="pointer">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <li>
                                    {{ trans('employee.'+moment(start).locale('de').format('MMMM')) }}
                                </li>
                                <li>
                                    <a href="#" @click="add('months')" class="pointer">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </h4>
                </div>
                <div class="panel-body">
                    <table v-for="(week, startOfWeek) in weeks" class="table table-fixed margin-b-0" id="order-calendar">
                        <tbody>
                        <tr class="bg-black-light">
                            <td style="width:40px;"></td>
                            <td v-for="(weekday, date) in week" class="padding-5">
                                {{ trans('employee.'+weekday) }}
                                <!--<a href="#" @click.prevent="newTimeOff(date)" class="pull-right small">-->
                                    <!--<i class="fa fa-plus"></i>-->
                                <!--</a>-->
                            </td>
                        </tr>
                        <tr>
                            <td height="90px" style="width:40px;vertical-align: middle;">
                                {{trans('admin.KW')}} <br>{{ moment(startOfWeek).isoWeek() }}
                            </td>
                            <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">
                                <div class="text-muted small text-right">{{ moment(date).format('Do') }}</div>

                                <div v-for="timeoff in timeoffs[date]" class="text-center small margin-b-10 pointer" style="width: 100%;" :class="highlightTimeOff(timeoff.type)">
                                    {{ timeoff.type }}
                                </div>

                                <order v-for="order in orders[date]" :order="order" :key="order.id"></order>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
</template>

<script>
    import Calendar from '../../../mixins/Calendar';
    import Order from '../components/Order.vue';

    export default {
        data() {
            return {
                weeks: [],
                orders: [],
                timeoffs: [],
                start: moment().format()
            }
        },
        components: [Order],
        mixins: [Calendar],

        methods: {
            getOrders() {
                let data = {
                    start: this.start
                };

                axios.post('/api/e/orders/by/month', data).then((response) => {
                    this.orders   = response.data.orders
                    this.timeoffs = response.data.timeoffs
                    this.weeks    = response.data.weeks
                });
            },

            getTimeOffs() {
                axios.get('/api/e/calendar/timeoffs').then((response) => {
                    this.timeoffs = response.data
                });
            },

            newTimeOff(date) {
                let data = {
                    'startDate': moment(date).format('L'),
                };

                modal('Time Off Modal', trans('Fehlzeiten'), data);
            }
        },

        created() {
            events.$on('timeoffs.updated', this.getTimeOffs);
        }
    }
</script>