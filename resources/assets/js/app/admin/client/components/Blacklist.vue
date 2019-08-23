<template>
    <div class="box box-primary collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.Gesperrte Mitarbeiter')}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-9 form-group">
                    <select class="form-control input-sm" v-model="employeeId">
                        <option value="">{{trans('admin.Bitte auswählen')}}</option>
                        <option v-for="employee in employees" :value="employee.id">{{ employee.last_name + ', ' + employee.first_name }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <span class="pull-right btn" @click="addToBlacklist"><i class="fa fa-plus"></i></span>
                </div>
            </div>

            <br>

            <ul v-if="blocked.length" class="list-group">
                <li v-for="blockedEmployee in blocked" class="list-group-item">
                    {{ blockedEmployee.last_name + ', ' + blockedEmployee.first_name }}
                    <a class="pull-right" @click.prevent="removeFromBlacklist(blockedEmployee.id)"><i class="fa fa-close text-danger"></i></a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                blocked: [],
                employees: [],
                employeeId: ''
            }
        },
        props: ['client'],

        methods: {

            getEmployees() {
                axios.get('/api/client/' + this.client.id +  '/blockedEmployees').then((response) => {
                    this.employees = response.data.employees;
                    this.blocked = response.data.blocked;
                });
            },

            addToBlacklist() {
                axios.get('/api/client/' + this.client.id +  '/blacklist/add?employee=' + this.employeeId).then(() => {
                    this.getEmployees();

                    this.employeeId = '';
                });
            },

            removeFromBlacklist(id) {
                axios.get('/api/client/' + this.client.id +  '/blacklist/remove?employee=' + id).then(() =>
                    this.getEmployees()
                );
            }
        },

        created() {
            this.getEmployees();
        }
    }
</script>
