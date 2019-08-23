<template>
    <div>
        <div v-if="! editMode">
            <div class="row margin-b-10">
                <div class="col-md-4">
                    <p><strong>{{ trans('admin.'+data.timeoff.type) }}</strong></p>
                </div>
                <div class="col-md-3">
                    <p>{{ moment(data.timeoff.date).format('L')}}</p>
                </div>
                <div class="col-md-4">
                    <p v-if="data.timeoff.information">{{ data.timeoff.information }}</p>
                </div>
                <div class="col-md-1 text-right">
                    <i @click="editMode = true" class="fa fa-pencil pointer"></i>
                </div>
            </div>
            <div class="pull-right">
                <button @click="destroy" class="btn btn-danger btn-md">{{trans('admin.Eintrag löschen')}}</button>
                <button @click="$parent.$emit('close')" class="btn btn-default btn-md">{{trans('admin.Schliessen')}}</button>
            </div>
        </div>
        <form-wrapper v-else :action="'/api/employee/' + data.employee.id + '/timeoff'">
            <template slot-scope="form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.start_date }">
                            <label>{{trans('admin.Startdatum')}}</label>
                            <datepicker name="start_date" v-model="startDate"></datepicker>
                        </div>
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.end_date }">
                            <label>{{trans('admin.Enddatum')}}</label>
                            <datepicker name="end_date" v-model="endDate"></datepicker>
                        </div>
                        <div class="col-md-12 form-group" :class="{'has-error': form.errors.type }">
                            <select class="form-control input-sm" name="type" v-model="timeoff.type">
                                <option value="">{{trans('admin.Ausfallgrund wählen')}}</option>
                                <option value="Krankheit">{{trans('admin.Krankheit')}}</option>
                                <option value="Fehltag">{{trans('admin.Fehltag')}}</option>
                                <option value="Urlaub">{{trans('admin.Urlaub')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label>{{trans('admin.Zusätzliche Informationen')}}</label>
                        <div class="form-group" :class="{'has-error': form.errors.information }">
                            <textarea class="form-control input-sm" name="information" cols="30" rows="3" v-model="timeoff.information"></textarea>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                        <i @click="editMode = false" class="fa fa-times text-danger pointer"></i>
                    </div>
                </div>

                <div class="pull-right">
                    <submit-button :text="trans('admin.Änderungen speichern')" class="btn-sm btn-success" :loading="form.loading"></submit-button>
                    <button @click="$parent.$emit('close')" class="btn btn-sm btn-default">{{trans('admin.Schliessen')}}</button>
                </div>
            </template>
        </form-wrapper>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                'editMode': false,
                'timeoff': Object.assign({}, this.data.timeoff),
                'startDate': moment(this.data.timeoff.date).format('L'),
                'endDate': moment(this.data.timeoff.date).format('L')
            }
        },

        props: ['data'],

        methods: {

            destroy() {
                swal({text: trans('admin.Eintrag wirklich löschen?')}).then(() => {
                    let data = {
                        entry: this.timeoff
                    };

                    axios.post('/api/employee/' + this.data.employee.id + '/timeoff/delete', data).then((response) => {
                        events.$emit('timeoffs.updated')
                        this.$parent.$emit('close')
                    });
                });
            }
        },

        created() {
            this.$on('form.submitted', () => {
                events.$emit('timeoffs.updated');

                this.$parent.$emit('close');
            })
        }
    }
</script>
