<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
                {{trans('admin.Mitarbeiterliste')}}
                <a v-if="canCreate" @click="newEmployee" class="btn btn-primary pull-right">{{trans('admin.Neuer Mitarbeiter')}}</a>
            </h2>
        </div>
        <div class="panel-body">

            <ul class="nav nav-tabs margin-b-10">
                <li role="presentation" :class="{ 'active' : query.state == 'active' }"><a href="#" @click.prevent="setState('active')">{{trans('admin.Aktiv')}}</a></li>
                <li role="presentation" :class="{ 'active' : query.state == 'inactive' }"><a href="#" @click.prevent="setState('inactive')">{{trans('admin.Inaktiv')}}</a></li>
                <li role="presentation" :class="{ 'active' : query.state == 'terminated' }"><a href="#" @click.prevent="setState('terminated')">{{trans('admin.Ausgeschieden')}}</a></li>
                <li role="presentation" :class="{ 'active' : query.state == 'applied' }"><a href="#" @click.prevent="setState('applied')">{{trans('admin.Bewerber')}}</a></li>
            </ul>

            <div class="table-view">
                <div class="table-view__header">
                    <div>
                        <i class="pointer fa fa-refresh text-primary" @click.prevent="reset"></i>
                    </div>
                    <div class="table-view__header-columns">
                        <input class="form-control input-sm" v-model="query.search_input" :placeholder="trans('admin.Suche nach')" @keyup.enter="search">
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.location" @change="search">
                            <option value="">{{trans('admin.Einsatzort auswählen')}}</option>
                            <option value="Bonn">{{trans('admin.Bonn')}}</option>
                            <option value="Köln">{{trans('admin.Köln')}}</option>
                            <option value="Düsseldorf">{{trans('admin.Düsseldorf')}}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.occupation_type" @change="search">
                            <option value="">{{trans('admin.Vertragsart')}}</option>
                            <option value="part_time">{{trans('admin.Teilzeit')}}</option>
                            <option value="temporary">{{trans('admin.Geringfügig')}}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.sex" @change="search">
                            <option value="">{{trans('admin.Geschlecht')}}</option>
                            <option value="m">{{trans('admin.Männlich')}}</option>
                            <option value="f">{{trans('admin.Weiblich')}}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.state" @change="search">
                            <option value="">{{trans('admin.Status')}}</option>
                            <option value="active">{{trans('admin.Aktiv')}}</option>
                            <option value="inactive">{{trans('admin.Inaktiv')}}</option>
                            <option value="terminated">{{trans('admin.Ausgeschieden')}}</option>
                            <option value="applied">{{trans('admin.Bewerber')}}</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btm-default btn-sm" @click="search">{{trans('admin.Filtern')}}</button>
                    </div>
                </div>
                <div class="table-view__body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="pointer" @click="toggleOrder('id')">
                                {{trans('admin.Personalnr')}} <i v-html="getSortingIcon('id')"></i>
                            </th>
                            <th class="pointer" @click="toggleOrder('last_name')">
                                {{trans('admin.Name')}} <i v-html="getSortingIcon('last_name')"></i>
                            </th>
                            <th class="pointer" @click="toggleOrder('working_time_account')">
                                {{trans('admin.AZK')}} <i v-html="getSortingIcon('working_time_account')"></i>
                            </th>
                            <th class="pointer" @click="toggleOrder('city')">
                                {{trans('admin.Stadt')}} <i v-html="getSortingIcon('city')"></i>
                            </th>
                            <th>{{trans('admin.Einsatzort')}}</th>
                            <th>{{trans('admin.Mobil_')}}</th>
                            <th>{{trans('admin.E-Mail')}}</th>
                            <th>{{trans('admin.Status')}}</th>
                            <th v-if="canUpdate || canDelete">
                                <span>{{trans('admin.Aktion')}}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in model.data">
                            <td>
                                <a :href="source + '/' + row.id + '/show'">{{ row.id }}</a>
                            </td>
                            <td>
                                <a :href="source + '/' + row.id + '/show'">{{ row.last_name }}, {{ row.first_name }}</a>
                            </td>
                            <td>
                                <i v-if="row.working_time_account > row.target" class="small fa fa-circle text-danger margin-r-5"></i>
                                <i v-else-if="row.working_time_account < -21" class="small fa fa-circle text-success margin-r-5"></i>
                                <i v-else class="small fa fa-circle text-warning margin-r-5"></i>
                                {{ row.working_time_account ? hour(row.working_time_account) + ' Std.' : '-'}}
                            </td>
                            <td>{{ row.city }}</td>
                            <td>
                                {{ (row.locations != null || ! row.locations) ? JSON.parse(row.locations).join(', ') : '-' }}
                            </td>
                            <td>{{ row.mobile }}</td>
                            <td>{{ row.email }}</td>
                            <td>
                                <div v-if="row.applicant">
                                    <span class="label label-warning">{{trans('admin.Bewerber')}}</span>
                                </div>
                                <div v-else>
                                    <span v-if="row.active" class="label label-success">{{trans('admin.Aktiv')}}</span>
                                    <span v-else class="label label-danger">{{trans('admin.Inaktiv')}}</span>
                                </div>
                            </td>
                            <td v-if="canUpdate || canDelete">
                                <a :href="source + '/' + row.id + '/show'" v-if="canUpdate" class="btn btn-sm btn-primary">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a v-if="canDelete" class="btn btn-sm btn-default" @click="deleteRessource(row.id)">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
    </div>
</template>
<script>
    import Table from '../../../mixins/Table'

    export default {
        mixins: [Table],
        data() {
            return {
                query: {
                    location: '',
                    sex: '',
                    occupation_type: '',
                    state: 'active'
                }
            }
        },

        methods: {
            setState(state) {
                this.query.state = state;

                this.search();
            },

            newEmployee() {
                modal('New Employee Modal', trans('admin.Neuer Mitarbeiter'), {});
            }
        },

        created() {
            events.$on('employee.created', this.fetchData);
        }
    }
</script>