<template>
    <form-wrapper :action="type == 'create' ? '/api/client/store' : '/api/client/' + client.id + '/update'">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Stammdaten')}}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div v-if="type == 'create'" class="col-md-6 form-group" :class="{'has-error': form.errors.logo }">
                            <label>{{trans('admin.Firmenlogo')}}</label>
                            <input type="file" name="logo">
                            <span v-if="form.errors.logo" class="help-block">{{ form.errors.logo }}</span>
                        </div>
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.active }">
                            <label>{{trans('admin.Status')}}</label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="active" value="1" v-model="client.active"> {{trans('admin.Aktiv')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="active" value="0" v-model="client.active"> {{trans('admin.Inaktiv')}}
                            </label>
                            <span v-if="form.errors.active" class="help-block">{{ form.errors.active }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.name }">
                            <label>{{trans('admin.Firmenname')}}</label>
                            <input class="form-control input-sm" name="name" v-model="client.name">
                            <span v-if="form.errors.name" class="help-block">{{ form.errors.name }}</span>
                        </div>
                        <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.short_name }">
                            <label>{{trans('admin.Firmenname (Kurzform)')}}</label>
                            <input class="form-control input-sm" name="short_name" v-model="client.short_name">
                            <span v-if="form.errors.short_name" class="help-block">{{ form.errors.short_name }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.type_of_contract }">
                            <label>{{trans('admin.Vertragsart')}}</label>
                            <input class="form-control input-sm" name="type_of_contract" v-model="client.type_of_contract">
                            <span v-if="form.errors.type_of_contract" class="help-block">{{ form.errors.type_of_contract }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Adresse
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.street }">
                            <label>{{trans('admin.Strasse')}}</label>
                            <input class="form-control input-sm" name="street" v-model="client.street">
                            <span v-if="form.errors.street" class="help-block">{{ form.errors.street }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.postal_code }">
                            <label>{{trans('admin.Postleitzahl')}}</label>
                            <input class="form-control input-sm" name="postal_code" v-model="client.postal_code">
                            <span v-if="form.errors.postal_code" class="help-block">{{ form.errors.postal_code }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.city }">
                            <label>{{trans('admin.Stadt')}}</label>
                            <input class="form-control input-sm" name="city" v-model="client.city">
                            <span v-if="form.errors.city" class="help-block">{{ form.errors.city }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Standort')}}</label>
                            <select name="location" class="form-control input-sm" v-model="client.location">
                                <option value="">{{trans('admin.Auswählen')}}</option>
                                <option v-for="location in locations" :value="location.name">{{trans('admin.'+ location.name) }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Kontodaten')}}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.iban }">
                            <label>{{trans('admin.IBAN')}}</label>
                            <input class="form-control input-sm" name="iban" v-model="client.iban">
                            <span v-if="form.errors.iban" class="help-block">{{ form.errors.iban }}</span>
                        </div>
                        <div class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.bic }">
                            <label>{{trans('admin.BIC')}}</label>
                            <input class="form-control input-sm" name="bic" v-model="client.bic">
                            <span v-if="form.errors.bic" class="help-block">{{ form.errors.bic }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.vat }">
                            <label>{{trans('admin.Steuernummer')}}</label>
                            <input class="form-control input-sm" name="vat" v-model="client.vat">
                            <span v-if="form.errors.vat" class="help-block">{{ form.errors.vat }}</span>
                        </div>
                        <div v-if="type == 'create'" class="col-md-5 col-md-offset-1 form-group" :class="{'has-error': form.errors.rate }">
                            <label>{{trans('admin.Verrechnungssatz')}}</label>
                            <input class="form-control input-sm" name="rate"
                            <span v-if="form.errors.rate" class="help-block">{{ form.errors.rate }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <submit-button class="pull-right btn-sm btn-success" :text="type == 'create' ? trans('admin.Anlegen') : trans('admin.Speichern')" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                locations: []
            }
        },
        props: ['client', 'type'],

        created() {
            axios.get('/api/settings/locations').then((response) => this.locations = response.data);

            this.$on('form.submitted', () => this.$parent.$emit('form.submitted'))
        }
    }
</script>