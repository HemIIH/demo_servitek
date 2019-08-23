<template>
    <form-wrapper :action="'/api/client/' + data.client.id + '/invoice-data'">
        <template slot-scope="form">
            <div v-if="data.type == 'invoiceData'" class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.name}">
                            <label>{{trans('admin.Name')}}</label>
                            <input name="name" class="form-control input-sm" v-model="invoiceData.name">
                            <span v-if="form.errors.name" class="help-block">{{ form.errors.name }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.street}">
                            <label>{{trans('admin.Strasse')}}</label>
                            <input name="street" class="form-control input-sm" v-model="invoiceData.street">
                            <span v-if="form.errors.street" class="help-block">{{ form.errors.street }}</span>
                        </div>

                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.address_addition}">
                            <label>{{trans('admin.Adresse - Zusatz')}}</label>
                            <input name="address_addition" class="form-control input-sm" v-model="invoiceData.address_addition">
                            <span v-if="form.errors.address_addition" class="help-block">{{ form.errors.address_addition }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.postal_code}">
                            <label>{{trans('admin.Postleitzahl')}}</label>
                            <input name="postal_code" class="form-control input-sm" v-model="invoiceData.postal_code">
                            <span v-if="form.errors.postal_code" class="help-block">{{ form.errors.postal_code }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.city}">
                            <label>{{trans('admin.Stadt')}}</label>
                            <input name="city" class="form-control input-sm" v-model="invoiceData.city">
                            <span v-if="form.errors.city" class="help-block">{{ form.errors.city }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.country}">
                            <label>{{trans('admin.Land')}}</label>
                            <input name="country" class="form-control input-sm" v-model="invoiceData.country">
                            <span v-if="form.errors.country" class="help-block">{{ form.errors.country }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="data.type == 'invoiceTexts'" class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 form-group" :class="{'has-error': form.errors.intro}">
                            <label>{{trans('admin.Einleitungstext')}}</label>
                            <html-editor name="intro" :model="invoiceData.intro"></html-editor>
                            <span v-if="form.errors.intro" class="help-block">{{ form.errors.intro }}</span>
                        </div>
                        <div class="col-md-10 form-group" :class="{'has-error': form.errors.outro}">
                            <label>{{trans('admin.Schlusstext')}}</label>
                            <html-editor name="outro" :model="invoiceData.outro"></html-editor>
                            <span v-if="form.errors.outro" class="help-block">{{ form.errors.outro }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.payment_period}">
                            <label>{{trans('admin.Zahlungsfrist')}}</label>
                            <input name="payment_period" class="form-control input-sm" v-model="invoiceData.payment_period">
                            <span v-if="form.errors.payment_period" class="help-block">{{ form.errors.payment_period }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.default_tax_rate}">
                            <label>{{trans('admin.Umsatzsteuer')}}</label>
                            <select name="default_tax_rate" class="form-control input-sm" v-model="invoiceData.default_tax_rate">
                                <option value="0">0 %</option>
                                <option value="7">7 %</option>
                                <option value="19">19 %</option>
                            </select>
                            <span v-if="form.errors.default_tax_rate" class="help-block">{{ form.errors.default_tax_rate }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <submit-button class="pull-right btn-sm btn-success" :text="trans('admin.Speichern')" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>

</template>

<script>
    export default {
        data() {
            return {
                invoiceData: Object.assign({}, this.data.invoiceData),
            }
        },
        props: ['data'],

        created() {

            this.$on('form.submitted', () => {
                events.$emit('invoiceData.updated');

                flash(trans('admin.Daten erfolgreich bearbeitet'));

                this.$parent.$emit('close')
            })
        }
    }
</script>