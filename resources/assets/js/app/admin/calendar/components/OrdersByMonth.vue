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
                                    <i @click="sub('months')" class="fa fa-angle-left fa-lg pointer margin-r-5 text-primary"></i>
                                </li>
                                <li>
                                    {{ moment(start).locale('de').format('MMMM YYYY') }}
                                </li>
                                <li>
                                    <i @click="add('months')" class="fa fa-angle-right fa-lg pointer margin-l-5 text-primary"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="pull-left">
                        <div class="form-inline">
                            <div>
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
                    </div>
                    <div class="pull-right">
                        <div class="form-inline">
                            <div>
                                <div class="form-group">
                                    <label class="margin-r-5">{{ trans('admin.Standort' )}}</label>
                                    <select class="form-control input-sm" v-model="location" @change="getOrders">
                                        <option value="">{{ trans('admin.Alle' )}}</option>
                                        <option v-for="location in locations" :value="location">{{trans('admin.'+ location) }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>

                    <table v-for="(week, startOfWeek) in weeks" class="table table-fixed margin-b-0" id="order-calendar">
                        <tbody>
                        <tr class="bg-black-light">
                            <td width="70px"></td>
                            <td v-for="(weekday, date) in week" class="padding-5">
                                {{ trans('admin.'+ weekday) + ', ' + moment(date).format('l') }}
                                <a href="#" @click.prevent="newOrder(date)" class="pull-right">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td height="90px" style="vertical-align: middle;">
                                <a :href="'/admin/calendar/orders/by/week?start=' + startOfWeek">{{trans('admin.KW')}} {{ moment(startOfWeek).isoWeek() }}</a>
                            </td>
                            <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">

                                <div v-for="timeoff in timeoffs[date]" class="small text-center margin-b-5" :class="highlightTimeOff(timeoff.type)" style="width:100%;">
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

    export default {
        data() {
            return {
                weeks: []
            }
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

                axios.post('/api/orders/by/month', data).then((response) => {
                    this.orders = response.data.orders
                    this.weeks = response.data.weeks
                    this.timeoffs = response.data.timeoffs
                });
            }
        }
    }
</script>