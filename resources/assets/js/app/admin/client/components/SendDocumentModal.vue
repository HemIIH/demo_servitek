<template>
    <form-wrapper :action="'/api/' + data.type + '/' + data.id + '/document/' + data.document.id + '/send'">
        <div v-if="textblock.subject && textblock.mail_body" class="row">
            <div class="col-md-6 form-group">
                <label>{{trans('admin.An')}}</label>
                <select name="email" class="form-control input-sm">
                    <option value="">{{trans('admin.Kontakt auswählen')}}</option>
                    <option v-for="contact in contacts" :value="contact.email">{{ contact.last_name + ' - ' + contact.email }}</option>
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label>{{trans('admin.Betreff')}}</label>
                <input class="form-control input-sm" name="subject" :value="textblock.subject.value">
            </div>
            <div class="col-md-12">
                <html-editor name="body" :model="textblock.mail_body.value"></html-editor>
            </div>
        </div>
        <p>{{trans('admin.Angehängtes Dokument')}}: {{ data.document.name }}</p>
        <div class="pull-right">
            <button type="text" class="btn btn-primary">{{trans('admin.Senden')}}</button>
            <button @click="$parent.$emit('close')" class="btn btn-default">{{trans('admin.Schliessen')}}</button>
        </div>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                'contacts': '',
                'textblock': {}
            }
        },
        props: ['data'],

        created() {

            axios.get('/api/client/' + this.data.id +'/contacts').then((response) => this.contacts = response.data );

            axios.get('/api/textblocks/get-by-type/document').then((response) => this.textblock = response.data );

            this.$on('form.submitted', () => {
                flash('Mail verschickt');

                this.$parent.$emit('close');
            })

        }
    }
</script>

