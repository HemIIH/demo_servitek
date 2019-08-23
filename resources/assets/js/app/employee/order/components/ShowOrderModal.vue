<template>
    <div>
        <div class="row margin-b-10">
            <div class="col-md-6">
                <div v-if="order.status == 'canceled'" class="label label-warning margin-l-10">{{trans('admin.Storniert')}}</div>
            </div>
        </div>

        <div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Veranstaltungsname')}}</label>
                            <p>{{ order.title }}</p>
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
                        <div class="col-md-6">
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

                    <hr>

                    <div v-if="data.showFeedback">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{trans('admin.Rückmeldung an den Dispo-Manager')}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <p>{{trans('admin.Sind Sie bereit an diesen Termin zu arbeiten?')}}</p>
                            </div>
                            <div class="col-md-5">
                                <button @click.prevent="accept" class="btn btn-success btn-sm margin-l-10">Zusagen</button>
                                <button @click.prevent="deny" class="btn btn-danger btn-sm">{{trans('admin.Absagen')}}</button>
                            </div>
                        </div>
                    </div>

                    <div v-if="data.showTimetracking && order.timetrackings.length">
                        <h4>{{trans('admin.Erfasste Zeit')}}</h4>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{trans('admin.Start')}}</label>
                                <div>{{ hour(order.timetrackings[0].start_time) + trans('admin.Uhr') }}</div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{trans('admin.Ende')}}</label>
                                <div>{{ hour(order.timetrackings[0].end_time) + trans('admin.Uhr') }}</div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{trans('admin.Pause')}}</label>
                                <div>{{ order.timetrackings[0].break ? order.timetrackings[0].break + ' Minuten' : '-' }}</div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{trans('admin.Erfasst')}}</label>
                                <div>{{ hour(order.timetrackings[0].total_min/60) + trans('admin.Stunden') }}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="pull-right">
                <a @click.prevent="$parent.$emit('close')" class="btn btn-danger btn-md">{{trans('admin.Schliessen')}}</a>
            </div>
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
            accept() {
                axios.post('/api/e/order/' + this.order.id + '/accept').then(() => {
                    flash(trans('admin.Erfolgreich gespeichert'));
                    events.$emit('availability.changed');

                    this.$parent.$emit('close');
                });
            },

            deny() {
                axios.post('/api/e/order/' + this.order.id + '/deny').then(() => {
                    flash(trans('admin.Erfolgreich gespeichert'));
                    events.$emit('availability.changed');

                    this.$parent.$emit('close');
                });

            }
        }

    }
</script>