<template>
    <div>
        <img v-if="photo" @click="deletePhoto" class="profile-user-img img-responsive img-circle pointer" :src="photo" alt="Profilbild" title="Profilbild löschen">
        <div v-else>
            <img @click="showUploadForm" class="profile-user-img img-responsive img-circle pointer" src="/assets/img/unknown.gif" alt="Profilbild">
            <form class="hidden" id="uploadEmployeePhoto" enctype="multipart/form-data">
                <file-upload name="photo" accept="image/*" @loaded="onLoad"></file-upload>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'photo': this.employee.photo ? '/uploads/images/photos/employees/' + this.employee.photo : ''
            }
        },

        props: ['employee'],

        components: {
            'FileUpload': require('../../../misc/components/FileUpload.vue')
        },

        methods: {
            showUploadForm() {
                $('#uploadEmployeePhoto input').click();
            },

            onLoad(photo) {
                let data = new FormData();
                data.append('photo', photo.file);

                axios.post('/api/employee/' + this.employee.id + '/photo/upload', data).then(() => {
                    this.photo = photo.src;

                    flash('admin.Foto hochgeladen')
                }).catch((error) => {
                    this.errors = error.response.data;

                    flash(this.form.errors.photo[0], 'error');
                });
            },

            deletePhoto() {
                swal({title: trans('admin.Profilbild löschen?')}).then(() => {
                    axios.post('/api/employee/' + this.employee.id + '/photo/delete', this.employee).then(() => {
                        flash(trans('admin.Profilbild gelöscht'));

                        this.photo = null;
                    });
                });
            }
        }
    }
</script>
