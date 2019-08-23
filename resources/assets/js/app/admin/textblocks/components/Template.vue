<template>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-10">
                <legend>{{ trans('admin.'+template.title) }}</legend>
            </div>
            <div class="col-md-2"><i @click="edit" class="fa fa-pencil fa-lg pointer"></i></div>
        </div>
        <div class="row">
            <div class="col-md-9 col-md-offset-1 text-justify">
                <p v-html="template.text"></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                template: this.data
            }
        },

        props: ['data'],

        methods: {

            edit() {
                modal('Edit Template Modal', trans('admin.Dokument bearbeiten'), {template: this.template})
            },

            reloadTemplate() {
                axios.get('/api/document/get-by-name/' + this.template.name).then((response) =>
                    this.template = response.data
                )
            }

        },

        created() {
            events.$on('template.updated', this.reloadTemplate);
        }
    }
</script>