<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{trans('admin.Zeiterfassung')}}</h2>
        </div>
        <div class="panel-body">
            <div class="table-view">
                <div class="table-view__header">
                    <div>
                        <i class="pointer fa fa-refresh text-primary" @click.prevent="reset"></i>
                    </div>
                    <div class="table-view__header-columns">
                        <input class="form-control input-sm" v-model="query.search_input" :placeholder="trans('admin.Suche nach')" @keyup.enter="search">
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.client_id" @change="search">
                            <option value="">{{trans('admin.Kunden auswählen')}}</option>
                            <option v-for="client in clients" :value="client.id">{{ client.short_name }}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.time" @change="search">
                            <option value="">{{trans('admin.Zeitraum')}}</option>
                            <option value="-30">{{trans('admin.Letzter Monat')}}</option>
                            <option value="-7">{{trans('admin.Letzte Woche')}}</option>
                            <option value="w">{{trans('admin.Diese Woche')}}</option>
                            <option value="m">{{trans('admin.Diesen Monat')}}</option>
                            <option value="date">{{trans('admin.Auftrag am')}} ..</option>
                            <option value="range">{{trans('admin.Von bis')}}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns" v-show="query.time == 'date'">
                        <datepicker name="date" v-model="query.date" :placeholder="trans('admin.Auftrag am')" @dateSelected="search"></datepicker>
                    </div>
                    <div class="table-view__header-columns" v-show="query.time == 'range'">
                        <datepicker name="start" v-model="query.start" :placeholder="trans('admin.Auftrag vom')"></datepicker>
                    </div>
                    <div class="table-view__header-columns" v-show="query.time == 'range'">
                        <datepicker name="end" v-model="query.end" :placeholder="trans('admin.Auftrag bis')" @dateSelected="search"></datepicker>
                    </div>
                    <div>
                        <button class=" btn btm-default btn-sm" @click="search">{{trans('admin.Filtern')}}</button>
                    </div>
                </div>
                <div class="table-view__body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="pointer" @click="toggleOrder('id')">
                               {{trans('admin.Auftragsnr')}} . <i v-html="getSortingIcon('id')"></i>
                            </th>
                            <th>{{trans('admin.Kunde')}}</th>
                            <th class="pointer" @click="toggleOrder('start_date')">
                              {{trans('admin.Auftragsbeginn')}}  <i v-html="getSortingIcon('start_date')"></i>
                            </th>
                            <th class="pointer" @click="toggleOrder('end_date')">
                               {{trans('admin.Auftragsende')}}  <i v-html="getSortingIcon('end_date')"></i>
                            </th>
                            <th>{{trans('admin.Erfasst')}}</th>
                            <th>{{trans('admin.Benötigte Mitarbeiter')}}</th>
                            <th>{{trans('admin.Aktion')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in model.data">
                            <td><a :href="'/admin/order/' + row.id + '/show'">{{ row.id }}</a></td>
                            <td><a :href="'/admin/client/' + row.client_id + '/show'">{{ row.client.short_name }}</a></td>
                            <td>{{ row.start }}</td>
                            <td>{{ row.end }}</td>
                            <td>{{ row.time_recorded ? row.total : '-' }}</td>
                            <td>{{ row.staff_required }}</td>
                            <td>
                                <a :href="'/admin/order/' + row.id + '/timetracking'" class="btn btn-sm btn-primary">
                                    <i class="fa fa-clock-o"></i>
                                </a>
                                <a :href="'/admin/order/' + row.id + '/attendance-list'" class="btn btn-sm btn-default">
                                    <i class="fa fa-bullhorn"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-view__footer">
                    <div class="table-view__footer-item">
                        <span>{{model.from}} - {{model.to}} {{trans('admin.von')}} {{model.total}}</span>
                    </div>
                    <div class="table-view__footer-item">
                        <div class="table-view__footer-sub">
                            <i class="btn fa fa-angle-double-left pointer" @click="prev()"></i>
                            <input v-model="query.page" class="form-control input-sm" @keyup.enter="search">
                            <i class="btn fa fa-angle-double-right pointer" @click="next()"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Table from '../../../mixins/Table'

    export default {
        data() {
            return {
                query: {
                    id: '',
                    client_id: '',
                    state: '',
                    time: '',
                    date: '',
                    range: '',
                    start: '',
                    end: ''
                }
            }
        },
        props: ['clients'],
        mixins: [Table],

        methods: {
            sendReminder(id) {

                swal({title: trans('Zeiterfassung fehlt'), text:trans('Erinnerung verschicken?')}).then(() => {
                    axios.post('/api/order/' + id + '/attendance-list/reminder').then(() => {
                        flash('Erinnerung verschickt.')
                        this.fetchData()
                    }).catch(() => flash(trans('admin.Erinnerung konnte nicht verschickt werden'), 'error'));
                });
            }
        }
    }
</script>