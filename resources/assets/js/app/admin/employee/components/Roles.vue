<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.Rollen')}}</h3>
            <div class="pull-right">
                <i v-if="! editMode" @click="editMode = true" class="fa fa-pencil fa-lg pointer"></i>
                <i v-if="editMode" @click="save" class="fa fa-save fa-lg pointer"></i>
            </div>
        </div>
        <div class="box-body">

            <ul v-if="! editMode" class="list-group">
                <li v-for="role in roles" v-show="selectedRoles.indexOf(role.id) > -1" class="list-group-item">
                    {{ trans('admin.'+role.name) + ' (' + role.shortcut + ')' }}
                </li>
            </ul>

            <div v-else v-for="role in roles" class="checkbox">
                <label>
                    <input type="checkbox" v-model="selectedRoles" :value="role.id"> {{ trans('admin.'+role.name) }}
                </label>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                editMode: false,
                errors: {},
                roles: {},
                selectedRoles: []
            }
        },
        props: ['employee'],
        methods: {
            save: function () {

                let data = {
                    'roles': this.selectedRoles
                };

                axios.post('/api/employee/' + this.employee.id + '/roles/update', data).then(() => {
                    this.errors = '';

                    this.editMode = false;
                }).catch((error) => this.errors = error.response.data);
            }
        },

        mounted: function() {
            axios.get('/api/roles').then((response) =>
                this.roles = response.data
            );

            this.selectedRoles = this.employee.roles.map((item) => item['id'] );
        }
    }
</script>
