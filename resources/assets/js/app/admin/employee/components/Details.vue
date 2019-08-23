<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.Details')}}</h3>
            <div class="pull-right">
                <i v-if="! editMode" @click="editMode = true" class="fa fa-pencil fa-lg pointer"></i>
                <div v-else>
                    <i @click="save" class="fa fa-save fa-lg pointer margin-r-5"></i>
                    <i @click="abort" class="fa fa-times fa-lg text-danger pointer"></i>
                </div>
            </div>
        </div>
        <div class="box-body">

            <strong><i class="fa fa-map-marker margin-r-5"></i>{{trans('admin.Einsatzort')}}</strong>

            <p v-if="! editMode" class="text-muted">
                {{ data.locations ? JSON.parse(data.locations).join(', ') : '-' }}
            </p>

            <div v-else>
                <div v-for="location in locations" class="checkbox">
                    {{ trans('admin.'+location.name)  }}
                    <div class="pull-right">
                        <input type="checkbox" v-model="locationsSelected" :value="location.name">
                    </div>
                </div>
            </div>

            <hr>

            <strong><i class="fa fa-bank margin-r-5"></i>{{trans('admin.Beschäftiung')}}</strong>

            <div v-if="inProbation" class="pull-right">
                <span class="label label-warning">{{trans('admin.Probezeit')}}</span>
            </div>

            <div class="text-muted">
                <div>
                    {{trans('admin.Eintrittsdatum')}}
                    <span class="pull-right">{{ data.entry_date }}</span>
                </div>
                <div v-if="data.exit_date">
                    {{trans('admin.Austrittsdatum')}}
                    <span class="pull-right">{{ data.exit_date }}</span>
                </div>
                <div>
                    {{trans('admin.Beschäftigungsart')}}
                    <span class="pull-right">
                        <span v-if="data.occupation_type == 'full_time'">{{trans('admin.Vollzeit')}}</span>
                        <span v-if="data.occupation_type == 'part_time'">{{trans('admin.Teilzeit')}}</span>
                        <span v-if="data.occupation_type == 'temporary'">{{trans('admin.Geringfügig')}}</span>
                    </span>
                </div>
            </div>

            <hr>

            <div>
                <strong><i class="fa fa-clock-o margin-r-5"></i> {{trans('admin.AZK')}}</strong>
            </div>


            <div class="text-muted">
                <div>
                    {{trans('admin.Gearbeitet im')}} {{ trans(moment().locale('en').format('MMMM')) }}
                    <span class="pull-right">{{ employee.current_working_time_account ? hour(employee.current_working_time_account.actual) : 0 }} {{trans('admin.Stunden')}}</span>
                </div>
                <div>
                    {{trans('admin.Vereinbarte Arbeitszeit')}}
                    <span class="pull-right">{{ employee.current_working_time_account ?  hour(employee.current_working_time_account.target) : 0 }} {{trans('admin.Stunden')}}</span>
                </div>
                <div>
                    {{trans('admin.Arbeitszeitkonto gesamt')}}
                    <span class="pull-right">{{ hour(employee.working_time_account) }} {{trans('admin.Stunden')}}</span>
                </div>

                <div class=" bg-grey-light margin-t-10">
                    <strong>{{trans('admin.Einsetzbar')}}</strong>
                    <div class="pull-right margin-r-5">
                        <i v-if="employee.working_time_account > employee.target" class="fa fa-ban text-danger"></i>
                        <i v-else-if="employee.working_time_account < -21" class="fa fa-check text-success"></i>
                        <i v-else class="fa fa-check text-warning"></i>
                    </div>
                </div>
            </div>

            <hr>

            <strong><i class="fa fa-automobile margin-r-5"></i> {{trans('admin.Sonstiges')}}</strong>

            <div v-if="! editMode" class="text-muted">
                <div>
                    {{trans('admin.PKW')}}
                    <div class="pull-right">
                        <i v-if="data.car" class="fa fa-check text-success"></i>
                        <i v-else class="fa fa-ban text-danger"></i>
                    </div>
                </div>
                <div>
                    {{trans('admin.Führerschein')}}
                    <div class="pull-right">
                        <i v-if="data.driving_license" class="fa fa-check text-success"></i>
                        <i v-else class="fa fa-ban text-danger"></i>
                    </div>
                </div>
                <div>
                    {{trans('admin.Semesterticket')}}
                    <div class="pull-right">
                        <i v-if="data.public_transportation" class="fa fa-check text-success"></i>
                        <i v-else class="fa fa-ban text-danger"></i>
                    </div>
                </div>
            </div>

            <div v-if="editMode" class="text-muted">
                <div class="checkbox">
                    {{trans('admin.PKW')}}
                    <div class="pull-right">
                        <input type="hidden" name="car" value="0">
                        <input name="car" type="checkbox" v-model="input.car">
                    </div>
                </div>
                <div class="checkbox">
                    {{trans('admin.Führerschein')}}
                    <div class="pull-right">
                        <input type="hidden" name="driving_license" value="0">
                        <input name="driving_license" type="checkbox" v-model="input.driving_license">
                    </div>
                </div>
                <div class="checkbox">
                    {{trans('admin.Semesterticket')}}
                    <div class="pull-right">
                        <input type="hidden" name="public_transportation" value="0">
                        <input name="public_transportation" type="checkbox" v-model="input.public_transportation">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: {},
                editMode: false,

                data: Object.assign({}, this.employee),
                input: Object.assign({}, this.employee),
                locationsSelected: JSON.parse(this.employee.locations)
            }
        },

        computed: {
            inProbation() {
                return moment(this.employee.entry_date, 'DD.MM.YYYY').isAfter(moment().subtract(6, 'months'));
            }
        },

        props: ['employee'],

        methods: {
            save: function () {
                let data = {
                    'car': this.input.car,
                    'driving_license': this.input.driving_license,
                    'public_transportation': this.input.public_transportation,
                    'locations': this.locationsSelected
                };

                axios.post('/api/employee/' + this.employee.id + '/update', data).then((response) => {
                    this.editMode = false;
                    this.errors = {};

                    this.data = response.data;
                }).catch((error) => this.errors = error.response.data);
            },

            abort() {
                this.editMode = false;
                this.errors = {};

                Object.assign(this.input, this.data)
            }
        },

        created() {
            axios.get('/api/settings/locations').then((response) => this.locations = response.data);
        }
    }
</script>
