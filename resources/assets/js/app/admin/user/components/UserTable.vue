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
                <select class="form-control input-sm" v-model="query.usertype" @change="search">
                    <option value="">{{trans('admin.Type')}}</option>
                    <option value="internal">{{trans('admin.Intern')}}</option>
                    <option value="client">{{trans('admin.Kunde')}}</option>
                    <option value="employee">{{trans('admin.Mitarbeiter')}}</option>
                </select>
            </div>
            <div class="table-view__header-columns">
                <select class="form-control input-sm" v-model="query.role" @change="search">
                    <option value="">{{trans('admin.Rolle')}}</option>
                    <option value="master_admin">{{trans('admin.Master Admin')}}</option>
                    <option value="manager">{{trans('admin.Manager')}}</option>
                    <option value="local_manager">{{trans('admin.Filialleiter')}}</option>
                    <option value="accountant">{{trans('admin.Lohnbuchhalter')}}</option>
                </select>
            </div>
            <div class="table-view__header-columns">
                <select class="form-control input-sm" v-model="query.state" @change="search">
                    <option value="">{{trans('admin.Status')}}</option>
                    <option value="1">{{trans('admin.Aktiv')}}</option>
                    <option value="0">{{trans('admin.Inaktiv')}}</option>
                </select>
            </div>
            <div>
                <button class="btn btm-default btn-sm" @click="search">{{trans('admin.Filtern')}}</button>
            </div>
        </div>
        <div class="table-view__body">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <span class="sortable" @click="toggleOrder('id')">{{trans('admin.ID')}}</span>
                        <span class="sortable" @click="toggleOrder('id')">{{trans('admin.Kundennr')}}</span>
                        <i v-if="query.column != 'invoice_date'">&uarr;&darr;</i>
                        <span v-else>
                            <i v-if="query.direction === 'desc'">&darr;</i>
                            <i v-else>&uarr;</i>
                        </span>
                    </th>
                    <th>
                        <span class="sortable" @click="toggleOrder('invoice_date')">{{trans('admin.Name')}}</span>
                        <span class="sortable" @click="toggleOrder('invoice_date')">{{trans('admin.Kundennr')}}</span>
                        <i v-if="query.column != 'invoice_date'">&uarr;&darr;</i>
                        <span v-else>
                            <i v-if="query.direction === 'desc'">&darr;</i>
                            <i v-else>&uarr;</i>
                        </span>
                    </th>
                    <th>E-Mail</th>
                    <th>{{trans('admin.Typ')}}</th>
                    <th>{{trans('admin.Rolle')}}</th>
                    <th>Status</th>
                    <th v-if="canUpdate || canDelete">{{trans('admin.Aktion')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="row in model.data">
                    <td><a :href="'/admin/settings/' + source + '/' + row.id + '/show'">{{ row.id }}</a></td>
                    <td><a :href="'/admin/settings/' + source + '/' + row.id + '/show'">{{ row.name }}</a></td>
                    <td>{{ row.email }}</td>
                    <td>{{ row.usertype }}</td>
                    <td>{{ row.roleName }}</td>
                    <td>
                        <span v-if="row.active == 1" class="label label-success">{{trans('admin.Aktiv')}}</span>
                        <span v-else class="label label-warning">{{trans('admin.Inaktiv')}}</span>
                    </td>
                    <td v-if="canUpdate || canDelete">
                        <a :href="'/admin/settings/' + source + '/' + row.id + '/show'" v-if="canUpdate" class="btn btn-sm btn-primary">
                            <span class="fa fa-pencil"></span>
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
                    state: '',
                    role: '',
                    usertype: ''
                }
            }
        },
        props: ['users'],
        mixins: [Table]
    }
</script>