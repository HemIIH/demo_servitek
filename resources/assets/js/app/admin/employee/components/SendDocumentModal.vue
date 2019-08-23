<template>
    <form-wrapper :action="'/api/employee/' + data.employee.id + '/document/' + data.document.id + '/send'">
        <div v-if="textblock.subject && textblock.mail_body" class="row">
            <input type="hidden" name="email" :value="data.employee.email">
            <div class="col-md-4 form-group">
                <label>{{trans('admin.Betreff')}}</label>
                <input class="form-control input-sm" name="subject" :value="textblock.subject.value">
            </div>
            <div class="col-md-12 form-group">
                <html-editor name="body" :model="textblock.mail_body.value"></html-editor>
            </div>
        </div>
        <p>{{trans('admin.Angehängtes Dokument')}}: {{ data.document.name }}</p>
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">{{trans('admin.Senden')}}</button>
            <button @click.prevent="$parent.$emit('close')" class="btn btn-default">{{trans('admin.Schliessen')}}</button>
        </div>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                'textblock': {}
            }
        },
        props: ['data'],

        created() {

            axios.get('/api/textblocks/get-by-type/document').then((response) => {
                this.textblock = response.data
            });

            this.$on('form.submitted', () => {
                flash(trans('admin.Mail verschickt'));

                this.$parent.$emit('close');
            })

        }
    }
</script>

