<template>
    <div class="row">
        <div class="col-md-4 form-group">
            <label>{{trans('admin.Zu Mitarbeiter wechseln')}}</label>
            <br>
            <select class="form-control input-sm" @change="select" v-model="employeeSelected">
                <option value="">{{trans('admin.Auswählen')}}</option>
                <option v-for="employee in filteredEmployees" :value="employee.id">{{ employee.id + ' - ' + employee.last_name + ', ' + employee.first_name}}</option>
            </select>
        </div>
        <div class="col-md-8">
            <label>{{trans('admin.Status')}}</label>
            <br>
            <label class="radio-inline">
                <input type="radio" name="state" value="active" v-model="state"> {{trans('admin.Aktiv')}}
            </label>
            <label class="radio-inline">
                <input type="radio" name="state" value="inactive" v-model="state"> {{trans('admin.Inaktiv')}}
            </label>
            <label class="radio-inline">
                <input type="radio" name="state" value="applicant" v-model="state"> {{trans('admin.Bewerber')}}
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'state': 'active',
                'employeeSelected': '',
                'employees': []
            }
        },

        methods: {

            select() {
                window.location = '/admin/employee/' + this.employeeSelected + '/' + window.location.href.split('/').pop();
            }

        },

        computed: {
            filteredEmployees() {
                return this.employees.filter((row) => {
                    if (this.state == 'active')
                        return row['active'] && ! row['applicant'];

                    if (this.state == 'inactive')
                        return ! row['active'] && ! row['applicant'];

                    if (this.state == 'applicant')
                        return row['applicant'];
                });
            }
        },

        created() {
            axios.get('/api/employee/all').then((response) =>
                    this.employees = response.data
            )
        }
    }
</script>
