<template>
    <div class="table-view">
        <div class="table-view__header">
            <div>
                <i class="pointer fa fa-refresh text-primary" @click.prevent="reset"></i>
            </div>
            <div class="table-view__header-columns">
                <input class="form-control input-sm" v-model="query.search_input" :placeholder="trans('admin.Suche nach')" @keyup.enter="search">
            </div>
            <div class="table-view__header-columns">
                <datepicker v-model="query.date" :placeholder="trans('admin.Rechnungsdatum')" @dateSelected="search"></datepicker>
            </div>
            <div class="table-view__header-columns">
                <select class="form-control input-sm" v-model="query.client_id" @change="search">
                    <option value="">{{trans('admin.Kunde')}}</option>
                    <option v-for="client in clients" :value="client.id">{{ client.name }}</option>
                </select>
            </div>
            <div class="table-view__header-columns">
                <select class="form-control input-sm" v-model="query.state" @change="search">
                    <option value="">{{trans('admin.Status')}}</option>
                    <option value="paid">{{trans('admin.Bezahlt')}}</option>
                    <option value="open">{{trans('admin.Offen')}}</option>
                    <option value="due">{{trans('admin.Überfällig')}}</option>
                    <option value="archived">{{trans('admin.Archiviert')}}</option>
                </select>
            </div>
            <div class="table-view__header-columns">
                <select class="form-control input-sm" v-model="query.time" @change="search">
                    <option value="">{{trans('admin.Zeitraum')}}</option>
                    <option value="-30">{{trans('admin.Letzter Monat')}}</option>
                    <option value="-7">{{trans('admin.Letzte Woche')}}</option>
                    <option value="w">{{trans('admin.Diese Woche')}}</option>
                    <option value="m">{{trans('admin.Diesen Monat')}}</option>
                    <option value="date">{{trans('admin.Rechnung vom')}}</option>
                    <option value="range">{{trans('admin.Von bis')}}</option>
                </select>
            </div>
            <div class="table-view__header-columns" v-show="query.time == 'date'">
                <datepicker name="date" v-model="query.date" :placeholder="trans('admin.Rechnung vom')" @dateSelected="search"></datepicker>
            </div>
            <div class="table-view__header-columns" v-show="query.time == 'range'">
                <datepicker name="start" v-model="query.start" :placeholder="trans('admin.Auftrag vom')"></datepicker>
            </div>
            <div class="table-view__header-columns" v-show="query.time == 'range'">
                <datepicker name="end" v-model="query.end" :placeholder="trans('admin.Auftrag bis')" @dateSelected="search"></datepicker>
            </div>
            <div>
                <button class="btn btm-default btn-sm" @click="search">{{trans('admin.Filtern')}}</button>
            </div>
        </div>
        <div class="table-view__body">
            <table class="table">
            <thead>
            <tr>
                <th class="pointer" @click="toggleOrder('id')">
                    {{trans('admin.Rechnungsnr')}}. <i v-html="getSortingIcon('id')"></i>
                </th>
                <th class="pointer" @click="toggleOrder('invoice_date')">
                    {{trans('admin.Rechnungsdatum')}} <i v-html="getSortingIcon('invoice_date')"></i>
                </th>
                <th class="pointer" @click="toggleOrder('name')">
                    {{trans('admin.Kunde')}} <i v-html="getSortingIcon('name')"></i>
                </th>
                <th class="pointer" @click="toggleOrder('sum')">
                    {{trans('admin.Betrag')}} <i v-html="getSortingIcon('sum')"></i>
                </th>
                <th>
                    <span>{{trans('admin.Bezahlt')}}</span>
                </th>
                <th v-if="canUpdate || canDelete">{{trans('admin.Aktion')}}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in model.data">
                <td><a :href="source + '/' + row.id + '/show'" target="_blank">{{ row.id }}</a></td>
                <td>{{ moment(row.invoice_date).format('L') }}</a></td>
                <td><a :href="'client/' + row.client_id + '/show'">{{ row.client.name }}</a></td>
                <td>{{ money(row.sum) }} €</td>
                <td>
                    <span v-if="row.pay_date" @click="markAsUnpaid(row.id)" class="label label-success">{{trans('admin.Bezahlt')}} : {{ moment(row.pay_date).format('L') }}</span>
                    <div v-else>
                        <span v-if="moment(row.due).format() < moment().format()" @click="markAsPaid(row.id)" class="label label-warning">{{trans('admin.Überfällig seit')}} {{ moment().diff(moment(row.due), 'days') }} {{trans('admin.Tagen')}}</span>
                        <span v-else @click="markAsPaid(row.id)" class="label label-danger">{{trans('admin.Offen')}}</span>
                    </div>
                </td>
                <td v-if="canUpdate || canDelete">
                    <a v-if="canUpdate && ! row.archived" :href="source + '/' + row.id + '/edit'" class="btn btn-sm btn-default">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                    <a :href="source + '/' + row.id + '/show'" target="_blank" class="btn btn-sm btn-default">
                        <i class="fa fa-file-pdf-o fa-lg"></i>
                    </a>
                    <a :href="source + '/' + row.id + '/proof-of-work'" target="_blank" class="btn btn-sm btn-default">
                        <i class="fa fa-clock-o fa-lg"></i>
                    </a>
                    <a v-if="row.sent && ! row.archived" :href="source + '/' + row.id + '/prepare'" class="btn btn-sm btn-success">
                        <i class="fa fa-envelope fa-lg"></i>
                    </a>
                    <a v-if="! row.sent && ! row.archived" :href="source + '/' + row.id + '/prepare'" class="btn btn-sm btn-default">
                        <i class="fa fa-envelope fa-lg"></i>
                    </a>
                    <a v-if="! row.archived" :href="source + '/' + row.id + '/archive'" class="btn btn-sm btn-default" @click.prevent="archive(row.id)">
                        <i class="fa fa-archive fa-lg"></i>
                    </a>
                    <a v-if="row.archived && query.state == 'archived'" :href="source + '/' + row.id + '/unarchive'" class="btn btn-sm btn-default" @click.prevent="unarchive(row.id)">
                        <i class="fa fa-undo fa-lg"></i>
                    </a>
                    <a v-if="canDelete && row.archived" :href="source + '/' + row.id + '/delete'" class="btn btn-sm btn-danger" @click.prevent="deleteRessource">
                        <i class="fa fa-times fa-lg"></i>
                    </a>
                    <a v-if="! row.archived" class="btn btn-sm btn-danger" @click.prevent="abort(row.id)">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
            </tbody>
            <tfoot v-if="model.data && model.data.length > 0">
            <tr>
                <td colspan="3">{{trans('admin.Summe')}}</td>
                <td>{{ money(sum) }} €</td>
                <td colspan="3"></td>
            </tr>
            </tfoot>
        </table>
        </div>
        <div class="table-view__footer">
            <div class="table-view__footer-item">
                <span>{{model.from}} - {{model.to}} {{trans('admin.von')}} {{model.total}}</span>
            </div>
            <div class="table-view__footer-item">
                <div class="table-view__footer-sub">
                    <i class="btn fa fa-angle-double-left" @click="prev()"></i>
                    <input v-model="query.page" class="form-control input-sm" @keyup.enter="search">
                    <i class="btn fa fa-angle-double-right" @click="next()"></i>
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
                    start: '',
                    end: ''
                }
            }
        },

        computed: {
            sum() {
                if (! this.model.data.length)
                    return;

                return this.model.data.map(item => item.sum).reduce((prev, next) => prev + next);
            }
        },

        props: ['clients'],
        mixins: [Table],

        methods: {

            markAsPaid(id) {

                swal({
                    title: trans('admin.Als bezahlt markieren?'),
                    text: trans('admin.Rechnung wurde bezahlt am'),
                    input: 'text',
                    preConfirm: (date) => {
                        return new Promise((resolve) => {
                            setTimeout(() => {
                                if (date === '' || date.match(/^\d{2}[.]\d{2}[.]\d{4}$/) == null) {
                                    swal.showValidationError(trans('admin.Bitte  ein Datum eingeben!'))
                                } else {
                                    resolve();
                                }
                            }, 500)

                        })
                    },
                }).then((date) => {
                    if (date) {
                        let data = {'pay_date': date};

                        axios.post('/api/invoice/' + id + '/mark-as-paid', data).then(() => {
                            this.fetchData();
                        });
                    }
                });
            },
            markAsUnpaid(id) {

                swal({title: trans('admin.Als unbezahlt markieren?')}).then(() => {
                    axios.post('/api/invoice/' + id + '/mark-as-unpaid').then(() => this.fetchData());
                });
            },
            archive(id) {

                swal({title: trans('admin.Rechnung archivieren?')}).then(() => {
                    axios.post('/api/invoice/' + id + '/archive').then(() => this.fetchData());
                });
            },
            unarchive(id) {

                swal({title: trans('admin.Rechnung verschieben?')}).then(() => {
                    axios.post('/api/invoice/' + id + '/unarchive').then(() => this.fetchData());
                });
            },

            abort(id) {

                swal({title: trans('admin.Rechnung verwerfen?')}).then(() => {
                    axios.post('/api/invoice/' + id + '/delete').then(() => {
                        flash(trans('admin.Rechnung verworfen und zurückgesetzt'), 'success');

                        this.fetchData();
                    });
                });
            }

        }
    }
</script>