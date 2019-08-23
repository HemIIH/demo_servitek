<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">{{trans('admin.Dokument hochladen')}}</h4>
        </div>
        <div class="panel-body">
            <form ref="form" enctype="multipart/form-data">
                <div class="form-group">
                    <file-upload name="file" @loaded="onLoad"></file-upload>
                </div>

                <div class="row">
                    <div class="col-md-10 form-group" :class="{'has-error': errors.name }">
                        <label>{{trans('admin.Name des Dokuments')}}</label>
                        <input class="form-control input-sm" name="name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group" :class="{'has-error': errors.valid_to }">
                        <label>{{trans('admin.Gültig bis')}}</label>
                        <datepicker name="valid_to"></datepicker>
                    </div>
                </div>

                <button v-if="! loading" @click.prevent="upload" class="btn btn-sm btn-primary pull-right">{{trans('admin.Hochladen')}}</button>
                <button v-else class="btn btn-sm btn-primary pull-right"><i class='fa fa-spinner fa-spin margin-r-10 margin-l-10'></i></button>
            </form>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                file: '',
                errors: [],
                loading: false
            }
        },

        components: {
            'FileUpload': require('../../../misc/components/FileUpload.vue')
        },

        props: ['url'],

        methods: {
            onLoad(file) {
                this.file = file.file;
            },

            upload() {
                this.loading = true;

                let data = new FormData(this.$refs.form);
                data.append('file', this.file);

                axios.post(this.url, data).then((response) => {
                    this.$refs.form.reset();
                    this.loading = false;

                    flash(trans('admin.Datei hochgeladen'));
                    events.$emit('document.uploaded');
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                    this.loading = false;

                    if (this.errors.file)
                        flash(this.errors.file[0], 'error');
                });
            }
        }
    }
</script>