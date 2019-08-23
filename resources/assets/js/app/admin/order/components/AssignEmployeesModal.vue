<template>
    <div class="row">
        <div class="col-md-4">
            <employee-list :order="order" :locations="['Bonn', 'Köln', 'Düsseldorf']"></employee-list>
        </div>

        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-3 form-group">
                        <p>
                            <strong>{{trans('admin.Auftragsnr')}} :</strong> <a :href="'/admin/order/' + order.id + '/show'">{{ order.id }}</a>
                        </p>
                        <p>
                            <strong>{{trans('admin.Datum')}} :</strong>
                            {{ order.start == order.end ? order.start : order.start + ' ' +trans('admin.bis')+' ' + order.end }}
                        </p>
                    </div>
                    <div class="col-md-3 form-group">
                        <p>
                            <strong>{{trans('admin.Kunde')}} :</strong> <a :href="'/admin/client/' + order.client.id + '/show'">{{ order.client.name }}</a>
                        </p>
                        <p>
                            <strong>{{trans('admin.Startzeit')}} :</strong> {{ order.start_time }} {{trans('admin.Uhr')}}
                        </p>
                    </div>
                    <div class="col-md-3 form-group">
                        <p>
                            <strong>{{trans('admin.Einsatzort')}} :</strong> {{ order.work_location }}
                        </p>
                        <p>
                            <strong>{{trans('admin.Treffpunkt')}}</strong> {{ order.meeting_time +  trans('admin.Uhr')+' - ' + order.meeting_point }}
                        </p>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>{{trans('admin.Einsatzinfos')}} :</label>
                        <div>{{ order.requirements }}</div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">{{trans('admin.Mitarbeiter für diesen Auftrag')}}</h4>
                    <a class="btn btn-primary pull-right" :href="'/admin/operation-plan/send/order/' + order.id">{{trans('admin.Einsatzpläne senden')}}</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <assigned-employees :order="order" username="payam"></assigned-employees>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                order: this.data.order
            }
        },
        props: ['data'],
        components: {
            'EmployeeList': require('./EmployeeList.vue'),
            'AssignedEmployees': require('./AssignedEmployees.vue')
        },
        methods: {}
    }
</script>