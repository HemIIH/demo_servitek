<template>
    <div>
        <p><strong>{{trans('admin.Benötigte Mitarbeiter')}} :</strong> {{ staffPlanned + ' '+ trans('admin.von') +' '+ order.staff_required }}</p>

        <table class="table assigned-employee-list">
            <thead>
            <tr>
                <th></th>
                <th>{{trans('admin.Name')}}</th>
                <th>{{trans('admin.Rolle')}}</th>
                <th>{{trans('admin.Bereich')}}</th>
                <th class="text-center">{{trans('admin.Treffpunkt')}}</th>
                <th class="text-center">{{trans('admin.Versand')}}</th>
                <th class="text-center" style="width:80px;">{{trans('admin.Status')}}</th>
                <th>{{trans('admin.Bearbeiter')}}</th>
                <th width="50px"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(employee, index) in employees">
                <td>
                    <i class="fa fa-circle" :class="{'text-danger' : employee.pivot.employee_not_available, 'text-success' : employee.pivot.employee_available}"></i>
                </td>
                <td>
                    <span><a :href="'/admin/employee/' + employee.id + '/show'">{{ employee.last_name + ', ' + employee.first_name }}</a></span>
                </td>
                <td>
                    <div v-if="employee.editMode">
                        <select class="form-control input-sm" v-model="employee.pivot.role">
                            <option value="-">-</option>
                            <option v-for="role in employee.roles">{{ role.shortcut }}</option>
                        </select>
                    </div>
                    <div v-else>
                        <span @click="edit(employee)" class="pointer">{{ employee.pivot.role }}</span>
                    </div>
                </td>
                <td>
                    <div v-if="employee.editMode">
                        <select class="form-control input-sm" @blur="update(employee)" v-model="employee.pivot.working_area">
                            <option value="-">-</option>
                            <option value="BAR">{{trans('admin.BAR')}}</option>
                            <option value="THK">{{trans('admin.THK')}}</option>
                            <option value="RST">{{trans('admin.RST')}}</option>
                            <option value="BGA">{{trans('admin.BGA')}}</option>
                            <option value="BKT">{{trans('admin.BKT')}}</option>
                        </select>
                    </div>
                    <div v-else>
                        <span @click="edit(employee)" class="pointer">{{ employee.pivot.working_area }}</span>
                    </div>

                </td>
                <td>
                    <div v-if="employee.editMode" class="form-inline">
                        <input class="form-control input-sm" style="width: 120px;" v-model="employee.pivot.meeting_point">
                        <input class="form-control input-sm" style="width: 70px;" v-model="employee.pivot.meeting_time">
                        <i class="fa fa-save pointer" @click="update(employee)"></i>
                    </div>
                    <div v-else class="text-center">
                        <i @click="edit(employee)" class="fa fa-map-marker pointer" :title="employee.pivot.meeting_point + ' - ' + employee.pivot.meeting_time + trans('admin.Uhr')"></i>
                    </div>
                </td>
                <td class="text-center">
                    <i v-if="employee.pivot.sent" class="fa fa-check pointer" :title="trans('admin.Versandt')+' am ' + moment(employee.pivot.sent).format('lll') + trans('admin.Uhr')+' ' +trans('admin.von')+' ' + employee.pivot.sent_by"></i>
                </td>
                <td>
                    <div class="radio-wrapper">
                        <input type="checkbox" :name="employee.id" class="yes" :checked="employee.pivot.approved_by_employee" :id="'radio-yes-' + employee.id" @click="accept(employee)"/>
                        <label :for="'radio-yes-' + employee.id" :title="trans('admin.Angenommen')"></label>

                        <input type="checkbox" :name="employee.id" class="neutral" :checked="!(employee.pivot.approved_by_employee || employee.pivot.rejected_by_employee)" @click="reset(employee)" :id="'radio-neutral-' + employee.id"/>
                        <label :for="'radio-neutral-' + employee.id"></label>

                        <input type="checkbox" :name="employee.id" class="no" :checked="employee.pivot.rejected_by_employee" @click="reject(employee)" :id="'radio-no-' + employee.id"/>
                        <label :for="'radio-no-' + employee.id" :title="trans('admin.Abgelehnt')"></label>
                    </div>
                </td>
                <td>
                    <span v-if="employee.pivot.edited_by">{{ employee.pivot.edited_by }}</span>
                </td>
                <td>
                    <button @click="destroy(employee, $event)" class="destroy btn btn-xs btn-default" :title="trans('admin.Mitarbeiter löschen')">
                        <i class="fa fa-times fa-lg"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="pull-right margin-t-10">
            <button class="btn btn-success btn-sm" @click="save">{{trans('admin.Speichern')}}</button>
            <button class="btn btn-danger btn-sm" @click="exit">{{trans('admin.Schließen')}}</button>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                employees: [],
                processing: false,
                staffPlanned: this.order.staff_planned
            }
        },
        props: ['order', 'username'],
        methods: {
            accept(employee) {
                employee.pivot.approved_by_employee = 1;
                employee.pivot.rejected_by_employee = 0;
            },

            reject(employee) {
                employee.pivot.approved_by_employee = 0;
                employee.pivot.rejected_by_employee = 1;
            },

            reset(employee) {
                employee.pivot.approved_by_employee = null;
                employee.pivot.rejected_by_employee = null;
            },

            destroy(employee) {
                axios.get('/api/order/' + this.order.id + '/employee/' + employee.id + '/unassign').then(() => {
                    events.$emit('employee.deleted', employee.id);
                }).then(() =>
                        this.employees.splice(this.employees.indexOf(employee), 1)
                );
            },

            getEmployees() {
                axios.get('/api/order/' + this.order.id + '/employees/assigned').then((response) =>
                        this.employees = response.data
                );
            },

            getEmployee(id) {
                axios.get('/api/order/' + this.order.id + '/employee/' + id).then((response) =>
                        this.employees.push(response.data)
                );
            },

            edit(employee) {
                this.$set(employee, 'editMode', true);
            },

            update(employee) {
                this.$set(employee, 'editMode', false);
            },

            save() {
                axios.post('/api/order/' + this.order.id + '/personal/save', {'employees': this.employees}).then((response) => {
                    flash(trans('admin.Erfolgreich gespeichert'));
                    this.staffPlanned = response.data;

                    events.$emit('personal.updated');
                });
            },

            exit() {
                events.$emit('close.modal');
            }
        },
        created: function () {
            this.getEmployees();

            events.$on('employee.added', this.getEmployee);
        }

    }

