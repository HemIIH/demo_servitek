<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.Details')}}</h3>
            <div class="pull-right">
                <div v-if="! editMode">
                    <i @click="editMode = true" class="fa fa-pencil fa-lg pointer"></i>
                </div>
                <div v-else>
                    <i @click="save" class="fa fa-save fa-lg pointer margin-r-5"></i>
                    <i @click="abort" class="fa fa-times fa-lg text-danger pointer"></i>
                </div>
            </div>
        </div>
        <div class="box-body">
            <strong><i class="fa fa-map-marker margin-r-5"></i> {{trans('admin.Adresse')}}</strong>

            <p v-if="! editMode" class="text-muted">
                {{ data.street }}<br>
                {{ data.postal_code }} {{ data.city }}
            </p>

            <div v-else class="row">
                <br>
                <div class="col-md-6 form-group" :class="{'has-error': errors.street }">
                    <label>{{trans('admin.Straße')}}</label>
                    <i v-if="errors.street" class="fa fa-exclamation-triangle text-danger" :title="errors.street[0]"></i>
                    <input class="form-control input-sm" v-model="input.street">
                </div>
                <div class="col-md-6 form-group" :class="{'has-error': errors.postal_code }">
                    <label>{{trans('admin.PLZ')}}</label>
                    <i v-if="errors.postal_code" class="fa fa-exclamation-triangle text-danger" :title="errors.postal_code[0]"></i>
                    <input class="form-control input-sm" v-model="input.postal_code">
                </div>
                <div class="col-md-6 form-group" :class="{'has-error': errors.city }">
                    <label>{{trans('admin.Stadt')}}</label>
                    <i v-if="errors.city" class="fa fa-exclamation-triangle text-danger" :title="errors.city[0]"></i>
                    <input class="form-control input-sm" v-model="input.city">
                </div>
            </div>

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
        methods: {

            save() {
                let data = {
                    'street': this.input.street,
                    'postal_code': this.input.postal_code,
                    'city': this.input.city
                }

                axios.post('/api/client/' + this.client.id + '/update', data).then((response) => {
                    this.editMode = false;
                    this.errors = '';

                    this.data = response.data;
                }).catch((error) => this.errors = error.response.data.errors);
            },

            abort() {
                this.editMode = false;
                this.errors = '';

                Object.assign(this.input, this.data)
            }
        }
    }
</script>
