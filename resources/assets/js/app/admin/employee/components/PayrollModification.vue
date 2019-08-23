<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-7 panel-title">
                    {{trans('admin.Netto-Bezüge / Netto-Abzüge')}}
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
            <form-wrapper v-if="showForm" :action="data.url" >
                <template slot-scope="form">
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.date }">
                            <label>{{trans('admin.Abrechnungsmonat')}}</label> <i v-if="form.errors.date" class="fa fa-warning text-danger" :title="form.errors.date"></i>
                            <div class="form-inline">
                                <select class="form-control input-sm" name="month" v-model="data.month" :class="{'has-error': form.errors.month }">
                                    <option value="1">{{trans('admin.Jan')}}</option>
                                    <option value="2">{{trans('admin.Feb')}}</option>
                                    <option value="3">{{trans('admin.März')}}</option>
                                    <option value="4">{{trans('admin.Apr')}}</option>
                                    <option value="5">{{trans('admin.Mai')}}</option>
                                    <option value="6">{{trans('admin.Jun')}}</option>
                                    <option value="7">{{trans('admin.Jul')}}</option>
                                    <option value="8">{{trans('admin.Aug')}}</option>
                                    <option value="9">{{trans('admin.Sep')}}</option>
                                    <option value="10">{{trans('admin.Okt')}}</option>
                                    <option value="11">{{trans('admin.Nov')}}</option>
                                    <option value="12">{{trans('admin.Dez')}}</option>
                                </select>

                                <select class="form-control input-sm" name="year" v-model="data.year" :class="{'has-error': form.errors.year }">
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.type }">
                            <label>{{trans('admin.Typ')}}</label> <i v-if="form.errors.type" class="fa fa-warning text-danger" :title="form.errors.type"></i>
                            <select class="form-control input-sm" name="type" v-model="data.type">
                                <option value="">{{trans('admin.Auswählen')}}</option>
                                <option v-for="(option, name) in options" :value="name">{{ trans('admin.'+option.name) }}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.amount }">
                            <label>{{trans('admin.Betrag')}}</label> <i v-if="form.errors.amount" class="fa fa-warning text-danger" :title="form.errors.amount"></i>
                            <input class="form-control input-sm" name="amount" v-model="data.amount">
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
                    <th>{{trans('admin.Betrag')}}</th>
                    <th v-if="canDelete"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entry, index) in visibleItems">
                    <td :title="trans('admin.Eingetragen am')+' ' + moment(entry.created_at).locale('en').format('lll') + trans('admin.Uhr')">
                        {{ moment(entry.date).locale('en').format('MMM YYYY') }}
                    </td>
                    <td>
                        <span v-if="options">{{ trans('admin.'+options[entry.type].name) }}</span>
                        <div v-if="entry.information" class="small">{{ entry.information}}</div>
                    </td>
                    <td>
                        {{ money(entry.amount) }} €
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
                resource: 'payroll',
                options: '',

                editMode: false,

                entry: '',

                data: {
                    url: '/api/employee/' + this.model.id + '/payroll',
                    month: moment().format('M'),
                    year: moment().format('YYYY'),
                    type: '',
                    amount: '',
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
                    url: '/api/employee/' + this.model.id + '/payroll/' + entry.id + '/update',
                    month: moment(entry.date).format('M'),
                    year: moment(entry.date).format('YYYY'),
                    type: entry.type,
                    amount: this.money(Math.abs(entry.amount)),
                    information: entry.information
                }
            },

            reset() {
                this.editMode = false;
                this.entry = '';

                Object.assign(this.$data.data, this.$options.data.call(this).data);
            }
        },

        created() {
            axios.post('/api/settings/get', {name: 'payroll_relevant_factors'}).then((response) =>
                this.options = response.data
            );


            this.$on('form.submitted', () => {
                this.reset();

                flash(trans('admin.Eintrag gespeichert'));
            });

            this.$on('items.received', this.updateVisibleItems);
        }

    }
</script>
