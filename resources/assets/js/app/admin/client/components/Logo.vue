<template>
    <div>
        <img v-if="logo" @click="deleteLogo" class="profile-user-img img-responsive pointer" :src="logo" alt="Profilbild" title="Logo löschen" style="border: none; !important">
        <div v-else>
            <img @click="showUploadForm" class="profile-user-img img-responsive pointer" src="/assets/img/company.svg" alt="Profilbild" style="border: none; !important">
            <form class="hidden" id="uploadClientLogo" enctype="multipart/form-data">
                <file-upload name="logo" accept="image/*" @loaded="onLoad"></file-upload>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'logo': this.client.logo ? '/uploads/images/logos/' +  this.client.logo : ''
            }
        },
        props: ['client'],

        components: {
            'FileUpload': require('../../../misc/components/FileUpload.vue')
        },

        methods: {
            showUploadForm() {
                $('#uploadClientLogo input').click();
            },

            onLoad(logo) {

                let data = new FormData();
                data.append('logo', logo.file);

                axios.post('/api/client/' + this.client.id + '/logo/upload', data).then((response) => {
                    this.logo = logo.src;

                    flash('Logo hochgeladen.')
                }).catch((error) => {
                    this.errors = error.response.data;

                    flash(this.errors.logo[0], 'error');
                });

            },

            deleteLogo() {

                swal({title: 'Logo löschen?'}).then(() => {
                    axios.post('/api/client/' + this.client.id + '/logo/delete', this.client).then(() => {
                        flash('Profilbild gelöscht', 'success');

                        this.logo = null;
                    });
                });
            }
        }
    }
</script>
