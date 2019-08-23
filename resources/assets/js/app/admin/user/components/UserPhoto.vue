<template>
    <div>
        <img v-if="photo" @click="deletePhoto" class="profile-user-img img-responsive img-circle pointer" :src="photo" :alt="trans('admin.Profilbild')" :title="trans('admin.Profilbild löschen')" style="width:50px;">
        <div v-else>
            <img @click="showUploadForm" class="profile-user-img img-responsive img-circle pointer" src="/assets/img/unknown.gif" :alt="trans('admin.Profilbild')" style="width:50px;">
            <form class="hidden" id="uploadUserPhoto" enctype="multipart/form-data">
                <file-upload name="photo" accept="image/*" @loaded="onLoad"></file-upload>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'photo': this.user.photo ? '/uploads/images/photos/user/' + this.user.photo : ''
            }
        },

        props: ['user'],

        components: {
            'FileUpload': require('../../../misc/components/FileUpload.vue')
        },

        methods: {

            showUploadForm: function () {
                $('#uploadUserPhoto input').click();
            },

            onLoad(photo) {
                let data = new FormData();
                data.append('photo', photo.file);

                axios.post('/api/user/' + this.user.id + '/photo/upload', data).then(() => {
                    this.photo = photo.src;

                    flash(trans('admin.Foto hochgeladen'))
                }).catch((error) => {
                    this.errors = error.response.data;

                    flash(this.form.errors.photo[0], 'error');
                });
            },

            deletePhoto() {
                swal({title: trans('admin.Profilbild löschen?')}).then(() => {
                    axios.post('/api/user/' + this.user.id + '/photo/delete', this.user).then(() => {
                        flash(trans('admin.Profilbild gelöscht'), 'success');

                        this.photo = null;
                    });
                });
            }
        }
    }
</script>
