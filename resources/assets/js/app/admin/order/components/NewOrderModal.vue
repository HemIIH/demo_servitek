<template>
    <form-wrapper action="/api/order/store">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.client_id }">
                            <label>{{trans('admin.Kunde')}}</label>
                            <select name="client_id" class="form-control input-sm" v-model="client" @change="clientSelected">
                                <option value="">{{trans('admin.Kunde auswählen')}}</option>
                                <option v-for="client in data.clients" :value="client.id">{{ client.short_name }}</option>
                            </select>
                            <span v-if="form.errors.client_id" class="help-block">{{ form.errors.client_id }}</span>
                        </div>
                        <div v-if="contacts" class="col-md-6 form-group" v-show="client" :class="{'has-error': form.errors.contacts }">
                            <label>{{trans('admin.Ansprechpartner')}}</label>
                            <div class="checkbox" v-for="contact in contacts">
                                <label>
                                    <input type="checkbox" name="contacts[]" :value="contact.id" checked>
                                    {{ contact.last_name + ', ' + contact.first_name }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.title }">
                            <label>{{ trans('admin.Veranstaltungsname') }}</label>
                            <input class="form-control input-sm" name="title">
                            <span v-if="form.errors.title" class="help-block">{{ form.errors.title }}</span>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.staff_required }">
                            <label>{{trans('admin.Benötigte Mitarbeiter')}}</label>
                            <input class="form-control input-sm" name="staff_required">
                            <span v-if="form.errors.staff_required" class="help-block">{{ form.errors.staff_required }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.start_date }">
                            <label>{{trans('admin.Beginn')}}</label>
                            <datepicker name="start_date" v-model="startDate"></datepicker>
                            <span v-if="form.errors.start_date" class="help-block">{{ form.errors.start_date }}</span>
                        </div>
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.end_date }">
                            <label>{{trans('admin.Ende')}}</label>
                            <datepicker name="end_date"></datepicker>
                            <span v-if="form.errors.end_date" class="help-block">{{ form.errors.end_date }}</span>
                        </div>
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.start_time }">
                            <label>{{trans('admin.Startzeit')}}</label>
                            <div class="input-group">
                                <input class="form-control input-sm" name="start_time" placeholder="hh:mm" v-model="startTime" @change="calcMeetingTime">
                                <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                            </div>
                            <span v-if="form.errors.start_time" class="help-block">{{ form.errors.start_time }}</span>
                        </div>
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.end_time }">
                            <label>{{trans('admin.Endzeit')}}</label>
                            <div class="input-group">
                                <input class="form-control input-sm" name="end_time" placeholder="hh:mm">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                            <span v-if="form.errors.end_time" class="help-block">{{ form.errors.end_time }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-7 form-group" :class="{'has-error': form.errors.work_location }">
                                    <label>{{trans('admin.Einsatzort')}}</label>
                                    <input class="form-control input-sm" name="work_location" v-model="latestOrder.work_location">
                                    <span v-if="form.errors.work_location" class="help-block">{{ form.errors.work_location }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 form-group" :class="{'has-error': form.errors.meeting_point }">
                                    <label> {{trans('admin.Treffpunkt: Ort')}}</label>
                                    <input class="form-control input-sm" name="meeting_point" v-model="latestOrder.meeting_point">
                                    <span v-if="form.errors.meeting_point" class="help-block">{{ form.errors.meeting_point }}</span>
                                </div>
                                <div class="col-md-5 form-group" :class="{'has-error': form.errors.meeting_time }">
                                    <label>{{trans('admin.Zeit')}}</label>
                                    <div class="input-group">
                                        <input class="form-control input-sm" name="meeting_time" v-model="meetingTime">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <span v-if="form.errors.meeting_time" class="help-block">{{ form.errors.meeting_time }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.requirements }">
                            <label>{{trans('admin.Einsatzinfos')}}</label>
                            <textarea class="form-control input-sm" name="requirements" rows="6">{{ latestOrder.requirements }}</textarea>
                            <span v-if="form.errors.requirements" class="help-block">{{ form.errors.requirements }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <submit-button class="pull-right btn-md btn-success" :text="trans('admin.Anlegen')" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                client: this.data.clientId ? this.data.clientId : '',
                contacts: [],
                startDate: this.data.startDate,
                latestOrder: {
                    work_location: '',
                    meeting_point: '',
                    requirements: ''
                },
                startTime: '',
                meetingTime: ''
            }
        },
        props: ['data'],

        methods: {
            clientSelected() {
                if (this.client === '')
                    return;

                axios.get('/api/client/' + this.client + '/contacts?type=personnel_planning').then((response) =>
                    this.contacts = response.data
                );

                axios.get('/api/client/' + this.client + '/latest-order').then((response) => {
                    this.latestOrder.work_location = response.data.work_location,
                            this.latestOrder.meeting_point = response.data.meeting_point,
                            this.latestOrder.requirements = response.data.requirements
                });
            },

            calcMeetingTime() {
                if (moment.utc(this.startTime, 'HH::mm').format('H:mm') == 'Invalid date')
                    return;

                this.meetingTime = moment.utc(this.startTime, 'HH:mm').subtract(30, 'minutes').format('H:mm')
            }
        },

        created() {
            this.$on('form.submitted', function () {
                events.$emit('order.created');

                flash(trans('admin.Neuen Auftrag angelegt'));

                this.$parent.$emit('close')
            })
        },

        mounted() {
            this.clientSelected();
        }
    }
</script>