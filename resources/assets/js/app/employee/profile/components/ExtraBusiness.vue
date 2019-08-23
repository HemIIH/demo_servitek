<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('admin.Zusätzliche Tätigkeiten')}}</h4>
        </div>
        <div class="panel-body">
            <table v-if="items.length" class="table">
                <thead>
                <tr>
                    <th>{{trans('admin.Datum')}}</th>
                    <th>{{trans('admin.Typ')}}</th>
                    <th>{{trans('admin.Stunden')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entry, index) in visibleItems">
                    <td :title="trans('admin.Eingetragen am')+' ' + moment(entry.created_at).format('lll') + trans('admin.Uhr')">
                        {{ moment(entry.date).format('l') }}
                    </td>
                    <td>
                        <span v-if="options">{{ trans('admin.'+options[entry.type].name) }}</span>
                        <div v-if="entry.information" class="small">{{ entry.information }}</div>
                    </td>
                    <td>
                        {{ hour(entry.hours) }}
                    </td>
                </tr>
                </tbody>
            </table>
            <p v-else>{{trans('admin.Keine Einträge')}}</p>

            <pagination-links class="pull-right"
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
                options: '',
                items: []
            }
        },

        mixins: [Pagination],

        methods: {
            getItems() {
                axios.get('/api/e/extra-business').then((response) =>
                    this.items = response.data
                ).then(this.updateVisibleItems);
            }
        },

        created() {
            axios.post('/api/settings/get', {name: 'extra_business'}).then((response) => this.options = response.data);
        },

        mounted() {
            this.getItems();
        }
    }
</script>
