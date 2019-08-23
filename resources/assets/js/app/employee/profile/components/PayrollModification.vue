<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('admin.Netto-Bezüge / Netto-Abzüge')}}</h4>
        </div>
        <div class="panel-body">
            <table v-if="items.length" class="table">
                <thead>
                <tr>
                    <th>{{trans('admin.Datum')}}</th>
                    <th>{{trans('admin.Typ')}}</th>
                    <th>{{trans('admin.Betrag')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entry, index) in visibleItems">
                    <td :title="trans('admin.Eingetragen am')+' ' + moment(entry.created_at).format('lll') + trans('admin.Uhr')">
                        {{ moment(entry.date).format('MMM YYYY') }}
                    </td>
                    <td>
                        <span v-if="options">{{ options[entry.type].name }}</span>
                        <div v-if="entry.information" class="small">{{ entry.information }}</div>
                    </td>
                    <td>
                        {{ money(entry.amount) }} €
                    </td>
                </tr>
                </tbody>
            </table>
            <p v-else>{{trans('admin.Keine Einträge')}}</p>
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
                axios.get('/api/e/payroll').then((response) =>
                        this.items = response.data
                ).then(this.updateVisibleItems);
            }
        },

        created() {
            axios.post('/api/settings/get', {name: 'payroll_relevant_factors'}).then((response) => this.options = response.data);
        },

        mounted() {
            this.getItems();
        }

    }
</script>
