<template>
    <div>
        <div class="row">
            <div class="col-md-4 form-group form-inline">
                <label class="margin-r-5">{{trans('admin.Region')}}</label>
                <select class="form-control input-sm" v-model="region" @change="getSalaryTableDate">
                    <option v-for="region in regions" :value="region">{{ region }}</option>
                </select>
            </div>
            <div class="col-md-4 form-group form-inline">
                <label class="margin-r-5">{{trans('admin.Gültig ab')}}</label>
                <select class="form-control input-sm" v-model="validFrom" @change="getSalaryTableDate">
                    <option v-for="date in dates" :value="date">{{ moment(date).format('L') }}</option>
                </select>
            </div>
        </div>

        <hr>

        <h4>Entgelttabelle {{ this.region }} gültig ab {{ moment(this.validFrom).format('L') }}</h4>

        <table class="table" v-if="this.salaries.length">
            <thead>
            <tr>
                <th>{{trans('admin.Entgeltgruppe')}}</th>
                <th>{{trans('admin.Entgeltgruppe')}}</th>
                <th>{{trans('admin.Zulage')}} (0,20 €)</th>
                <th>{{trans('admin.Zulage')}} (0,35 €)</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="salary in salaries">
                <td>{{ salary.salary_group }}</td>
                <td>{{ money(salary.base_amount) }} €</td>
                <td><span v-if="salary.extra_pay == 0.2">{{ money(salary.base_amount + salary.extra_pay) }} €</span></td>
                <td><span v-if="salary.extra_pay == 0.35">{{ money(salary.base_amount + salary.extra_pay) }} €</span></td>
            </tr>
            </tbody>
        </table>
        <p v-else>
            {{trans('admin.Keine Entgelttabelle gefunden')}}
        </p>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                salaries: [],
                region: 'West',
                validFrom: '2017-03-01'
            }
        },

        props: ['regions', 'dates'],

        methods: {
            getSalaryTableDate() {
                let data = {
                    'region' : this.region,
                    'valid_from' : this.validFrom
                };

                axios.post('/api/salary/group', data).then((response) => this.salaries = response.data);
            }
        },

        created() {
            this.getSalaryTableDate()
        }
    }
</script>