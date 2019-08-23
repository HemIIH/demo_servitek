<template>
    <div>
        <div v-if="client.user_id">
            <p>{{trans('admin.Bereits ein Konto angelegt.')}}</p>
            <p>
                <strong>{{trans('admin.Email:')}}</strong> {{ client.user.email }}
            </p>
            <div class="pull-right">
                <a v-if="client.user.active" href="#" @click.prevent="deactivate" class="btn btn-danger btn-sm">{{trans('admin.Konto deaktivieren')}}</a>
                <a v-else href="#" @click.prevent="activate" class="btn btn-success btn-sm">{{trans('admin.Konto aktivieren')}}</a>
                <a href="#" @click.prevent="resend" class="btn btn-primary btn-sm">{{trans('admin.Passwort erneuern')}}</a>
            </div>
        </div>
        <div v-else>
            <form-wrapper :action="'/admin/client/' + client.id + '/account'" method="POST">
                <template name="form">
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label>{{trans('admin.Nutzername')}}</label>
                            <input class="form-control input-sm" name="name">
                        </div>
                        <div class="col-md-5 col-md-offset-1 form-group">
                            <label>{{trans('admin.E-Mail')}}</label>
                            <input class="form-control input-sm" name="email">
                        </div>
                    </div>
                    <input type="submit" :value="trans('admin.Konto anlegen')" class="btn btn-success btn-sm pull-right">
                </template>
            </form-wrapper>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                client: this.model
            }
        },
        props: ['model'],

        methods: {
            reloadClient() {
                axios.get('/api/client/' + this.client.id).then((response) => this.client = response.data)
            },

            activate() {
                axios.post('/api/account/' + this.client.user.id + '/activate').then(() => {
                    this.reloadClient();

                    flash('Konto aktiviert');
                })
            },

            deactivate() {
                axios.post('/api/account/' + this.client.user.id + '/deactivate').then(() => {
                    this.reloadClient();

                    flash('Konto deaktiviert');
                })
            },

            resend() {
                axios.post('/api/account/' + this.client.user.id + '/credentials/resend').then(() => flash('Mail verschickt.'))
            }
        },

        created() {
            this.$on('form.submitted', () => {
                this.reloadClient();

                flash('Konto angelegt');
            });
        }
    }
</script>
