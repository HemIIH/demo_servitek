<template>
    <div class="box box-primary">
        <div class="box-header">
            {{trans('admin.Verrechnungssatz')}}
        </div>
        <div class="box-body box-profile" v-if="rates.length">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{trans('admin.Gültig ab')}}</label>
                    <div>{{ moment(rates[0].valid_from).format('L') }}</div>
                </div>
                <div class="col-md-6 form-group">
                    <label>{{trans('admin.Betrag in')}} €</label>
                    <div>{{ money(rates[0].amount) }}</div>
                </div>
            </div>

            <table v-if="rates.length > 1" class="table">
                <thead>
                <tr>
                    <th>{{trans('admin.Gültig von')}}</th>
                    <th>{{trans('admin.Gültig bis')}}</th>
                    <th>{{trans('admin.Betrag')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="rate in rates">
                    <td>
                        {{ moment(rate.valid_from).format('ll') }}
                    </td>
                    <td>
                        {{ rate.valid_to ? moment(rate.valid_to).format('ll') : '-' }}
                    </td>
                    <td>
                        {{ money(rate.amount) }} €
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['rates'],
    }
</script>
