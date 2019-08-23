<template>
    <form-wrapper :action="action" method="POST">
        <template slot-scope="form">
            <div v-if="type == 'duplicate'">
                <p>{{trans('admin.Auftrag wird als Unterauftrag von Auftrag')}} {{ order.id + ' ('+ trans('admin.Auftragsstart')+' am ' + order.start + ')' }} {{trans('admin.angelegt')}}</p>

                <input type="hidden" name="parent_id" :value="order.id">
            </div>
            <div v-if="order.status == 'requested'">
                <p>{{trans('admin.Auftrag wurde am')}} {{ moment(order.created_at).format('LLL') }} {{trans('admin.Uhr durch den Kunden')}} {{ order.client.name }} {{trans('admin.angefragt')}}</p>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{trans('admin.Unterauftrag von Auftrag')}}  {{ order.parent_id }}.</p>
                        </div>

                        <div v-if="type == 'edit'" class="col-md-6 form-group" :class="{'has-error': form.errors.client_id }">
                            <label>{{trans('admin.Kunde')}}</label>
                            <select name="client_id" class="form-control input-sm" v-model="order.client.id" @change="clientSelected">
                                <option value="">{{trans('admin.Kunde auswählen')}}</option>
                                <option v-for="client in clients" :value="client.id">
                                    {{ client.name }}
                                </option>
                            </select>
                            <span v-if="form.errors.client_id" class="help-block">{{ form.errors.client_id }}</span>
                        </div>
                        <div v-if="type == 'copy' || type == 'duplicate'" class="col-md-6 form-group">
                            <label>{{trans('admin.Kunde')}}</label>
                            <input class="form-control input-sm" :value="order.client.name" disabled>
                            <input type="hidden" name="client_id" :value="order.client.id">
                        </div>
                        <div v-if="contacts" class="col-md-6 form-group" v-show="order.client.id" :class="{'has-error': form.errors.contacts }">
                            <label>{{trans('admin.Ansprechpartner')}}</label>
                            <div class="checkbox" v-for="contact in contacts">
                                <label>
                                    <input type="checkbox" name="contacts[]" :value="contact.id" v-model="contactsSelected">
                                    {{ contact.last_name + ', ' + contact.first_name }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.title }">
                            <label>{{trans('admin.Veranstaltungsname')}}</label>
                            <input class="form-control input-sm" name="title" v-model="order.title">
                            <span v-if="form.errors.title" class="help-block">{{ form.errors.title }}</span>
                        </div>
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.staff_required }">
                            <label>{{trans('admin.Benötigte Mitarbeiter')}}</label>
                            <input class="form-control input-sm" name="staff_required" v-model="order.staff_required">
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
                            <datepicker name="end_date" v-model="endDate"></datepicker>
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
                                <input class="form-control input-sm" name="end_time" placeholder="hh:mm" v-model="endTime">
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
                                    <input class="form-control input-sm" name="work_location" v-model="order.work_location">
                                    <span v-if="form.errors.work_location" class="help-block">{{ form.errors.work_location }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 form-group" :class="{'has-error': form.errors.meeting_point }">
                                    <label>{{trans('admin.Treffpunkt: Ort')}}</label>
                                    <input class="form-control input-sm" name="meeting_point" v-model="order.meeting_point">
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
                            <textarea class="form-control input-sm" name="requirements" cols="30" rows="6" v-model="order.requirements"></textarea>
                            <span v-if="form.errors.requirements" class="help-block">{{ form.errors.requirements }}</span>
                        </div>
                    </div>

                    <div v-if="type == 'edit'">
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <label>{{trans('admin.Wichtige Änderung')}}</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="changes[]" value="work_location">
                                        {{trans('admin.Einsatzort')}}
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="changes[]" value="start_time">
                                        {{trans('admin.Einsatzbeginn')}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="changes[]" value="requirements">
                                        {{trans('admin.Einsatzinfos')}}
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="changes[]" value="meeting_point">
                                        {{trans('admin.Treffpunkt')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <submit-button class="pull-right btn-md btn-success" :text="type == 'edit' ? trans('admin.Speichern') : trans('admin.Anlegen')" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                order: Object.assign({}, this.model),

                clients: {},
                contacts: {},
                contactsSelected: [],

                startDate: this.type == 'edit' ? this.model.start : '',
                endDate: this.type == 'edit' ? this.model.end : '',
                startTime: this.type == 'edit' ? this.model.start_time : '',
                endTime: this.type == 'edit' ? this.model.end_time : '',
                meetingTime: this.type == 'edit' ? this.model.meeting_time : ''
            }
        },
        props: ['model', 'action', 'type'],

        methods: {
            clientSelected() {
                if (this.order.client.id === '') return;

                this.getContacts();
            },

            getContacts() {
                axios.get('/api/client/' + this.order.client.id + '/contacts?type=personnel_planning').then((response) =>
                        this.contacts = response.data
                );
            },

            calcMeetingTime() {
                if (moment.utc(this.startTime, 'HH::mm').format('H:mm') == 'Invalid date')
                    return;

                this.meetingTime = moment.utc(this.startTime, 'HH:mm').subtract(30, 'minutes').format('H:mm')
            }
        },

        created() {
            axios.get('/api/client/get').then((response) =>
                    this.clients = response.data
            );

            this.getContacts();

            this.$on('form.submitted', () => this.$parent.$emit('form.submitted'));
        },

        mounted() {

            this.contactsSelected = this.order.contacts.map((item) => {
                return item['id']
            });

        }
    }
</script>