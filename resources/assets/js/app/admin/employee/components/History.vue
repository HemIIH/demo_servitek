<template>
    <div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <input class="form-control input-sm" v-model="searchString" :placeholder="trans('admin.Filtern')">
                </div>
            </div>
        </div>
        <table v-if="items" class="table">
            <thead>
            <tr>
                <th>{{trans('admin.Auftrag')}}</th>
                <th>{{trans('admin.Kunde')}}</th>
                <th>{{trans('admin.Datum')}}</th>
                <th>{{trans('admin.Zeiterfasst')}}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in filteredOrders">
                <td><a :href="'/admin/order/' + order.id + '/show'">{{ order.id }}</a></td>
                <td><a :href="'/admin/client/' + order.client.id + '/show'">{{ order.client.name }}</a></td>
                <td>{{ order.start == order.end ? moment(order.start_date).locale('en').format('L') : moment(order.start_date).locale('en').format('DD.MM.') + ' - ' + moment(order.end_date).locale('en').format('L') }}</td>
                <td>{{ order.timetrackings.length > 0 ? hour(order.timetrackings[0].total_min/60) + trans('admin.Stunden') : '-' }}</td>
            </tr>
            <tr v-if="! filteredOrders.length && items.length">
                <td colspan="5">{{trans('admin.Keine Aufträge gefunden')}}</td>
            </tr>
            </tbody>
        </table>
        <p v-else>{{trans('admin.Keine Aufträge in der Vergangenheit')}}</p>

        <div v-if="! searchString" class="pull-right">
            <pagination-links
                    :items="items"
                    @paginate="updatePage"
                    :currentPage="currentPage"
                    :pageSize="pageSize">
            </pagination-links>
        </div>
    </div>
</template>

<script>
    import Pagination from '../../../mixins/Pagination';

    export default {
        data() {
            return {
                searchString: '',
                pageSize: 15
            }
        },
        mixins: [Pagination],
        props: ['items'],


        computed: {
            filteredOrders() {
                if (this.searchString == '') {
                    return this.visibleItems;
                }

                this.searchString = this.searchString.trim().toLowerCase();

                return this.items.filter(item => {
                    return item.id == this.searchString ||
                           item.work_location.toLowerCase().indexOf(this.searchString) > -1 ||
                           item.client.name.toLowerCase().indexOf(this.searchString) > -1
                })
            }
        }
    }
</script>
