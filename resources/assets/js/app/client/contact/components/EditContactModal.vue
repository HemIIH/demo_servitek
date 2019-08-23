<template>
    <form-wrapper :action="'/api/c/contact/' + contact.id">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Name')}}</label>
                            <div>{{ contact.last_name + ', ' + contact.first_name }}</div>
                        </div>
                    </div>

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
                contact: Object.assign({}, this.data.contact),
            }
        },
        props: ['data'],

        created() {
            this.$on('form.submitted', () => {
                events.$emit('contacts.updated');

                flash(trans('Kontakt erfolgreich geändert!'));

                this.$parent.$emit('close')
            })
        }
    }
</script>