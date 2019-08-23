<template>
    <form-wrapper :action="'/api/employee/' + data.employee.id + '/document/' + data.type">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Mitarbeiter')}}</label>
                            <div>{{ data.employee.last_name + ', ' + data.employee.first_name }}</div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Geburtsdatum')}}</label>
                            <div>{{ data.employee.date_of_birth }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>{{trans('admin.Eintrittsdatum')}}</label>
                            <div>{{ data.employee.entry_date }}</div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>{{trans('admin.Austrittsdatum')}}</label>
                            <div>{{ data.employee.exit_date ? data.employee.exit_date : '-' }}</div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Betriebszugehörigkeit')}}</label>
                            <div>{{periodOfEmployment}}</div>
                        </div>
                    </div>

                    <hr>

                    <div v-if="data.type == 'contract_parttime' || data.type == 'contract_temporary'">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{trans('admin.Region')}}</label>
                                <select class="form-control input-sm" v-model="region" @change="getSalary">
                                    <option value="">{{trans('admin.Auswählen')}}</option>
                                    <option v-for="region in regions" :value="region">{{ region }}</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.health_insurance }">
                                <label>{{trans('admin.Entgeltgruppe')}}</label>
                                <select class="form-control input-sm" v-model="salaryGroup" @change="getSalary">
                                    <option v-for="salaryGroup in [1, 2, 3, 4, 5, 6, 7, 8, 9]" :value="salaryGroup">{{ salaryGroup }}</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-3 form-group" :class="{'has-error': form.errors.wage }">
                                <label>{{trans('admin.Tarifliches Entgelt')}}</label>
                                <input class="form-control input-sm" name="wage" v-model="wage" readonly>
                            </div>
                            <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.bonus }">
                                <label>{{trans('admin.Zulage')}}</label>
                                <input class="form-control input-sm" name="bonus" v-model="bonus">
                            </div>
                            <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.gross }">
                                <label>{{trans('admin.Brutto-Lohn')}}</label>
                                <input class="form-control input-sm" name="gross" v-model="gross" readonly>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3 form-group" :class="{'has-error': form.errors.entry_date }">
                                <label>{{trans('admin.Eintrittsdatum')}}</label>
                                <datepicker name="entry_date" v-model="entryDate" @change="getSalary"></datepicker>
                            </div>
                            <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.contractual_working_hours }">
                                <label>{{trans('admin.Vereinbarte Arbeitszeit')}}</label>
                                <input class="form-control input-sm" name="contractual_working_hours">
                            </div>
                        </div>
                    </div>

                    <div v-if="data.type == 'warning'">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-10 form-group" :class="{'has-error': form.errors.date_of_notice }">
                                    <label>{{trans('admin.Erfahren am')}}</label>
                                    <datepicker name="date_of_notice"></datepicker>
                                </div>
                                <div class="col-md-10 form-group" :class="{'has-error': form.errors.date_of_violation }">
                                    <label>{{trans('admin.Tag des Verstosses')}}</label>
                                    <datepicker name="date_of_violation"></datepicker>
                                </div>
                                <div class="col-md-10 form-group" :class="{'has-error': form.errors.amount }">
                                    <label>{{trans('admin.Vertragsstrafe')}}</label>
                                    <input class="form-control input-sm" name="amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" :class="{'has-error': form.errors.note }">
                                    <label>{{trans('admin.Hinweis')}}</label>
                                    <textarea class="form-control input-sm" name="note"></textarea>
                                </div>
                                <div class="form-group" :class="{'has-error': form.errors.reason }">
                                    <label>{{trans('admin.Grund')}}</label>
                                    <textarea class="form-control input-sm" name="reason"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="data.type == 'pension'">
                        <div class="row">
                            <div class="col-md-5 form-group" :class="{'has-error': form.errors.date_of_receipt }">
                                <label>{{trans('admin.Antragseingang')}}</label>
                                <datepicker name="date_of_receipt"></datepicker>
                            </div>
                            <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.date_of_taking_effect }">
                                <label>{{trans('admin.Antrag wirksam ab')}}:</label>
                                <datepicker name="date_of_taking_effect"></datepicker>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group" :class="{'has-error': form.errors.name }">
                                <label>{{trans('admin.Name')}}</label>
                                <input class="form-control input-sm" name="name">
                            </div>
                            <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.operation_number }">
                                <label>{{trans('admin.Betriebsnummer')}}</label>
                                <input class="form-control input-sm" name="operation_number">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-5 form-group" :class="{'has-error': form.errors.place }">
                                <label>{{trans('admin.Ort')}}</label>
                                <input class="form-control input-sm" name="place">
                            </div>
                            <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.date }">
                                <label>{{trans('admin.Datum')}}</label>
                                <datepicker name="date"></datepicker>
                            </div>
                        </div>
                    </div>

                    <div v-if="data.type == 'withdrawal_receipt'">
                        <div class="row">
                            <div class="col-md-3 form-group" :class="{'has-error': form.errors.date_of_creation }">
                                <label>{{trans('admin.Kündigungsdatum')}}</label>
                                <datepicker name="date_of_creation"></datepicker>
                            </div>
                            <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.date_of_receipt }">
                                <label>{{trans('admin.Kündigungseingang')}}</label>
                                <datepicker name="date_of_receipt"></datepicker>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>{{trans('admin.Kündigungsdatum')}}</label>
                                <datepicker name="termination_date" v-model="terminationDate"></datepicker>
                            </div>
                            <div class="col-md-3 col-md-offset-1 form-group">
                                <label>{{trans('admin.Kündigungsfrist')}}</label>
                                <select class="form-control input-sm" v-model="noticePeriod">
                                    <option value=""></option>
                                    <option value="2">{{trans('admin.2 Tage')}}</option>
                                    <option value="7">{{trans('admin.1 Woche')}}</option>
                                    <option value="14">{{trans('admin.2 Woche')}}</option>
                                    <option value="30">{{trans('admin.1 Monat')}}</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.notice_to }">
                                <label>{{trans('admin.Kündigung zum')}}</label>
                                <datepicker name="notice_to" v-model="noticeTo"></datepicker>
                            </div>
                        </div>
                    </div>

                    <div v-if="data.type.startsWith('termination')">
                        <div class="row">
                            <div v-if="notInProbation" class="col-md-12 margin-b-10">
                                <div class="alert alert-danger">
                                    <i class="fa fa-warning margin-r-5"></i>{{trans('admin.Mitarbeiter befindet sich nicht mehr in der Probezeit')}}
                                </div>
                            </div>
                            <div v-if="data.type != 'termination_without_notice'">
                                <div class="col-md-3">
                                    <label>{{trans('admin.Kündigungsdatum')}}</label>
                                    <datepicker name="termination_date" v-model="terminationDate"></datepicker>
                                </div>
                                <div class="col-md-3 col-md-offset-1 form-group">
                                    <label>{{trans('admin.Kündigungsfrist')}}</label>
                                    <select class="form-control input-sm" v-model="noticePeriod">
                                        <option value=""></option>
                                        <option value="2">{{trans('admin.2 Tage')}}</option>
                                        <option value="7">{{trans('admin.1 Woche')}}</option>
                                        <option value="14">{{trans('admin.2 Woche')}}</option>
                                        <option value="30">{{trans('admin.1 Monat')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.notice_to }">
                                    <label>{{trans('admin.Kündigung zum')}}</label>
                                    <datepicker name="notice_to" v-model="noticeTo"></datepicker>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group" :class="{'has-error': form.errors.date_of_contract }">
                                <label>{{trans('admin.Arbeitsverhältnis vom')}}</label>
                                <datepicker name="date_of_contract" v-model="data.employee.entry_date"></datepicker>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.date}">
                            <label>{{trans('admin.Unterschrift - Datum')}}</label>
                            <datepicker name="date" v-model="date"></datepicker>
                        </div>
                        <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.place }">
                            <label>{{trans('admin.Unterschrift - Ort')}}</label>
                            <input class="form-control input-sm" name="place">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <button id="submit-button" type="submit" class="hidden"></button>
                <submit-button class="btn-success" @click.prevent="submitForm"  :text="trans('admin.Anlegen')" :loading="loading"></submit-button>
            </div>
        </template>
    </form-wrapper>
