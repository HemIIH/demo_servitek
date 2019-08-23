<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                {{trans('employee.Persönliche Daten')}}
                <span class="pull-right"><i @click="editEmployee('personalData')" class="fa fa-pencil pointer"></i></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Geburtsdatum')}}</label>
                        <div>{{ employee.date_of_birth }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Geburtsort')}}</label>
                        <div>{{ employee.place_of_birth || '-' }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Nationalität')}}</label>
                        <div>{{ employee.nationality || '-' }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Konfession/Religion')}}</label>
                        <div>{{ employee.religion || '-' }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Behinderung')}}</label>
                        <div>{{ employee.disability || '-' }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Schulbildung')}}</label>
                        <div>{{ employee.education_level || '-' }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Zahl der Kinder')}}</label>
                        <div>{{ employee.children || '-' }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Familienstand')}}</label>
                        <div>{{ employee.married ? 'Verheiratet' : ' Ledig' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                {{trans('employee.Vertragsdaten')}}
                <span class="pull-right"><i @click="editEmployee('contractData')" class="fa fa-pencil pointer"></i></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Eintrittsdatum')}}</label>
                        <div>{{ employee.entry_date }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Austrittsdatum')}}</label>
                        <div>{{ employee.exit_date || '-' }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Status')}}</label>
                        <div>{{ employee.active ? trans('employee.Aktiv') : trans('employee.Inaktiv') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Steuernummer')}}</label>
                        <div>{{ employee.tax_id || '-' }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Steuerklasse')}}</label>
                        <div>{{ employee.tax_class || '-' }}</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.SV-Nr')}}</label>
                        <div>{{ employee.social_security_number || '-' }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Art der Krankenversicherung')}}</label>
                        <div v-if="employee.type_of_health_insurance == 'statutory'">{{trans('employee.Gesetzlich')}}</div>
                        <div v-if="employee.type_of_health_insurance == 'private'">{{trans('employee.Privat')}}</div>
                        <div v-if="!employee.type_of_health_insurance">-</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Krankenkasse')}}</label>
                        <div>{{ employee.health_insurance || '-' }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Beschäftigungsart')}}</label>
                        <div v-if="employee.occupation_type == 'full_time'">{{trans('employee.Vollzeit')}}</div>
                        <div v-if="employee.occupation_type == 'part_time'">{{trans('employee.Teilzeit')}}</div>
                        <div v-if="employee.occupation_type == 'temporary'">{{trans('employee.Geringfügig')}}</div>
                        <div v-if="! employee.occupation_type">-</div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('employee.Vereinbarte Arbeitszeit')}}</label>
                        <div>{{ employee.contractual_working_hours ? employee.contractual_working_hours + trans('admin.Stunden') : '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{trans('employee.Kontodaten')}}
                        <span class="pull-right"><i @click="editEmployee('bankAccount')" class="fa fa-pencil pointer"></i></span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>{{trans('employee.Kontoinhaber')}}</label>
                                    <div>{{ employee.account_holder || '-' }}</div>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('employee.Institut')}}</label>
                                    <div>{{ employee.institute || '-' }}</div>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('employee.IBAN')}}</label>
                                    <div>{{ employee.iban || '-' }}</div>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('employee.BIC')}}</label>
                                    <div>{{ employee.bic || '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{trans('employee.Adresse')}}
                        <span class="pull-right"><i @click="editEmployee('address')" class="fa fa-pencil pointer"></i></span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>{{trans('employee.Strasse')}}</label>
                                    <div>{{ employee.street || '-' }}</div>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('employee.PLZ')}}</label>
                                    <div>{{ employee.postal_code || '-' }}</div>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('employee.Stadt')}}</label>
                                    <div>{{ employee.city || '-' }}</div>
                                </div>
                            </div>
                        </div>
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
                employee: this.model
            }
        },
        props: ['model'],


        methods: {

            editEmployee(type) {
                let data = {
                    'employee': this.employee,
                    'type': type
                };

                modal('Edit Employee Modal', trans('admin.Mitarbeiter bearbeiten'), data);
            },

            reloadEmployee() {
                axios.get('/api/e/profile').then((response) =>
                    this.employee = response.data
                )
            }
        },

        created() {
            events.$on('employee.updated', this.reloadEmployee);
        }
    }
</script>
