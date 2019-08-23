<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div v-if="data.type != 'show'" class="row margin-b-10">
                    <div class="col-md-6">
                        <div v-if="order.status == 'canceled'" class="label label-warning">{{trans('admin.Storniert')}}</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <a v-if="! order.parent_id" @click="duplicateOrder" class="btn btn-sm btn-success">{{trans('admin.Duplizieren')}}</a>
                        <a @click="copyOrder" class="btn btn-sm btn-primary">{{trans('admin.Kopieren')}}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('admin.Kunde')}}</label>
                        <p><a :href="'/admin/client/' + order.client.id + '/show'">{{ order.client.name }}</a></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('admin.Ansprechpartner')}}</label>
                        <ul>
                            <li v-for="contact in order.contacts">{{ contact.last_name + ', ' + contact.first_name }}</li>
                        </ul>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('admin.Veranstaltungsname')}}</label>
                        <p>{{ order.title }}</p>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>{{trans('admin.Benötigte Mitarbeiter')}}</label>
                        <p>{{ order.staff_required }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>{{trans('admin.Beginn')}}</label>
                        <p>{{ moment(order.start_date).format('L') }}</p>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>{{trans('admin.Ende')}}</label>
                        <p>{{ moment(order.end_date).format('L') }}</p>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>{{trans('admin.Startzeit')}}</label>
                        <p>{{ order.start_time ? order.start_time + trans('admin.Uhr') : '-' }}</p>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>{{trans('admin.Endzeit')}}</label>
                        <p>{{ order.end_time ? order.end_time + trans('admin.Uhr') : '-' }}</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('admin.Einsatzort')}}</label>
                        <p>{{ order.work_location }}</p>
                        <div class="row">
                            <div class="col-md-7 form-group">
                                <label>{{trans('admin.Treffpunkt: Ort')}}</label>
                                <p>{{ order.meeting_point }}</p>
                            </div>
                            <div class="col-md-5 form-group">
                                <label>{{trans('admin.Zeit')}}</label>
                                <p>{{ order.meeting_time ? order.meeting_time + trans('admin.Uhr') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('admin.Einsatzinfos')}}</label>
                        <p>{{ order.requirements }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
            <a :href="'/admin/order/' + order.id + '/timetracking'" class="btn btn-info btn-md">{{trans('admin.Zeiterfassung')}}</a>
            <a :href="'/admin/order/' + order.id + '/show'" class="btn btn-primary btn-md">{{trans('admin.Zum Auftrag')}}</a>
            <a @click.prevent="$parent.$emit('close')" class="btn btn-danger btn-md">{{trans('admin.Schliessen')}}</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                order: Object.assign({}, this.data.order)
            }
        },
        props: ['data'],

        methods: {
            copyOrder() {
                modal('Copy Order Modal', trans('Auftrag kopieren'), {'order': this.order});
            },

            duplicateOrder() {
                modal('Duplicate Order Modal', trans('Unterauftrag anlegen'), {'order': this.order});
            }
        }
    }
</script>