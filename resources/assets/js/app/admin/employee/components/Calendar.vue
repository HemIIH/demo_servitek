<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5">
                    <div class="panel-title">{{trans('admin.Kalender')}}</div>
                </div>
                <div class="col-md-3">
                    <a href="#" @click.prevent="editTimeOffs" class="btn btn-default btn-sm">{{trans('admin.Fehlzeiten')}}</a>
                </div>
                <div class="col-md-4 h5">
                    <ul class="pager list-unstyled pull-right">
                        <li>
                            <i @click="sub('months')" class="fa fa-angle-left fa-lg pointer margin-r-5 text-primary"></i>
                        </li>
                        <li>
                            {{ trans('admin.'+moment(start).locale('en').format('MMMM')) }} {{ moment(start).locale('en').format('YYYY') }}
                        </li>
                        <li>
                            <i @click="add('months')" class="fa fa-angle-right fa-lg  pointer margin-l-5 text-primary"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <calendar-date-menu class="margin-b-10" :employee="employee"></calendar-date-menu>

            <table v-for="(week, startOfWeek) in weeks" class="table table-fixed margin-b-0" id="order-calendar">
                <tbody>
                <tr class="bg-black-light">
                    <td style="width:40px;"></td>
                    <td v-for="(weekday, date) in week" class="padding-5">
                        {{ trans('admin.'+weekday) }}
                        <a href="#" @click.prevent="newTimeOff(date)" class="pull-right small">
                            <i class="fa fa-plus"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td height="90px" style="width:40px;vertical-align: middle;">
                        {{ trans('admin.KW') }} <br>{{ moment(startOfWeek).isoWeek() }}
                    </td>
                    <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">
                        <div class="text-muted small text-right">{{ moment(date).locale('en').format('Do') }}</div>

                        <div v-for="timeoff in timeoffs[date]" class="text-center small margin-b-10 pointer" style="width: 100%;" :class="highlightTimeOff(timeoff.type)">
                            <span @click="editTimeOff(timeoff)">{{ trans('admin.'+timeoff.type) }}</span>
                        </div>

                        <div v-for="order in orders[date]" class="bg-grey-light" :class="getOrderStatus(order)">
                            <div class="margin-5">
                                <div>
                                    <strong class="pointer" @click="openOrder(order)" :title="order.title">{{trans('admin.Auftrag')}}</strong>
                                </div>
                                <i class="fa fa-clock-o"></i> {{ order.start_time }}
                                <div class="pointer text-right" @click="assignEmployees(order)">
                                    <strong>{{ order.staff_planned + '/' + order.staff_required }}</strong>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Calendar from '../../../mixins/Calendar'

    export default {
        data() {
            return {
                weeks: [],
                orders: [],
                timeoffs: [],
                start: moment().format()
            }
        },

        props: ['employee'],
        mixins: [Calendar],

        methods: {
            getOrders() {
                let data = {
                    start: this.start
                };

                axios.post('/api/employee/' + this.employee.id + '/calendar/dates', data).then((response) => {
                    this.orders = response.data.orders
                    this.timeoffs = response.data.timeoffs
                    this.weeks = response.data.weeks
                });
            },

            getTimeOffs() {
                axios.get('/api/employee/' + this.employee.id + '/calendar/timeoffs',).then((response) => {
                    this.timeoffs = response.data
                });
            },

            openOrder(order) {
                modal('Show Order Modal', trans('admin.Auftrag bearbeiten'), {'order': order});
            },

            assignEmployees(order) {
                modal('Assign Employees Modal', trans('admin.Mitarbeiter einplanen'), {'order': order}, '100%');
            },

            editTimeOffs() {
                modal('Time Off Modal', trans('admin.Fehlzeiten'), {'employee': this.employee});
            },

            editTimeOff(timeoff) {
                let data = {
                    'timeoff': timeoff,
                    'employee': this.employee
                };

                modal('Edit Time Off Modal', trans('admin.Fehlzeiten'), data);
            },

            newTimeOff(date) {
                let data = {
                    'startDate': moment(date).format('L'),
                    'employee': this.employee
                };

                modal('Time Off Modal', trans('admin.Fehlzeiten'), data);
            },

            getOrderStatus(order){
                if (order.status == 'canceled') {
                    return 'order-canceled';
                }

                if (order.pivot.approved_by_employee) {
                    return 'order-filled';
                }

                if (order.pivot.rejected_by_employee) {
                    return 'order-unfilled';
                }

                return '';
            }
        },

        created() {
            events.$on('timeoffs.updated', this.getTimeOffs);
        }
    }
</script>