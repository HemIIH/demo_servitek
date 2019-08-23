<template>
    <div class="box box-primary">
        <div class="box-body box-profile">
            <div class="pull-left">
                <i v-if="data.active" class="fa fa-circle fa-2x text-success"></i>
                <i v-else class="fa fa-circle fa-2x text-danger"></i>
            </div>

            <div class="pull-right">
                <div v-if="! editMode">
                    <i @click="editMode = true" class="fa fa-pencil fa-lg pointer"></i>
                </div>
                <div v-else>
                    <i @click="save" class="fa fa-save fa-lg pointer margin-r-5"></i>
                    <i @click="abort" class="fa fa-times fa-lg text-danger pointer"></i>
                </div>
            </div>

            <h4 class="text-center clearfix">{{trans('admin.Kundennr')}} {{ client.id }}</h4>

            <client-logo :client="client"></client-logo>

            <h3 v-if="! editMode" class="profile-username text-center">{{ data.name }}</h3>

            <div v-else class="row">
                <div class="col-sm-6">
                    <div class="form-group" :class="{'has-error': errors.name}">
                        <label>{{trans('admin.Name')}}</label>
                        <i v-if="errors.name" class="fa fa-exclamation-triangle text-danger" :title="errors.name[0]"></i>
                        <input class="form-control input-sm" v-model="input.name">
                    </div>
                </div>
            </div>

            <p class="text-center"><b>{{trans('admin.Status:')}}</b> {{ data.active ? trans('admin.Aktiv') : trans('admin.Inaktiv') }}</p>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>{{trans('admin.Vertragsart')}}</b> <span class="pull-right">{{ data.type_of_contract ? data.type_of_contract : '-' }}</span>
                </li>
                <li v-if="data.locations" class="list-group-item">
                    <b>{{trans('admin.Standorte')}}</b> <span class="pull-right">{{ data.locations.replace(/["\[\]]/g, '') }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: {},
                editMode: false,

                data: Object.assign({}, this.client),
                input: Object.assign({}, this.client)
            }
        },
        props: ['client'],
        components: {
            'ClientLogo': require('./Logo.vue')
        },
        methods: {
            save: function () {
                let data = {
                    'name': this.input.name,
                }

                axios.post('/api/client/' + this.client.id + '/update', data).then((response) => {
                    this.errors = '';
                    this.editMode = false;

                    this.data = response.data;

                    events.$emit('client.updated');
                }).catch((error) => this.errors = error.response.data);
            },


            abort() {
                this.editMode = false;
                this.errors = '';

                Object.assign(this.input, this.data)
            },

            reloadClient() {
                axios.get('/api/client/' + this.client.id).then((response) =>
                    this.data = response.data
                )
            }
        },

        mounted() {
            events.$on('client.updated', this.reloadClient);
        }
    }
</script>
