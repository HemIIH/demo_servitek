<template>
    <form-wrapper :action="'/api/employee/' + data.employee.id + '/workingHours/' + workingHours.id + '/update'">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.valid_from }">
                            <label>{{trans('admin.Gültig ab')}}</label> <i v-if="form.errors.valid_from" class="fa fa-warning text-danger" :title="form.errors.valid_from"></i>
                            <datepicker name="valid_from" v-model="valid_from"></datepicker>
                        </div>
                        <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.valid_to }">
                            <label>{{trans('admin.Gültig bis')}}</label> <i v-if="form.errors.valid_to" class="fa fa-warning text-danger" :title="form.errors.valid_to"></i>
                            <datepicker v-if="workingHours.valid_to" name="valid_to" v-model="valid_to"></datepicker>
                            <input v-else class="form-control input-sm" disabled="disabled">
                        </div>
                        <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.hours }">
                            <label>{{trans('admin.Stunden')}}</label> <i v-if="form.errors.hours" class="fa fa-warning text-danger" :title="form.errors.hours"></i>
                            <input name="hours" class="form-control input-sm" v-model="hours">
                        </div>
                    </div>
                </div>
            </div>

            <submit-button class="pull-right btn-sm btn-success" :text="trans('admin.Speichern')" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                workingHours: Object.assign({}, this.data.workingHours),
                hours: this.money(this.data.workingHours.hours),
                valid_from: moment(this.data.workingHours.valid_from).format('L'),
                valid_to: this.data.workingHours.valid_to ? moment(this.data.workingHours.valid_to).format('L') : ''
            }
        },
        props: ['data'],

        created() {

            this.$on('form.submitted', function () {
                events.$emit('workingHours.updated');

                flash(trans('admin.Daten erfolgreich bearbeitet'));

                this.$parent.$emit('close')
            })
        }
    }
</script>