</script>

<style>
    .radio-wrapper {
        width: 80px;
        height: 25px;
        display: inline-block;
        vertical-align: middle;
        background: rgba(0, 0, 0, 0.4);
        border-radius: 30px;
        position: relative;
        margin-left: 1%;
    }

    .radio-wrapper label {
        z-index: 9;
    }

    .radio-wrapper input[type="checkbox"] {
        display: none;
    }

    .neutral + label {
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        position: absolute;
        left: 33%;
        transition: transform 1s;
    }

    .neutral:checked + label {
        border: 2px solid rgba(0, 0, 0, 1);
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: rgb(238, 238, 238);
        background: linear-gradient(to bottom, rgba(238, 238, 238, 1) 0%, rgba(204, 204, 204, 1) 100%);
    }

    .no + label {
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        position: absolute;
        left: 0;
        text-align: center;
    }

    .no:checked + label {
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: rgb(230, 108, 103);
        background: linear-gradient(to bottom, rgba(230, 108, 103, 1) 0%, rgba(221, 79, 75, 1) 100%);
    }

    .yes + label {
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        position: absolute;
        right: 0;
        text-align: center;
    }

    .yes:checked + label {
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: rgb(32, 213, 50);
        background: linear-gradient(to bottom, rgba(32, 213, 50, 1) 0%, rgba(28, 195, 1, 1) 100%);
    }
</style>