</template>


<script>
    export default {
        data() {
            return {
                terminationDate: moment().format('L'),
                noticePeriod: this.calcNoticePeriod(),
                region: '',
                regions: ['West', 'Ost'],
                salaryGroup: 1,
                entryDate: this.data.employee.entry_date,
                wage: '',
                bonus: '',
                date: moment().format('L'),
                loading: false
            }
        },
        props: ['data'],

        computed: {
            noticeTo () {
                if (this.data.type == 'termination_without_notice') {
                    return moment().add(2, 'days').format('L');
                }

                if (this.noticePeriod >= 30) {
                    let date = moment(this.terminationDate, 'L').add(this.noticePeriod, 'days').add(2, 'days');

                    if (date.format('D') < 15) {
                        return moment([date.year(), date.month(), 15]).format('L');
                    }

                    return date.endOf('month').format('L');
                }

                return moment(this.terminationDate, 'L').add(this.noticePeriod, 'days').add(2, 'days').format('L');
            },

            notInProbation() {
                return moment(this.data.employee.entry_date, 'L').isBefore(moment().subtract(6, 'months')) && this.data.type == 'termination_within_probation';
            },

            gross() {
                return this.money(parseFloat(this.wage.replace(',', '.')) + (this.bonus ? parseFloat(this.bonus.replace(',', '.')) : 0));
            },

            periodOfEmployment() {
                let days;

                if (this.data.employee.exit_date && moment(this.data.employee.exit_date, 'L') < moment()) {
                    days = moment(this.data.employee.exit_date, 'L').diff(moment(this.data.employee.entry_date, 'L'), 'days');
                } else {
                    days = moment(this.data.employee.entry_date, 'L') < moment() ? moment().diff(moment(this.data.employee.entry_date, 'L'), 'days') : 0;
                }

                return this.pluralize(trans('admin.Monat'), 'e', parseInt(days / 30)) + ' ' + this.pluralize(trans('admin.Tag'), 'e', days % 30);
            }
        },

        methods: {
            getSalary() {
                let data = {
                    region: this.region,
                    salary_group: this.salaryGroup,
                    valid_from: this.entryDate
                };

                axios.post('/api/salary/get', data).then((response) => {
                    this.wage = response.data.wage;
                    this.bonus = response.data.bonus;
                });
            },

            calcNoticePeriod() {
                let days = moment().diff(moment(this.data.employee.entry_date, 'L'), 'days');

                if (days <= 28) {
                    return 2;
                } else if (days <= 60) {
                    return 7;
                } else if (days <= 180) {
                    return 14
                } else {
                    return 30;
                }
            },

            submitForm() {
                this.loading = true;

                if (this.data.type.startsWith('termination')) {
                    swal({title: 'Austrittsdatum festlegen?', text: this.noticeTo + ' als Austrittsdatum speichern'}).then(() => {
                        let data = {
                            entry_date: this.data.employee.entry_date,
                            exit_date: this.noticeTo
                        };

                        axios.post('/api/employee/' + this.data.employee.id + '/update', data).then(() => {
                            flash(trans('admin.Austrittsdatum gespeichert'));

                            document.getElementById('submit-button').click();
                        }).catch((error) =>
                            flash(error.response.data.errors.exit_date[0], 'error')
                        );
                    });
                } else {
                    document.getElementById('submit-button').click();
                }

                this.loading = false;
            }
        },

        created() {
            this.$on('form.submitted', () => {
                events.$emit('document.created');

                this.$parent.$emit('close')
            })
        }
    }
</script>