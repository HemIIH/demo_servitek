<template>
    <form-wrapper action="/api/employee/store" method="POST">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 checkbox">
                            <label>
                                <input type="checkbox" name="applicant" value="1" checked> {{trans('admin.Bewerber')}}
                            </label>
                        </div>
                        <div class="col-md-5 col-md-offset-1 margin-t-10">
                            <i class="fa fa-info text-primary margin-r-5"></i> {{trans('admin.Mitarbeiter wird als Bewerber angelegt')}}
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.first_name }">
                            <label>{{trans('admin.Vorname')}}</label>
                            <input class="form-control input-sm" name="first_name">
                            <span v-if="form.errors.first_name " class="help-block">{{ form.errors.first_name }}</span>
                        </div>
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.last_name }">
                            <label>{{trans('admin.Nachname')}}</label>
                            <input class="form-control input-sm" name="last_name">
                            <span v-if="form.errors.last_name " class="help-block">{{ form.errors.last_name }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.email }">
                            <label>{{trans('admin.E-Mail')}}</label>
                            <input class="form-control input-sm" name="email">
                            <span v-if="form.errors.email " class="help-block">{{ form.errors.email }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <label>{{trans('admin.Geburtsdatum')}}</label>
                            <div class="form-inline">
                                <div class="form-group" :class="{'has-error': form.errors.day }">
                                    <select name="day" class="form-control input-sm">
                                        <option value="">{{trans('admin.Tag')}}</option>
                                        <option v-for="day in days" :value="day">{{ day }}</option>
                                    </select>
                                </div>
                                <div class="form-group" :class="{'has-error': form.errors.month }">
                                    <select name="month" class="form-control input-sm">
                                        <option value="">{{trans('admin.Monat')}}</option>
                                        <option v-for="month in months" :value="month.id">{{ trans('admin.'+month.name)  }}</option>
                                    </select>
                                </div>
                                <div class="form-group" :class="{'has-error': form.errors.year }">
                                    <select name="year" class="form-control input-sm">
                                        <option value="">{{trans('admin.Jahr')}}</option>
                                        <option v-for="year in years" :value="year">{{ year }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{trans('admin.Geschlecht')}}</label>
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="m" checked>
                                    {{trans('admin.Männlich')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="f">
                                    {{trans('admin.Weiblich')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.occupation_type }">
                            <label>{{trans('admin.Beschäftigungsart')}}</label>
                            <select class="form-control input-sm" name="occupation_type">
                                <option value="">{{trans('admin.Auswählen')}}</option>
                                <option value="full_time">{{trans('admin.Vollzeit')}}</option>
                                <option value="part_time">{{trans('admin.Teilzeit')}}</option>
                                <option value="temporary">{{trans('admin.Geringfügig')}}</option>
                            </select>
                            <span v-if="form.errors.occupation_type " class="help-block">{{ form.errors.occupation_type }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.contractual_working_hours }">
                            <label>{{trans('admin.Vereinbarte Arbeitszeit')}}</label>
                            <input class="form-control input-sm" name="contractual_working_hours">
                            <span v-if="form.errors.contractual_working_hours" class="help-block">{{ form.errors.contractual_working_hours }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.entry_date }">
                            <label>{{trans('admin.Eintrittsdatum')}}</label>
                            <datepicker name="entry_date" model=""></datepicker>
                            <span v-if="form.errors.entry_date" class="help-block">{{ form.errors.entry_date }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.wage }">
                            <label>{{trans('admin.Stundenlohn')}}</label>
                            <input class="form-control input-sm" name="wage">
                            <span v-if="form.errors.wage" class="help-block">{{ form.errors.wage }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.entry_date }">
                            <label>{{trans('admin.Einsatzorte')}}</label>
                            <div v-for="location in locations" class="checkbox">
                                <label>
                                    <input type="checkbox" name="locations[]" :value="location.name">{{ trans('admin.'+ location.name) }}
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <submit-button class="pull-right btn-md btn-success" :text="trans('admin.Anlegen')" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                days: [],
                months: [],
                years: [],
                locations: []
            }
        },
        props: ['data'],

        methods: {
            getDays() {
                for (let i = 1; i <= 31; i++) {
                    this.days.push(i);
                }
            },

            getMonths() {
                for (let i = 0; i <= 11; i++) {
                    this.months.push({
                        id: i + 1,
                        name: moment().locale('de').month(i).format('MMMM')
                    });
                }
            },

            getYears() {
                for (let i = 1960; i <= moment().subtract(16, 'years').format('YYYY'); i++) {
                    this.years.push(i);
                }
            }
        },

        created() {
            this.getDays();
            this.getMonths();
            this.getYears();

            axios.get('/api/settings/locations').then((response) => this.locations = response.data);

            this.$on('form.submitted', function () {
                events.$emit('employee.created');

                flash(trans('admin.Neuen Mitarbeiter angelegt'));

                this.$parent.$emit('close')
            })
        }
    }
</script>