<template>
    <form-wrapper :action="'/api/c/order/' + order.id + '/update'">
        <template slot-scope="form">
            <div class="row margin-b-10">
                <div class="col-md-6">
                    <div v-if="order.status == 'canceled'" class="label label-warning margin-l-10">{{trans('admin.Storniert')}}</div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Veranstaltungsname')}}</label>
                            <p>{{ order.title }}</p>
                        </div>
                        <div class="col-md-4 form-group" :class="{'has-error': form.errors.staff_required }">
                            <label>{{trans('admin.Benötigte Mitarbeiter')}}</label>
                            <input class="form-control input-sm" name="staff_required" v-model="order.staff_required">
                            <span v-if="form.errors.staff_required" class="help-block">{{ form.errors.staff_required }}</span>
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
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.start_time }">
                            <label>{{trans('admin.Startzeit')}}</label>
                            <div class="input-group">
                                <input class="form-control input-sm" name="start_time" placeholder="hh:mm" v-model="order.start_time">
                                <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                            </div>
                            <span v-if="form.errors.start_time" class="help-block">{{ form.errors.start_time }}</span>
                        </div>
                        <div class="col-md-3 form-group" :class="{'has-error': form.errors.end_time }">
                            <label>{{trans('admin.Endzeit')}}</label>
                            <div class="input-group">
                                <input class="form-control input-sm" name="end_time" placeholder="hh:mm" v-model="order.end_time">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                            <span v-if="form.errors.end_time" class="help-block">{{ form.errors.end_time }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Einsatzort')}}</label>
                            <p>{{ order.work_location }}</p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Einsatzinfos')}}</label>
                            <p>{{ order.requirements }}</p>
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
                order: Object.assign({}, this.data.order)
            }
        },
        props: ['data'],


        created() {
            this.$on('form.submitted', () => {
                events.$emit('order.updated');

                flash(trans('admin.Auftrag bearbeitet'));

                this.$parent.$emit('close');
            })
        }

    }
</script>