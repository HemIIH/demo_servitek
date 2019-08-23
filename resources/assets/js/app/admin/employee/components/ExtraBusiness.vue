<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-7 panel-title">
                    {{trans('admin.Zusätzliche Tätigkeiten')}}
                </div>
                <div class=" col-md-5">
                    <div class="pull-right margin-t-5">
                        <i v-if="! showForm" @click="showForm = true" class="fa fa-plus text-primary pointer"></i>
                        <i v-else @click="showForm = false" class="fa fa-minus text-primary pointer"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body" v-if="showForm || items.length">
            <form-wrapper v-show="showForm" :action="data.url">
                <template slot-scope="form">
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.date }">
                            <label>{{trans('admin.Datum')}}</label> <i v-if="form.errors.date" class="fa fa-warning text-danger" :title="form.errors.date"></i>
                            <datepicker name="date" v-model="data.date"></datepicker>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.type }">
                            <label>{{trans('admin.Typ')}}</label> <i v-if="form.errors.type" class="fa fa-warning text-danger" :title="form.errors.type"></i>
                            <select class="form-control input-sm" name="type" v-model="data.type">
                                <option value="">{{trans('admin.Auswählen')}}</option>
                                <option v-for="(option, name) in options" :value="name">{{ trans('admin.'+option.name)}}</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.hours }">
                            <label>{{trans('admin.Stunden')}}</label> <i v-if="form.errors.hours" class="fa fa-warning text-danger" :title="form.errors.hours"></i>
                            <input class="form-control input-sm" name="hours" v-model="data.hours">
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.information }">
                        <i v-if="form.errors.information" class="fa fa-warning text-danger" :title="form.errors.information"></i>
                        <textarea class="form-control input-sm" name="information" rows="2" placeholder="Information...." v-model="data.information"></textarea>
                    </div>

                    <submit-button v-if="! editMode" class="pull-right btn-sm btn-primary" :text="trans('admin.Neu')" :loading="form.loading"></submit-button>

                    <div v-if="editMode" class="pull-right">
                        <submit-button class="pull-right btn-sm btn-primary" :text="trans('admin.Speichern')" :loading="form.loading"></submit-button>
                        <button @click="reset" class="btn btn-sm btn-danger margin-r-5">{{trans('admin.Abbrechen')}}</button>
                    </div>
                </template>
            </form-wrapper>

            <table v-if="items.length" class="table">
                <thead>
                <tr>
                    <th>{{trans('admin.Datum')}}</th>
                    <th>{{trans('admin.Typ')}}</th>
                    <th>{{trans('admin.Stunden')}}</th>
                    <th v-if="canDelete"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entry, index) in visibleItems">
                    <td :title="trans('admin.Eingetragen am')+' ' + moment(entry.created_at).locale('en').format('lll') + trans('admin.Uhr')">
                        {{ moment(entry.date).locale('en').format('l') }}
                    </td>
                    <td>
                        <span v-if="options">{{ trans('admin.'+options[entry.type].name)  }}</span>
                        <div v-if="entry.information" class="small">{{ entry.information }}</div>
                    </td>
                    <td>
                        {{ hour(entry.hours) }}
                    </td>
                    <td v-if="canDelete">
                        <div class="pull-right">
                            <span @click="edit(entry)"><i class="fa fa-pencil pointer"></i></span>
                            <span @click="destroy(entry, index)"><i class="fa fa-times text-danger pointer"></i></span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

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
    import Collection from '../../../mixins/Collection';
    import Pagination from '../../../mixins/Pagination';

    export default {
        data() {
            return {
                modelType: 'employee',
                resource: 'extraBusiness',
                options: '',
                editMode: false,

                entry: '',

                data: {
                    url: '/api/employee/' + this.model.id + '/extraBusiness',
                    date: '',
                    type: '',
                    hours: '',
                    information: ''
                }
            }
        },

        mixins: [Collection, Pagination],

        methods: {

            edit(entry) {
                this.editMode = true;
                this.showForm = true;

                this.entry = entry;

                this.data = {
                    url: '/api/employee/' + this.model.id + '/extraBusiness/' + entry.id + '/update',
                    date: moment(entry.date).format('L'),
                    type: entry.type,
                    hours: this.hour(Math.abs(entry.hours)),
                    information: entry.information
                }
            },

            reset() {
                this.editMode = false;
                this.entry = '';
                this.errors = '';

                Object.assign(this.$data.data, this.$options.data.call(this).data);
            }
        },

        created() {
            axios.post('/api/settings/get', {name: 'extra_business'}).then((response) =>
                    this.options = response.data
            );
        },

        mounted() {
            this.$on('form.submitted', () => {
                this.reset();

                flash(trans('admin.Eintrag gespeichert'));
            });

            this.$on('items.received', this.updateVisibleItems);
        }
    }
</script>
