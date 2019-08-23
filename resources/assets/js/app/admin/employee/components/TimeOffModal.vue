<template>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form-wrapper :action="'/api/employee/' + data.employee.id + '/timeoff'">
                        <template slot-scope="form">
                            <div class="row">
                                <div class="col-md-6 form-group" :class="{'has-error': form.errors.start_date }">
                                    <label>{{trans('admin.Startdatum')}}</label>
                                    <datepicker name="start_date" v-model="startDate"></datepicker>
                                </div>
                                <div class="col-md-6 form-group" :class="{'has-error': form.errors.end_date }">
                                    <label>{{trans('admin.Enddatum')}}</label>
                                    <datepicker name="end_date"></datepicker>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': form.errors.type }">
                                <select class="form-control input-sm" name="type">
                                    <option value="">{{trans('admin.Ausfallgrund wählen')}}</option>
                                    <option value="Krankheit">{{trans('admin.Krankheit')}}</option>
                                    <option value="Fehltag">{{trans('admin.Fehltag')}}</option>
                                    <option value="Urlaub">{{trans('admin.Urlaub')}}</option>
                                </select>
                            </div>
                            <div class="form-group" :class="{'has-error': form.errors.information }">
                                <textarea class="form-control input-sm" name="information" cols="30" rows="2"></textarea>
                            </div>

                            <submit-button class="btn-sm btn-success" :text="trans('admin.Neuer Eintrag')" :loading="form.loading"></submit-button>
                        </template>
                    </form-wrapper>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <table v-if="items" class="table table-condensed">
                <thead>
                <tr>
                    <th>{{trans('admin.Datum')}}</th>
                    <th>{{trans('admin.Typ')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in visibleItems">
                    <td>
                        <span v-if="item.start != item.end">{{ moment(item.start).locale('en').format('Do MMM') + ' - ' + moment(item.end).locale('en').format('ll') }}</span>
                        <span v-else>{{ moment(item.start).locale('en').format('ll') }}</span>
                    </td>
                    <td>{{ trans('admin.'+item.type) }}</td>
                    <td>
                        <i @click="destroy(item)" class="fa fa-times text-danger pointer"></i>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="pull-right">
                <pagination-links
                        :items="items"
                        @paginate="updatePage"
                        :currentPage="currentPage"
                >
                </pagination-links>
            </div>
        </div>
    </div>
</template>

<script>
    import Pagination from '../../../mixins/Pagination';

    export default {
        data: function () {
            return {
                items: [],
                startDate: this.data.startDate
            }
        },

        props: ['data'],
        mixins: [Pagination],

        methods: {

            getItems() {
                axios.get('/api/employee/' + this.data.employee.id + '/timeoff').then((response) =>
                    this.items = response.data
                ).then(this.updateVisibleItems);
            },

            destroy(item) {
                swal({text: trans('admin.Eintrag wirklich löschen?')}).then(() => {
                    let data = {
                        entry: item
                    };

                    axios.post('/api/employee/' + this.data.employee.id + '/timeoff/delete', data).then((response) => {
                        this.getItems()

                        events.$emit('timeoffs.updated')
                    });
                });
            }
        },

        created() {
            this.getItems();

            this.$on('form.submitted', (form) => {
                form.reset();
                this.startDate = '';

                this.getItems();

                events.$emit('timeoffs.updated');
            });
        }
    }
</script>
