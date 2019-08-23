<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">

                <div v-for="contact in contacts" class="row margin-b-10">
                    <div class="col-md-4">
                        {{ contact.first_name + ' ' + contact.last_name }}
                    </div>
                    <div class="col-md-8">
                        <label>{{trans('admin.Zuständigkeit')}}</label>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="1" v-model="contact.personnel_planning">
                            {{trans('admin.Personalplanung')}}
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="1" v-model="contact.accounting">
                            {{trans('admin.Finanzen')}}
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="1" v-model="contact.other">
                            {{trans('admin.Sonstiges')}}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <button @click="save" class="btn btn-success btn-md pull-right">{{trans('admin.Speichern')}}</button>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                contacts: JSON.parse(JSON.stringify(this.data.contacts))
            }
        },

        props: ['data'],

        methods: {

            save() {

                axios.post('/api/client/' + this.data.client.id + '/contacts/responsibilities', {contacts: this.contacts}).then(() => {
                    events.$emit('contacts.updated');

                    flash(trans('admin.Kontakte geändert'));

                    this.$parent.$emit('close')
                });

            }
        }

    }
</script>