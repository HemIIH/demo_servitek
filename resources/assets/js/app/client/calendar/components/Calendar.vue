<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('admin.Kalender')}}
                <div class="pull-right">
                    <ul class="pager list-unstyled">
                        <li>
                            <a @click="sub('months')">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li>
                            {{ moment(start).locale('de').format('MMMM') }}
                        </li>
                        <li>
                            <a @click="add('months')">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </h4>
        </div>
        <div class="panel-body">
            <table v-for="(week, startOfWeek) in weeks" class="table" id="order-calendar" style="table-layout: fixed;margin:0;">
                <tbody>
                <tr class="bg-black-light">
                    <td style="width:40px;"></td>
                    <td v-for="(weekday, date) in week" class="padding-5">
                        {{ weekday }}
                        <a href="#" @click.prevent="newOrder(date)" class="pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td height="90px" style="width:40px;vertical-align: middle;">
                        {{trans('admin.KW')}} <br>{{ moment(startOfWeek).isoWeek() }}
                    </td>
                    <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">
                        <div class="text-muted small pull-right">{{ moment(date).format('Do') }}</div>
                        <br>

                        <div v-for="order in orders[date]" class="bg-grey-light">
                            <div class="margin-5">
                                <div class="row">
                                    <div class="col-md-9">
                                        <strong class="pointer" @click="showOrder(order)" :title="order.title">{{trans('admin.Auftrag')}}</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <i v-if="order.status == 'active'" class="fa fa-circle text-success" title="Auftrag bestätigt"></i>
                                        <i v-if="order.status == 'canceled'" class="fa fa-circle text-danger" title="Auftrag storniert"></i>
                                        <i v-if="order.status == 'requested'" class="fa fa-circle text-yellow" title="Auftrag angefragt"></i>
                                    </div>
                                </div>
                                <i class="fa fa-map-marker"></i> {{ order.work_location }} <br>
                                <i class="fa fa-clock-o"></i> {{ order.start_time }} {{trans('admin.Uhr')}} <br>
                                <div class="text-right">
                                    <strong>{{trans('admin.MA')}} {{ order.staff_required }}</strong>
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
                start: moment().format(),
                contacts: ''
            }
        },
        props: ['client'],
        mixins: [Calendar],

        methods: {
            newOrder(date) {
                let data = {
                    'startDate': moment(date).format('L'),
                    'contacts': this.contacts
                };

                modal('New Order Modal', trans('Neuen Auftrag erteilen'), data);
            },

            getOrders() {
                let data = {
                    start: this.start
                };

                axios.post('/api/c/orders/by/month', data).then((response) => {
                    this.orders = response.data.orders;
                    this.weeks = response.data.weeks;
                });
            },

            getContacts() {
                axios('/api/c/contacts').then((response) =>
                    this.contacts = response.data
                );
            },

            showOrder(order) {
                modal('Show Order Modal', trans('Auftrag anzeigen'), {'order': order});
            }
        },

        created() {
            this.getContacts();
        }
    }
</script>