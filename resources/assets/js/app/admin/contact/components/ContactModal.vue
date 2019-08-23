<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('admin.Name')}}</label>
                            <p>{{ (contact.sex == 'm' ? 'Herr ' : 'Frau ') + contact.first_name + ' ' + contact.last_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('admin.Kunde')}}</label>
                            <p>{{ data.client.name }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div v-if="contact.function" class="form-group">
                            <label>{{trans('admin.Funktion')}}</label>
                            <p>{{ contact.function }}</p>
                        </div>
                        <div class="form-group">
                            <label>{{trans('admin.Zuständigkeit')}}</label>
                            <div v-if="contact.personnel_planning">Personal</div>
                            <div v-if="contact.accounting">{{trans('admin.Finanzen/Buchhaltung')}}</div>
                            <div v-if="contact.other">{{trans('admin.Sonstiges')}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div v-if="contact.mobile" class="form-group">
                            <label>{{trans('admin.Mobil')}}</label>
                            <p>{{ contact.mobile }}</p>
                        </div>
                        <div v-if="contact.phone" class="form-group">
                            <label>{{trans('admin.Telefon')}}</label>
                            <p>{{ contact.phone }}</p>
                        </div>
                        <div v-if="contact.email" class="form-group">
                            <label>{{trans('admin.E-Mail')}}</label>
                            <p>{{ contact.email }}</p>
                        </div>
                        <div v-if="contact.fax" class="form-group">
                            <label>{{trans('admin.Fax')}}</label>
                            <p>{{ contact.fax }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div v-if="contact.information" class="row">
                    <div class="col-md-8">
                        <label>{{trans('admin.Zusätzliche Informationen')}}</label>
                        <p>{{ contact.information }}</p>
                    </div>
                </div>
            </div>
        </div>

        <button @click="edit" class="btn btn-success btn-md pull-right">{{trans('admin.Bearbeiten')}}</button>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                contact: Object.assign({}, this.data.contact),
            }
        },

        props: ['data'],

        methods: {

            edit() {
                let data = {
                    'client': this.data.client,
                    'contact': this.data.contact,
                    'buttonText': trans('admin.Speichern'),
                    'type': 'edit'
                };

                modal('Contact Form Modal', trans('admin.Kontakt bearbeiten') ,data)
            }
        }

    }
</script>