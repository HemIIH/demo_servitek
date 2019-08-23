<template>
    <form-wrapper action="/api/c/order/request">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" :class="{'has-error': form.errors.title }">
                                <label>{{trans('admin.Veranstaltungsname')}}</label>
                                <input class="form-control input-sm" name="title">
                                <span v-if="form.errors.title" class="help-block">{{ form.errors.title }}</span>
                            </div>
                            <div class="form-group" :class="{'has-error': form.errors.staff_required }">
                                <label>{{trans('admin.Benötigte Mitarbeiter')}}</label>
                                <input class="form-control input-sm" name="staff_required">
                                <span v-if="form.errors.staff_required" class="help-block">{{ form.errors.staff_required }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div v-if="data.contacts" class="col-md-6 form-group" :class="{'has-error': form.errors.contacts }">
                                <label>{{trans('admin.Ansprechpartner')}}</label>
                                <div class="checkbox" v-for="contact in data.contacts">
                                    <label>
                                        <input type="checkbox" name="contacts[]" :value="contact.id" checked>
                                        {{ contact.last_name + ', ' + contact.first_name }}
                                    </label>
                                </div>
                            </div>
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
                                <input class="form-control input-sm" name="start_time" placeholder="hh:mm">
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
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.work_location }">
                            <label>{{trans('admin.Einsatzort')}}</label>
                            <input class="form-control input-sm" name="work_location">
                            <span v-if="form.errors.work_location" class="help-block">{{ form.errors.work_location }}</span>
                        </div>
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.requirements }">
                            <label>{{trans('admin.Einsatzinfos')}}</label>
                            <textarea class="form-control input-sm" name="requirements" rows="6"></textarea>
                            <span v-if="form.errors.requirements" class="help-block">{{ form.errors.requirements }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <input type="submit" :value="trans('admin.Speichern')" class="btn btn-success btn-md">
                <a @click.prevent="$parent.$emit('close')" class="btn btn-danger btn-md">{{trans('admin.Schliessen')}}</a>
            </div>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                startDate: this.data.startDate
            }
        },
        props: ['data'],

        created() {
            this.$on('form.submitted', function () {
                events.$emit('order.created');

                flash(trans('admin.Neuen Auftrag erstellt'));

                this.$parent.$emit('close')
            })
        }
    }
</script>