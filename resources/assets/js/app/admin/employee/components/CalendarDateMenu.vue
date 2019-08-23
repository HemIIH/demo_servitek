<template>
    <form-wrapper action="/admin/operation-plan/send" class="form-inline">
        <template slot-scope="form">
            <input type="hidden" name="employees" :value="employee.id">

            <div class="form-group margin-r-10">
                <label>{{trans('admin.Kalenderwoche')}}</label>
                <select class="form-control input-sm" name="week" @change="updateDates" v-model="weekSelected">
                    <option value="">{{trans('admin.Auswählen')}}</option>
                    <option v-for="week in calendarweeks" :value="week.dates">{{ week.number }}</option>
                </select>
            </div>
            <div class="form-group margin-r-10">
                <label>{{trans('admin.Von')}}</label>
                <datepicker name="start" v-model="startDate" @blur="weekSelected = ''" required></datepicker>
            </div>
            <div class="form-group margin-r-10">
                <label>{{trans('admin.Bis')}}</label>
                <datepicker name="end" v-model="endDate" @blur="weekSelected = ''" required></datepicker>
            </div>

            <submit-button :text="trans('admin.Einsatzplan senden')" class="btn-sm btn-primary" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                startDate: '',
                endDate: '',
                weekSelected: '',
                calendarweeks: []
            }
        },
        props: ['employee'],

        methods: {
            getCalendarWeeks() {
                for (let i = -2; i <= 4; i++) {
                    var start = moment().startOf('week').add(i, 'weeks');

                    this.calendarweeks.push({
                        number: start.isoWeek(),
                        dates: start.format('Y-M-D') + '_' + start.endOf('week').format('Y-M-D')
                    })
                }
            },

            updateDates() {

                if (this.weekSelected == '') {
                    this.startDate = this.start;
                    this.endDate = this.end;
                } else {
                    let start = this.weekSelected.split('_')[0].split('-');
                    let end = this.weekSelected.split('_')[1].split('-');

                    this.startDate = start[2] + '.' + start[1] + '.' + start[0];
                    this.endDate = end[2] + '.' + end[1] + '.' + end[0];
                }
            }
        },

        created() {
            this.getCalendarWeeks();

            this.$on('form.submitted', () => {
                flash(trans('admin.Mail versendet'));
            })
        },
    }
</script>