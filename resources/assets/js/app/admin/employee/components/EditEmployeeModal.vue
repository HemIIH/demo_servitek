<template>
    <form-wrapper :action="'/api/employee/' + employee.id + '/update'">
        <template slot-scope="form">
            <div v-if="data.type == 'personalData'" class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.date_of_birth }">
                            <label>{{trans('admin.Geburtstag')}}</label>
                            <datepicker name="date_of_birth" v-model="employee.date_of_birth"></datepicker>
                            <span v-if="form.errors.date_of_birth " class="help-block">{{ form.errors.date_of_birth }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.place_of_birth }">
                            <label>{{trans('admin.Geburtsort')}}</label>
                            <input class="form-control input-sm" name="place_of_birth" v-model="employee.place_of_birth">
                            <span v-if="form.errors.place_of_birth " class="help-block">{{ form.errors.place_of_birth }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.nationality }">
                            <label>{{trans('admin.Nationalität')}}</label>
                            <select class="form-control input-sm" name="nationality" v-model="employee.nationality">
                                <option value="">{{trans('admin.Auswählen')}}</option>
                                <option v-for="country in data.countries" :value="country.name">{{ country.name }}</option>
                            </select>
                            <span v-if="form.errors.nationality " class="help-block">{{ form.errors.nationality }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.religion }">
                            <label>{{trans('admin.Konfession/Religion')}}</label>
                            <input class="form-control input-sm" name="religion" v-model="employee.religion">
                            <span v-if="form.errors.religion " class="help-block">{{ form.errors.religion }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.disability }">
                            <label>{{trans('admin.Behinderung')}}</label>
                            <input class="form-control input-sm" name="disability" v-model="employee.disability">
                            <span v-if="form.errors.disability " class="help-block">{{ form.errors.disability }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.education_level }">
                            <label>{{trans('admin.Schulbildung')}}</label>
                            <input class="form-control input-sm" name="education_level" v-model="employee.education_level">
                            <span v-if="form.errors.education_level " class="help-block">{{ form.errors.education_level }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.children }">
                            <label>{{trans('admin.Zahl der Kinder')}}</label>
                            <input class="form-control input-sm" name="children" v-model="employee.children">
                            <span v-if="form.errors.children " class="help-block">{{ form.errors.children }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.married }">
                            <label>{{trans('admin.Familienstand')}}</label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="married" value="1" v-model="employee.married"> {{trans('admin.Verheiratet')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="married" value="0" v-model="employee.married"> {{trans('admin.Ledig')}}
                            </label>
                            <span v-if="form.errors.married " class="help-block">{{ form.errors.married }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="data.type == 'address'" class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.street }">
                            <label>{{trans('admin.Strasse')}}</label>
                            <input class="form-control input-sm" name="street" v-model="employee.street">
                            <span v-if="form.errors.street " class="help-block">{{ form.errors.street }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.postal_code }">
                            <label>{{trans('admin.Postleitzahl')}}</label>
                            <input class="form-control input-sm" name="postal_code" v-model="employee.postal_code">
                            <span v-if="form.errors.postal_code " class="help-block">{{ form.errors.postal_code }}</span>
                        </div>
                        <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.city }">
                            <label>{{trans('admin.Stadt')}}</label>
                            <input class="form-control input-sm" name="city" v-model="employee.city">
                            <span v-if="form.errors.city " class="help-block">{{ form.errors.city }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="data.type == 'bankAccount'" class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.account_holder }">
                            <label>{{trans('admin.Kontoinhaber')}}</label>
                            <input class="form-control input-sm" name="account_holder" v-model="employee.account_holder">
                            <span v-if="form.errors.account_holder " class="help-block">{{ form.errors.account_holder }}</span>
                        </div>
                        <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.institute }">
                            <label>{{trans('admin.Institut')}}</label>
                            <input class="form-control input-sm" name="institute" v-model="employee.institute">
                            <span v-if="form.errors.institute " class="help-block">{{ form.errors.institute }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.iban }">
                            <label>{{trans('admin.IBAN')}}</label>
                            <input class="form-control input-sm" name="iban" v-model="employee.iban">
                            <span v-if="form.errors.iban " class="help-block">{{ form.errors.iban }}</span>
                        </div>
                        <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.bic }">
                            <label>{{trans('admin.BIC')}}</label>
                            <input class="form-control input-sm" name="bic" v-model="employee.bic">
                            <span v-if="form.errors.bic " class="help-block">{{ form.errors.bic }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="data.type == 'contractData'" class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.entry_date }">
                            <label>{{trans('admin.Eintrittsdatum')}}</label>
                            <datepicker name="entry_date" v-model="employee.entry_date"></datepicker>
                            <span v-if="form.errors.entry_date " class="help-block">{{ form.errors.entry_date }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.exit_date }">
                            <label>{{trans('admin.Austrittsdatum')}}</label>
                            <datepicker name="exit_date" v-model="employee.exit_date"></datepicker>
                            <span v-if="form.errors.exit_date " class="help-block">{{ form.errors.exit_date }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.active }">
                            <label>{{trans('admin.Status')}}</label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="active" value="1" v-model="employee.active"> {{trans('admin.Aktiv')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="active" value="0" v-model="employee.active"> {{trans('admin.Inaktiv')}}
                            </label>
                            <span v-if="form.errors.active" class="help-block">{{ form.errors.active }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.applicant }">
                            <label>{{trans('admin.Bewerberstatus')}}</label>
                            <div class="checkbox margin-t-0">
                                <input type="hidden" name="applicant" value="0">
                                <label>
                                    <input type="checkbox" name="applicant" value="1" v-model="employee.applicant"> {{trans('admin.Bewerber')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.tax_id }">
                            <label>{{trans('admin.Steuernummer')}}</label>
                            <input class="form-control input-sm" name="tax_id" v-model="employee.tax_id">
                            <span v-if="form.errors.tax_id " class="help-block">{{ form.errors.tax_id }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.tax_class }">
                            <label>{{trans('admin.Steuerklasse')}}</label>
                            <input class="form-control input-sm" name="tax_class" v-model="employee.tax_class">
                            <span v-if="form.errors.tax_class " class="help-block">{{ form.errors.tax_class }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.social_security_number }">
                            <label>{{trans('admin.SV-Nr')}}</label>
                            <input class="form-control input-sm" name="social_security_number" v-model="employee.social_security_number">
                            <span v-if="form.errors.social_security_number " class="help-block">{{ form.errors.social_security_number }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.health_insurance }">
                            <label>{{trans('admin.Krankenkasse')}}</label>
                            <input class="form-control input-sm" name="health_insurance" v-model="employee.health_insurance">

                            <span v-if="form.errors.health_insurance " class="help-block">{{ form.errors.health_insurance }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.type_of_health_insurance }">
                            <label>{{trans('admin.Art der Krankenversicherung')}}</label>
                            <select class="form-control input-sm" name="type_of_health_insurance" v-model="employee.type_of_health_insurance">
                                <option value="">{{trans('admin.Auswählen')}}</option>
                                <option value="private">{{trans('admin.Privat')}}</option>
                                <option value="statutory">{{trans('admin.Gesetzlich')}}</option>
                            </select>
                            <span v-if="form.errors.type_of_health_insurance " class="help-block">{{ form.errors.type_of_health_insurance }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.occupation_type }">
                            <label>{{trans('admin.Beschäftigungsart')}}</label>
                            <select class="form-control input-sm" name="occupation_type" v-model="employee.occupation_type">
                                <option value="">{{trans('admin.Auswählen')}}</option>
                                <option value="full_time">{{trans('admin.Vollzeit')}}</option>
                                <option value="part_time">{{trans('admin.Teilzeit')}}</option>
                                <option value="temporary">{{trans('admin.Geringfügig')}}</option>
                            </select>
                            <span v-if="form.errors.occupation_type " class="help-block">{{ form.errors.occupation_type }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.contractual_working_hours }">
                            <label>{{trans('admin.Vertragliche Arbeitszeit')}}</label>
                            <input class="form-control input-sm" name="contractual_working_hours" v-model="employee.contractual_working_hours">
                            <span v-if="form.errors.contractual_working_hours " class="help-block">{{ form.errors.contractual_working_hours }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.working_time_account }">
                            <label>{{trans('admin.AZK - Startwert')}}</label>
                            <input class="form-control input-sm" name="working_time_account" v-model="employee.working_time_account">
                            <span v-if="form.errors.working_time_account " class="help-block">{{ form.errors.working_time_account }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <input type="submit" :value="trans('admin.Speichern')" class="btn btn-success btn-md pull-right">
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                employee: Object.assign({}, this.data.employee)
            }
        },
        props: ['data'],

        created() {
            this.$on('form.submitted', function () {
                events.$emit('employee.updated');

                flash(trans('admin.Mitarbeiter bearbeitet'));

                this.$parent.$emit('close')
            })
        }
    }
</script>