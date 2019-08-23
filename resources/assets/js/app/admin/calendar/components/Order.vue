<template>
    <div class="bg-grey-light margin-b-10">
        <div class="margin-5 margin-l-10">
            <div>
                <i v-if="order.start != order.end" class="fa fa-link"></i>
                <strong :title="order.title" class="pointer" @click="openOrder">{{ shorten(order.client.short_name, 14) }}</strong>
                <i @click="editOrder" class="fa fa-pencil margin-t-5 pointer pull-right"></i>
            </div>

            <div>
                <i class="fa fa-clock-o"></i> {{ order.start_time }} {{trans('admin.Uhr')}}
            </div>
            <div>
                <i class="fa fa-map-marker"></i> {{ shorten(order.work_location, 14) }}
            </div>
            <div class="margin-t-5 pointer" @click="assignEmployees">
                <strong>{{ trans('admin.Mitarbeiter' )}}</strong>

                <div class="pull-right">
                    <strong>{{ order.staff_planned + ' / ' + order.staff_required }}</strong>
                </div>

                <ul v-if="order.employees" class="list-unstyled">
                    <li v-for="employee in order.employees" class="small">
                        <i v-if="employee.pivot.approved_by_employee" class="fa fa-check text-success margin-r-5"></i>
                        <i v-if="employee.pivot.rejected_by_employee" class="fa fa-times text-danger margin-r-5"></i>
                        <span v-if="!employee.pivot.approved_by_employee && !employee.pivot.rejected_by_employee">
                            <i class="fa fa-question-circle margin-r-5" :class="{'text-danger' : employee.pivot.employee_not_available, 'text-success' : employee.pivot.employee_available}"></i>
                        </span>

                        {{ employee.last_name + ', ' + employee.first_name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['order'],

        methods: {

            assignEmployees() {
                modal('Assign Employees Modal', trans('admin.Mitarbeiter einplanen'), {'order': this.order}, '100%');
            },

            editOrder() {
                modal('Edit Order Modal', trans('admin.Auftrag bearbeiten'), {'order': this.order});
            },

            openOrder() {
                modal('Show Order Modal', trans('admin.uftrag anzeigen'), {'order': this.order});
            }
        }
    }
</script>