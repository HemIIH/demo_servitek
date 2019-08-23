<template>
    <form-wrapper :action="action">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.first_name }">
                            <label>{{trans('admin.Vorname')}}</label>
                            <input class="form-control input-sm" name="first_name" v-model="contact.first_name">
                            <span v-if="form.errors.first_name" class="help-block">{{ form.errors.first_name }}</span>
                        </div>
                        <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.last_name }">
                            <label>{{trans('admin.Nachname')}}</label>
                            <input class="form-control input-sm" name="last_name" v-model="contact.last_name">
                            <span v-if="form.errors.last_name" class="help-block">{{ form.errors.last_name }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.sex }">
                            <label>{{trans('admin.Geschlecht')}}</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="sex" value="m" v-model="contact.sex">
                                {{trans('admin.Männlich')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" value="f" v-model="contact.sex">
                                {{trans('admin.Weiblich')}}
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.mobile }">
                            <label>{{trans('admin.Mobil')}}</label>
                            <input class="form-control input-sm" name="mobile" v-model="contact.mobile">
                            <span v-if="form.errors.mobile" class="help-block">{{ form.errors.mobile }}</span>
                        </div>
                        <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.phone }">
                            <label>{{trans('admin.Telefon')}}</label>
                            <input class="form-control input-sm" name="phone" v-model="contact.phone">
                            <span v-if="form.errors.phone" class="help-block">{{ form.errors.phone }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.email }">
                            <label>{{trans('admin.E-Mail')}}</label>
                            <input class="form-control input-sm" name="email" v-model="contact.email">
                            <span v-if="form.errors.email" class="help-block">{{ form.errors.email }}</span>
                        </div>
                        <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.fax }">
                            <label>{{trans('admin.Fax')}}</label>
                            <input class="form-control input-sm" name="fax" v-model="contact.fax">
                            <span v-if="form.errors.fax" class="help-block">{{ form.errors.fax }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.function }">
                            <label>{{trans('admin.Funktion')}}</label>
                            <input class="form-control input-sm" name="function" v-model="contact.function">
                            <span v-if="form.errors.function" class="help-block">{{ form.errors.function }}</span>
                        </div>
                        <div class="col-md-6 col-md-offset-1 form-group">
                            <label>{{trans('admin.Zuständigkeit')}}</label>
                            <div class="checkbox" :class="{'has-error': form.errors.personnel_planning }">
                                <label>
                                    <input type="checkbox" value="1" name="personnel_planning" v-model="contact.personnel_planning">
                                    {{trans('admin.Personalplanung')}}
                                </label>
                            </div>
                            <div class="checkbox" :class="{'has-error': form.errors.accounting }">
                                <label>
                                    <input type="checkbox" value="1" name="accounting" v-model="contact.accounting">
                                    {{trans('admin.Finanzen/Buchhaltung')}}
                                </label>
                            </div>
                            <div class="checkbox" :class="{'has-error': form.errors.other }">
                                <label>
                                    <input type="checkbox" value="1" name="other" v-model="contact.other">
                                    {{trans('admin.Sonstiges')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>{{trans('admin.Zusätzliche Informationen')}}</label>
                        <textarea class="form-control input-sm" name="information" cols="30" rows="3">{{ contact.information }}</textarea>
                    </div>
                </div>

            </div>

            <submit-button class="pull-right btn-md btn-success" :text="data.buttonText" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                contact: Object.assign({}, this.data.contact),
            }
        },
        props: ['data'],

        computed: {
            action() {
                if (this.data.type == 'create') {
                    return '/api/client/' + this.data.client.id + '/contact'
                }

                if (this.data.type == 'edit') {
                    return '/api/client/contact/' + this.data.contact.id + '/update'
                }
            }
        },

        created() {
            this.$on('form.submitted', () => {
                events.$emit('contacts.updated');

                if (this.data.type == 'create') {
                    flash(trans('admin.Neuen Kontakt angelegt!'));
                }

                if (this.data.type == 'edit') {
                    flash(trans('admin.Kontakt erfolgreich geändert!'));
                }

                this.$parent.$emit('close')
            })
        }
    }
</script>