<template>
    <div>
        <div class="pull-right">
            <ul class="pager list-unstyled">
                <li>
                    <a @click="sub('weeks')">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
                <li>
                    {{trans('admin.KW')}} {{ moment(start).week() }}
                </li>
                <li>
                    <a @click="add('weeks')">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </div>

        <br>
        <br>

        <table class="table table-fixed" id="order-calendar">
            <thead>
            <tr class="bg-grey-light">
                <th v-for="(weekday, date) in week">
                    {{ trans('admin.'+weekday) + ', ' + moment(date).format('l') }}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr height="300px">
                <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">

                    <div v-for="timeoff in timeoffs[date]" class="text-center small margin-b-10 pointer" style="width: 100%;" :class="highlightTimeOff(timeoff.type)">
                        {{ timeoff.type }}
                    </div>

                    <order v-for="order in orders[date]" :order="order" :key="order.id" ></order>

                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Calendar from '../../../mixins/Calendar';

    export default {
        data() {
            return {
                start: moment().format(),
                week: [],
                orders: [],
                timeoffs: []
            }
        },
        mixins: [Calendar],

        methods: {
            getOrders() {
                let data = {
                    start: this.start
                };

                axios.post('/api/e/orders/by/week', data).then((response) => {
                    this.orders   = response.data.orders
                    this.timeoffs = response.data.timeoffs
                    this.week     = response.data.week
                });
            }
        }
    }
</script>

<style>
    table#order-calendar {
        height: 380px;
    }

    table#order-calendar thead {
        width: calc(100% - 0.9em);
    }

    table#order-calendar tbody {
        display: block;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    table#order-calendar tbody tr {
        width: 100%;
    }

    table#order-calendar thead, table#order-calendar tbody tr {
        display: table;
        table-layout: fixed;
    }
</style>