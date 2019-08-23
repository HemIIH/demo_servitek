<template>
    <div>
        <div class="form-group">
            <label>{{ trans('admin.Kalenderwoche' )}}</label>
            <select class="form-control input-sm" name="week" @change="updateDates" v-model="startOfWeek">
                <option value="">{{ trans('admin.Auswählen' )}}</option>
                <option v-for="week in calendarweeks" :value="week.startOfWeek">{{ week.number }}</option>
            </select>
        </div>
        <div class="form-group margin-l-10">
            <label>{{ trans('admin.Von' )}}</label>
            <datepicker name="start" v-model="startDate" @click="startOfWeek = ''"></datepicker>
        </div>
        <div class="form-group margin-l-10">
            <label>{{ trans('admin.Bis' )}}</label>
            <datepicker name="end" v-model="endDate" @click="startOfWeek = ''"></datepicker>
        </div>
        <button type="submit" class="btn btn-default btn-sm">{{trans('admin.Filtern')}}</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                startDate: this.start,
                endDate: this.end,
                startOfWeek: this.week || this.start,
                calendarweeks: []
            }
        },
        props: ['start', 'end', 'week'],

        methods: {
            getCalendarweeks() {
                for(let i = -2; i <= 4; i++) {
                    this.calendarweeks.push({
                        'number': moment().locale('de').startOf('week').add(i, 'week').format('W'),
                        'startOfWeek': moment().locale('de').startOf('week').add(i, 'week').format('L')
                    });
                }
            },

            updateDates() {
                if(this.startOfWeek) {
                    this.startDate = this.startOfWeek
                    this.endDate = moment(this.startOfWeek, 'DD.MM.YYYY').locale('de').endOf('week').format('L')
                }
            }
        },

        mounted() {
            this.getCalendarweeks();
        }

    }

</script>

