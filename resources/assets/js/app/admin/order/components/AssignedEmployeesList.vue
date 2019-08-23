<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-title">{{trans('admin.Eingeplante Mitarbeiter')}}</div>
                </div>
                <div class="col-md-6 text-right">
                    <button @click="assignEmployees" class="btn btn-primary btn-sm">{{trans('admin.Zur Disposition')}}</button>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{trans('admin.Mitarbeiter')}}</th>
                    <th>{{trans('admin.Status')}}</th>
                    <th>{{trans('admin.Treffpunkt')}}</th>
                    <th>{{trans('admin.Rolle')}}</th>
                    <th>{{trans('admin.Gesendet')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="employee in order.employees">
                    <td><a :href="'/admin/employee/' + employee.id + '/show'">{{ employee.last_name + ', ' + employee.first_name }}</a></td>
                    <td>
                        <i v-if="employee.pivot.approved_by_employee" class="fa fa-check text-success"></i>
                        <i v-if="employee.pivot.rejected_by_employee" class="fa fa-times text-danger"></i>
                        <i v-if="!employee.pivot.approved_by_employee && !employee.pivot.rejected_by_employee" class="fa fa-question"></i>
                    </td>
                    <td>{{ moment(employee.pivot.meeting_time, 'hh:mm:ss').format('LT') + trans('admin.Uhr')+' - ' + employee.pivot.meeting_point }}</td>
                    <td>{{ employee.pivot.role }}</td>
                    <td>{{ employee.pivot.sent ? moment(employee.pivot.sent).format('lll') + trans('admin.Uhr')+' - ' + employee.pivot.sent_by : '-' }}</td>
                </tr>
                <tr v-if="! order.employees.length" class="text-center">
                    <td colspan="5">
                        {{trans('admin.Noch keine Mitarbeiter eingeplant')}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                order: Object.assign({}, this.model)
            }
        },
        props: ['model'],

        methods: {

            assignEmployees() {
                modal('Assign Employees Modal', trans('admin.Mitarbeiter einplanen'), {'order': this.order}, '100%');
            },

            reloadOrder() {
                axios.get('/api/order/' + this.model.id).then((response) => this.order = response.data);
            }
        },

        created() {
            events.$on('personal.updated', this.reloadOrder);
        }
    }
</script>