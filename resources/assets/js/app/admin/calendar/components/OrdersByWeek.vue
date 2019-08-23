<template>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-title">{{ trans('admin.Auftragskalender' )}}</div>
                        </div>
                        <div class="col-md-6 h5">
                            <ul class="pager list-unstyled pull-right">
                                <li>
                                    <i @click="sub('week')" class="fa fa-angle-left fa-lg pointer margin-r-5 text-primary"></i>
                                </li>
                                <li>
                                    {{trans('admin.KW')}} {{ moment(start).isoWeek() }}
                                </li>
                                <li>
                                    <i @click="add('week')" class="fa fa-angle-right fa-lg pointer margin-l-5 text-primary"></i>
                                </li>
                            </ul>
                            <a class="pull-right margin-r-10" :href="'/admin/calendar/orders/by/month?start=' + moment(start).startOf('month').format('YYYY-MM-DD')">
                                {{ trans('admin.'+ moment(start).locale('de').format('MMMM'))}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="pull-left">
                        <div class="form-inline">
                            <div class="form-group">
                                <label class="margin-r-5">{{ trans('admin.Mitarbeiter' )}}</label>
                                <select class="form-control input-sm" v-model="employee" @change="getOrders">
                                    <option value="">{{ trans('admin.Alle' )}}</option>
                                    <option v-for="employee in employees" :value="employee.id">{{ employee.last_name + ', ' + employee.first_name }}</option>
                                </select>
                            </div>

                            <div class="form-group margin-l-10">
                                <label class="margin-r-5">{{ trans('admin.Kunde' )}}</label>
                                <select class="form-control input-sm" v-model="client" @change="getOrders">
                                    <option value="">{{ trans('admin.Alle' )}}</option>
                                    <option v-for="client in clients" :value="client.id">{{ client.short_name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="form-inline">
                            <div class="form-group">
                                <label class="margin-r-5">{{ trans('admin.Standort' )}}</label>
                                <select class="form-control input-sm" v-model="location" @change="getOrders">
                                    <option value="">{{ trans('admin.Alle' )}}</option>
                                    <option v-for="location in locations" :value="location">{{trans('admin.'+ location) }}</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <br><br>

                    <table class="table table-fixed" id="order-calendar">
                            <thead>
                            <tr class="bg-black-light">
                                <td v-for="(weekday, date) in week" class="padding-5">
                                    {{ trans('admin.'+weekday) + ', ' + moment(date).format('l') }}
                                    <a href="#" @click.prevent="newOrder(date)" class="pull-right">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr height="70px">
                                <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">

                                    <div v-for="timeoff in timeoffs[date]" class="small text-center margin-b-5" :class="highlightTimeOff(timeoff.type)"> style="width:100%;">
                                        <span>{{ timeoff.type }}</span>
                                    </div>

                                    <div v-if="orders[date]">
                                        <order v-for="order in orders[date]" :key="order.id" :order="order" :class="getOrderStatus(order)"></order>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Calendar from '../../../mixins/Calendar'
    import Order from '../components/Order.vue';

    export default {
        data() {
            return {
                week: []
            }
        },
        components: {
            'Order': Order
        },
        mixins: [Calendar],

        methods: {
            getOrders() {
                let data = {
                    client: this.client,
                    employee: this.employee,
                    location: this.location,
                    start: this.start
                };

                axios.post('/api/orders/by/week', data).then((response) => {
                    this.orders = response.data.orders
                    this.week = response.data.week
                    this.timeoffs = response.data.timeoffs
                });
            }
        }
    }
</script>