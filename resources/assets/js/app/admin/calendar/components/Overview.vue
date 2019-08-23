<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-title">{{ trans('admin.Übersicht' )}}</div>
                </div>
                <div class="col-md-6 h5">
                    <ul class="pager list-unstyled pull-right">
                        <li>
                            <i @click="sub('months')" class="fa fa-angle-left fa-lg pointer margin-r-5 text-primary"></i>
                        </li>
                        <li>
                            {{moment(start).locale('en').format('MMMM')}} {{ moment(start).locale('de').format('YYYY') }}
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
                        <div class="form-group margin-r-10">
                            <label class="margin-r-5">{{ trans('admin.Kunde' )}}</label>
                            <select class="form-control" v-model="client" @change="getOrders">
                                <option value="">{{ trans('admin.Alle' )}}</option>
                                <option v-for="client in clients" :value="client.id">{{trans('admin.'+ client.short_name) }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="margin-r-5">{{trans('admin.Status')}}</label>
                            <select class="form-control" v-model="status" @change="getOrders">
                                <option value="">{{ trans('admin.Alle' )}}</option>
                                <option value="time_recorded">{{ trans('admin.Zeiterfasst' )}}</option>
                                <option value="not_time_recorded">{{ trans('admin.Nicht zeiterfasst' )}}</option>
                                <option value="canceled">{{ trans('admin.Storniert' )}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="form-inline">
                    <div>
                        <div class="form-group">
                            <label class="margin-r-5">{{trans('admin.Standort')}}</label>
                            <select class="form-control" v-model="location" @change="getOrders">
                                <option value="">{{ trans('admin.Alle' )}}</option>
                                <option v-for="location in locations" :value="location.name">{{trans('admin.'+ location.name) }}</option>
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
                    </td>
                </tr>
                <tr>
                    <td height="90px" style="vertical-align: middle;">
                        {{trans('admin.KW')}} {{ moment(startOfWeek).isoWeek() }}
                    </td>
                    <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">

                        <div v-if="orders[date]" v-for="order in orders[date]" :key="order.id" class="margin-b-10 bg-grey-light" :class="[getOrderStatus(order), getBackground(order)]">
                            <div class="margin-5 margin-l-10 pointer" @click="openOrder(order)">
                                <div>
                                    <i v-if="order.start != order.end" class="fa fa-link margin-r-5"></i>
                                    <span :title="order.title" class="pointer" >{{ shorten(order.client.short_name, 14) }}</span>
                                </div>
                                <i class="fa fa-clock-o"></i> {{ order.start_time }} {{trans('admin.Uhr')}}
                                <div class="pull-right">
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
                status: ''
            }
        },
        mixins: [Calendar],

        methods: {
            getOrders() {
                let data = {
                    client: this.client,
                    location: this.location,
                    status: this.status,
                    start: this.start
                };

                axios.post('/api/orders/by/month', data).then((response) => {
                    this.orders = response.data.orders
                    this.weeks = response.data.weeks
                });
            },

            openOrder(order) {
                modal('Show Order Modal', trans('admin.Auftrag anzeigen'), {'order': order});
            },

            getBackground(order)
            {
                if (order.billed)
                    return 'bg-green-light';

                if (order.time_recorded)
                    return 'bg-yellow-light';

                return 'bg-grey-light';
            }
        }
    }
</script>