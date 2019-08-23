<template>
    <form-wrapper :action="'/api/document/' + template.name">
        <template slot-scope="form">

            <div class="form-group" :class="{'has-error': form.errors.body }">
                <label v-text="trans('admin.'+template.title)"></label>
                <html-editor name="body" :model="template.text" height="500"></html-editor>
                <span v-if="form.errors.body" class="help-block">{{ form.errors.body }}</span>
            </div>

            <submit-button class="pull-right btn-md btn-success" :text="trans('admin.Speichern')" :loading="form.loading"></submit-button>

        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                template: JSON.parse(JSON.stringify(this.data.template))
            }
        },

        props: ['data'],

        created() {
            this.$on('form.submitted', function () {
                events.$emit('template.updated');

                flash(trans('admin.Textbaustein erfolgreich bearbeitet'));

                this.$parent.$emit('close')
            })
        }
    }
</script>