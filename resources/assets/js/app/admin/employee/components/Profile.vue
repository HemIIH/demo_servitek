<template>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Persönliche Daten')}}
                    <span v-if="canUpdate" class="pull-right"><i @click="editEmployee('personalData')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Geburtsdatum')}}</label>
                            <div>{{ employee.date_of_birth }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Geburtsort')}}</label>
                            <div>{{ employee.place_of_birth || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Nationalität')}}</label>
                            <div>{{ employee.nationality || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Konfession/Religion')}}</label>
                            <div>{{ employee.religion || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Behinderung')}}</label>
                            <div>{{ employee.disability || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Schulbildung')}}</label>
                            <div>{{ employee.education_level || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Zahl der Kinder')}}</label>
                            <div>{{ employee.children || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Familienstand')}}</label>
                            <div>{{ employee.married ? trans('admin.Verheiratet') : trans('Ledig') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Vertragsdaten')}}
                    <span v-if="canUpdate" class="pull-right"><i @click="editEmployee('contractData')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Status')}}</label>
                            <div>{{ employee.active ? trans('admin.Aktiv') : trans('admin.Inaktiv') }}</div>
                        </div>
                        <div v-if="employee.applicant" class="col-md-4 form-group">
                            <label>{{trans('admin.Bewerber')}}</label>
                            <div><i class="fa fa-check text-success"></i></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Eintrittsdatum')}}</label>
                            <div>{{ employee.entry_date }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Austrittsdatum')}}</label>
                            <div>{{ employee.exit_date || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Steuernummer')}}</label>
                            <div>{{ employee.tax_id || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Steuerklasse')}}</label>
                            <div>{{ employee.tax_class || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.SV Nr')}}</label>
                            <div>{{ employee.social_security_number || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Art der Krankenversicherung')}}</label>
                            <div v-if="employee.type_of_health_insurance == 'statutory'">{{trans('admin.Gesetzlich')}}</div>
                            <div v-if="employee.type_of_health_insurance == 'private'">{{trans('admin.Privat')}}</div>
                            <div v-if="! employee.type_of_health_insurance">-</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Krankenkasse')}}</label>
                            <div>{{ employee.health_insurance || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Beschäftigungsart')}}</label>
                            <div v-if="employee.occupation_type == 'full_time'">{{trans('admin.Vollzeit')}}</div>
                            <div v-if="employee.occupation_type == 'part_time'">{{trans('admin.Teilzeit')}}</div>
                            <div v-if="employee.occupation_type == 'temporary'">{{trans('admin.Geringfügig')}}</div>
                            <div v-if="! employee.occupation_type">-</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Vereinbarte Arbeitszeit')}}</label>
                            <div>{{ employee.contractual_working_hours || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.AZK-Startwert')}}</label>
                            <div>{{ employee.working_time_account || '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Adresse')}}
                    <span v-if="canUpdate" class="pull-right"><i @click="editEmployee('address')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label>{{trans('admin.Strasse')}}</label>
                            <div>{{ employee.street || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.PLZ')}}</label>
                            <div>{{ employee.postal_code || '-' }}</div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Stadt')}}</label>
                            <div>{{ employee.city || '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Kontodaten')}}
                    <span v-if="canUpdate" class="pull-right"><i @click="editEmployee('bankAccount')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{trans('admin.Kontoinhaber')}}</label>
                        <div>{{ employee.account_holder || '-' }}</div>
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin.Institut')}}</label>
                        <div>{{ employee.institute || '-' }}</div>
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin.IBAN')}}</label>
                        <div>{{ employee.iban || '-' }}</div>
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin.BIC')}}</label>
                        <div>{{ employee.bic || '-' }}</div>
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

        props: ['model', 'countries', 'canUpdate'],

        methods: {

            editEmployee(type) {
                let data = {
                    'employee': this.employee,
                    'countries': this.countries,
                    'type': type
                };

                modal('Edit Employee Modal', trans('admin.Mitarbeiter bearbeiten'), data);
            },

            reloadEmployee() {
                axios.get('/api/employee/' + this.employee.id).then((response) =>
                    this.employee = response.data
                )
            }
        },

        created() {
            events.$on('employee.updated', this.reloadEmployee);
        }
    }
</script>
