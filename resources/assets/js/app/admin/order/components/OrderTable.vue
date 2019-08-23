<template>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
                {{trans('admin.Auftragsliste')}}
                <button v-if="canCreate" href="#" @click="newOrder" class="btn btn-primary pull-right">{{trans('admin.Neuer Auftrag')}}</button>
            </h2>
        </div>
        <div class="panel-body">
            <div class="table-view">
                <div class="table-view__header">
                    <div>
                        <i class="pointer fa fa-refresh text-primary" @click="reset"></i>
                    </div>
                    <div class="table-view__header-columns">
                        <input class="form-control input-sm" v-model="query.search_input" :placeholder="trans('admin.Suche nach')" @keyup.enter="search">
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.client_location" @change="search">
                            <option value="">{{trans('admin.Standort auswählen')}}</option>
                            <option value="Bonn">{{trans('admin.Bonn')}}</option>
                            <option value="Köln">{{trans('admin.Köln')}}</option>
                            <option value="Düsseldorf">{{trans('admin.Düsseldorf')}}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.client_id" @change="search">
                            <option value="">{{trans('admin.Kunden auswählen')}}...</option>
                            <option v-for="client in clients" :value="client.id">{{ client.name }}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.status" @change="search">
                            <option value="">{{trans('admin.Status')}}</option>
                            <option value="canceled">{{trans('admin.Storno')}}</option>
                            <option value="requested">{{trans('admin.Angefragt')}}</option>
                            <option value="time_recorded">{{trans('admin.Zeiterfasst')}}</option>
                            <option value="not_recorded">{{trans('admin.Nicht zeiterfasst')}}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.time" @change="search">
                            <option value="">{{trans('admin.Zeitraum')}}</option>
                            <option value="-30">{{trans('admin.Letzter Monat')}}</option>
                            <option value="-7">{{trans('admin.Letzte Woche')}}</option>
                            <option value="w">{{trans('admin.Diese Woche')}}</option>
                            <option value="m">{{trans('admin.Diesen Monat')}}</option>
                            <option value="7">{{trans('admin.Nächste Woche')}}</option>
                            <option value="14">{{trans('admin.Nächste 2 Wochen')}}</option>
                            <option value="30">{{trans('admin.Nächsten Monat')}}</option>
                            <option value="date">{{trans('admin.Auftrag am')}}</option>
                            <option value="range">{{trans('admin.Von  bis')}}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns" v-show="query.time == 'date'">
                        <datepicker name="date" v-model="query.date" :placeholder="trans('admin.Auftrag am')" @dateSelected="search"></datepicker>
                    </div>
                    <div class="table-view__header-columns" v-show="query.time == 'range'">
                        <datepicker name="start" v-model="query.start" :placeholder="trans('admin.Auftrag vom')" @keyup.enter="search"></datepicker>
                    </div>
                    <div class="table-view__header-columns" v-show="query.time == 'range'">
                        <datepicker name="end" v-model="query.end" :placeholder="trans('admin.Auftrag bis')" @keyup.enter="search"></datepicker>
                    </div>
                    <div>
                        <button class="btn btn-default btn-sm" @click="search">{{trans('admin.Filtern')}}</button>
                    </div>
                </div>
                <div class="table-view__body">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="sortable" @click="toggleOrder('id')">
                            {{trans('admin.Auftragsnr')}} <i v-html="getSortingIcon('id')"></i>
                        </th>
                        <th>{{trans('admin.Mitarbeiter')}}</th>
                        <th>{{trans('admin.Kunde')}}</th>
                        <th class="sortable" @click="toggleOrder('client_location')">
                            {{trans('admin.Standort')}} <i v-html="getSortingIcon('client_location')"></i>
                        </th>
                        <th class="sortable" @click="toggleOrder('start_date')">
                            {{trans('admin.Beginn')}} <i v-html="getSortingIcon('start_date')"></i>
                        </th>
                        <th class="sortable" @click="toggleOrder('end_date')">
                            {{trans('admin.Ende')}} <i v-html="getSortingIcon('end_date')"></i>
                        </th>
                        <th>{{trans('admin.Erfasst')}}</th>
                        <th>{{trans('admin.Status')}}</th>
                        <th>
                            <span class="dv-table-column">{{trans('admin.Aktion')}}</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="row in model.data">
                        <td width="45px">
                            <span v-if="row.parent_id" :title=" trans('admin.Unterauftrag von Auftrag') + row.parent_id" class="pull-left"><i class="fa fa-child"></i></span>
                            <span v-if="row.is_parent" class="pull-left" :title="trans('admin.Hauptauftrag')"><i class="fa fa-universal-access"></i></span></td>
                        <td><a :href="source + '/' + row.id + '/show'">{{ row.id }}</a></td>
                        <td>{{ row.staff_planned }} {{trans('admin.von')}} {{ row.staff_required }}</td>
                        <td><a :href="'client/' + row.client_id + '/show'">{{ row.client.short_name }}</a></td>
                        <td>{{ row.client_location }}</td>
                        <td>{{ row.start }}</td>
                        <td>{{ row.end }}</td>
                        <td><span v-if="row.time_recorded">{{ hour(row.total_min/60) }} {{trans('admin.Std')}}.</span><span v-else>-</span></td>
                        <td>
                            <i :title="trans('admin.Angefragt')" v-if="row.status == 'requested'" class="fa fa-question fa-lg text-warning"></i>
                            <i :title="trans('admin.Zeiterfasst')" v-if="row.time_recorded" class="fa fa-clock-o fa-lg text-success"></i>
                            <i :title="trans('admin.Storniert')" v-if="row.status == 'canceled'" class="fa fa-ban fa-lg text-danger"></i>
                            <i :title="trans('admin.Öffentlich')" v-if="row.status == 'public'" class="fa fa-eye fa-lg text-info"></i>
                        </td>
                        <td>
                            <a v-if="canUpdate" @click="editOrder(row)" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a :href="source + '/' + row.id + '/timetracking'" class="btn btn-sm btn-primary">
                                <i class="fa fa-clock-o"></i>
                            </a>
                            <a v-if="row['sent']" :href="source + '/' + row.id + '/attendance-list'" class="btn btn-sm btn-success" title="moment(row['sent]).format('lll') + trans('admin.Uhr')">
                                <i class="fa fa-envelope-o"></i>
                            </a>
                            <a v-if="! row['sent']" :href="source + '/' + row.id + '/attendance-list'" class="btn btn-sm btn-default">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <a v-if="canDelete" class="btn btn-sm btn-default" @click="deleteRessource(row.id)">
                                <i class="fa fa-times"></i>
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
                            <input v-model="query.page" class="form-control input-sm" @keyup.enter="fetchData">
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
                    client_id: '',
                    client_location: '',
                    status: '',
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
            newOrder() {
                let data = {
                    'startDate': '',
                    'clients' : this.clients
                };

                modal('New Order Modal', trans('admin.Neuer Auftrag'), data);
            },

            editOrder(order) {
                let data = {
                    'order': order
                };

                modal('Edit Order Modal', trans('admin.Auftrag bearbeiten'), data);
            }
        },

        created() {
            events.$on(['order.created', 'order.updated'], this.fetchData);
        }

    }
</script>