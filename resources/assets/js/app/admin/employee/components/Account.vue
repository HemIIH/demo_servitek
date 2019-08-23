<template>
    <div>
        <div v-if="employee.user_id">
            <p>{{trans('admin.Bereits ein Konto angelegt')}}</p>
            <p>
                <strong>{{trans('admin.Email')}}:</strong> {{ employee.user.email }}
            </p>
            <div class="pull-right">
                <a v-if="employee.user.active" href="#" @click.prevent="deactivate" class="btn btn-danger btn-sm">{{trans('admin.Konto deaktivieren')}}</a>
                <a v-else href="#" @click.prevent="activate" class="btn btn-success btn-sm">{{trans('admin.Konto aktivieren')}}</a>
                <form-wrapper class="pull-right margin-l-5" :action="'/api/account/' + employee.user.id + '/credentials/resend'">
                    <template slot-scope="form">
                        <submit-button class="btn btn-primary btn-sm" :text="trans('admin.Passwort erneuern')" :loading="form.loading"></submit-button>
                    </template>
                </form-wrapper>
            </div>
        </div>
        <form-wrapper v-else :action="'/admin/employee/' + employee.id + '/account'">
            <template slot-scope="form">
                <input type="hidden" name="name" :value="employee.last_name + '' + employee.first_name">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('admin.Nutzer')}}</label>
                        <input class="form-control input-sm" name="email" :value="employee.email" readonly>
                    </div>
                </div>
                <submit-button class="btn-sm btn-success pull-right" :text="trans('admin.Konto anlegen')" :loading="form.loading"></submit-button>
            </template>
        </form-wrapper>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                employee: this.model
            }
        },

        props: ['model'],

        methods: {
            reloadEmployee() {
                axios.get('/api/employee/' + this.employee.id).then((response) =>
                        this.employee = response.data
                )
            },

            activate() {
                axios.post('/api/account/' + this.employee.user.id + '/activate').then(() => {
                    this.reloadEmployee();

                    flash(trans('admin.Konto aktiviert'));
                })
            },

            deactivate() {
                axios.post('/api/account/' + this.employee.user.id + '/deactivate').then(() => {
                    this.reloadEmployee();

                    flash(trans('admin.Konto deaktiviert'));
                })
            }
        },

        created() {
            this.$on('form.submitted', () => {
                this.reloadEmployee();

                flash(trans('admin.Kontodaten verschickt'));
            });
        }
    }
</script>
