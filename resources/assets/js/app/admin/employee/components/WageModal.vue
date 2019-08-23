<template>
    <form-wrapper :action="'/api/employee/' + data.employee.id + '/wage/' + wage.id + '/update'">
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
                            <datepicker v-if="wage.valid_to" name="valid_to" v-model="valid_to"></datepicker>
                            <input v-else class="form-control input-sm" disabled="disabled">
                        </div>
                        <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.amount }">
                            <label>{{trans('admin.Betrag in')}} €</label> <i v-if="form.errors.amount" class="fa fa-warning text-danger" :title="form.errors.amount"></i>
                            <input name="amount" class="form-control input-sm" v-model="amount">
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
                wage: Object.assign({}, this.data.wage),
                amount: this.money(this.data.wage.amount),
                valid_from: moment(this.data.wage.valid_from).format('L'),
                valid_to: this.data.wage.valid_to ? moment(this.data.wage.valid_to).format('L') : ''
            }
        },
        props: ['data'],

        created() {

            this.$on('form.submitted', function () {
                events.$emit('wage.updated');

                flash(trans('admin.Daten erfolgreich bearbeitet'));

                this.$parent.$emit('close')
            })
        }
    }
</script>