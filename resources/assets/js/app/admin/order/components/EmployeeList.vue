<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('admin.Verfügbare Mitarbeiter')}}
                <span class="pull-right"><i @click="reset" class="fa fa-refresh text-primary pointer"></i></span>
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{trans('admin.Name')}}</label>
                    <input class="form-control input-sm" v-model="query.name">
                </div>
                <div class="col-md-6 form-group">
                    <label>{{trans('admin.Mitarbeiterpool')}}</label>
                    <select class="form-control input-sm" v-model="query.typeOfPool">
                        <option value="free">{{trans('admin.Verfügbar')}}</option>
                        <option value="planned">{{trans('admin.Doppelschicht')}}</option>
                        <option value="blocked">{{trans('admin.Sperrliste')}}</option>
                        <option value="absent">{{trans('admin.Krankheit/Urlaub')}}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <select class="form-control input-sm" v-model="query.occupation_type">
                        <option value="">{{trans('admin.Beschäftigungsart')}}</option>
                        <option value="part_time">{{trans('admin.Teilzeit')}}</option>
                        <option value="temporary">{{trans('admin.Geringfügig')}}</option>
                    </select>
                </div>

                <div class="col-md-6 form-group">
                    <select class="form-control input-sm" v-model="query.role">
                        <option value="">{{trans('admin.Rolle')}}</option>
                        <option v-for="role in roles" :value="role.shortcut">{{ trans('admin.'+role.name) }}</option>
                    </select>
                </div>
            </div>
            <div v-show="! showMoreFilters" class="small">
                <i  @click="showMoreFilters = true" class="fa fa-chevron-down pointer"></i>
                {{trans('admin.Weitere Filter')}}
            </div>
            <div v-show="showMoreFilters">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <select class="form-control input-sm" v-model="query.location">
                            <option value="">{{trans('admin.Einsatzort')}}</option>
                            <option v-for="location in locations" :value="location">{{ trans('admin.'+ location) }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <input class="form-control input-sm" v-model="query.city" placeholder="Wohnort">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <select class="form-control input-sm" v-model="query.sex">
                            <option value="">{{trans('admin.Geschlecht')}}</option>
                            <option value="m">{{trans('admin.Männlich')}}</option>
                            <option value="f">{{trans('admin.Weiblich')}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox" v-model="query.car"> {{trans('admin.PKW')}}
                        </label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox" v-model="query.driving_license"> {{trans('admin.Führerschein')}}
                        </label>
                    </div>
                </div>
            </div>
            <div class="small" v-show="showMoreFilters" >
                <i @click="showMoreFilters = false" class="fa fa-chevron-up pointer margin-r-5"></i>
                {{trans('admin.Filter ausblenden')}}
            </div>

            <br>

            <div v-if="employee != ''" class="row bg-grey-light" style="border-top: 1px solid #d3e0e9;border-bottom: 1px solid #d3e0e9;">
                <div class="col-md-12 margin-b-5">
                    {{ employee.last_name + ', ' + employee.first_name }}
                </div>
                <div class="small">
                    <div class="col-md-5">
                        <span v-if="employee.occupation_type == 'part_time'">{{trans('admin.Teilzeit')}}</span>
                        <span v-if="employee.occupation_type == 'temporary'">{{trans('admin.Geringfügig')}}</span>
                        <span v-if="employee.occupation_type == ''">-</span>
                    </div>
                    <div class="col-md-7">
                        <span>{{ employee.current_working_time_account ? hour(employee.current_working_time_account.actual) : 0 }} {{trans('admin.von')}} {{ employee.current_working_time_account ? hour(employee.current_working_time_account.target) : 0 }} {{trans('admin.Std gearbeitet')}}</span>
                    </div>
                    <div class="col-md-12 margin-t-5">
                        <i class="fa fa-map-marker"></i>
                        {{ employee.locations ? JSON.parse(employee.locations).join(', ') : '-' }}
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th class="sortable" @click="toggleOrder('last_name')">{{trans('admin.Name')}}
                        <span v-if="orderBy.column == 'last_name'">
                            <span v-if="orderBy.direction === 'desc'">&darr;</span>
                            <span v-else>&uarr;</span>
                        </span>
                        <span v-else>&uarr;&darr;</span>
                    </th>
                    <th class="sortable" @click="toggleOrder('working_time_account')">{{trans('admin.AZK')}}
                        <span v-if="orderBy.column == 'working_time_account'">
                            <span v-if="orderBy.direction === 'desc'">&darr;</span>
                            <span v-else>&uarr;</span>
                        </span>
                        <span v-else>&uarr;&darr;</span>
                    </th>
                    <th>{{trans('admin.Vertrag')}}</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="employee in filteredData">
                    <td>
                        <span @click="showDetails(employee)">{{ employee.last_name + ', ' + employee.first_name }}</span>
                    </td>
                    <td>
                        <span :class="checkLimit(employee)" class="padding-r-5 padding-l-5">{{ employee.working_time_account ? hour(employee.working_time_account) + ' Std.' : '0' }}</span>
                    </td>
                    <td>
                        {{ employee.occupation_type == 'full_time' ? trans('VZ') : '' }}
                        {{ employee.occupation_type == 'part_time' ? trans('TZ') : '' }}
                        {{ employee.occupation_type == 'temporary' ? trans('AU') : '' }}
                    </td>
                    <td>
                        <a @click="checkAvailability(employee)" class="btn btn-sm btn-default">
                            <i class="fa fa-plus"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                employees: [],
                roles: [],
                employee: '',

                processing: false,
                showMoreFilters: false,

                query: {
                    typeOfPool: 'free',
                    name: '',
                    sex: '',
                    city: '',
                    role: '',
                    occupation_type: '',
                    driving_license: false,
                    car: false,
                    location: ''
                },

                orderBy: {
                    column: 'last_name',
                    direction: 'asc'
                }
            }
        },
        props: ['order', 'locations'],
        methods: {
            checkAvailability(employee) {

                if (this.processing === true)
                    return;

                this.processing = true;


                axios.get('/api/order/' + this.order.id + '/employee/' + employee.id + '/check').then((response) => {
                    if (response.data.length > 0) {

                        let text = trans("Ruhezeit_wird")+" </br>(ArbZG §5)</br></br>";

                        for (let index = 0; index < response.data.length; index++) {
                            let link = "/order/" + response.data[index].id + "/show";

                            text += "<a target='_blank' href='" + link + "'>"+trans('admin.Auftrag')+"</a> - "+trans('admin.Startzeit')+ ": " + response.data[index].start_time.slice(0, 5) + " "+trans('admin.Uhr') +" am " + response.data[index].start;
                        }

                        swal({
                            title: trans('admin.Möglicher Konflikt?'),
                            html: text,
                            type: 'info',
                            confirmButtonText: trans('admin.Fortsetzten!')
                        }).then(() =>
                            this.add(employee), () => this.processing = false
                        )
                    } else {
                        this.add(employee);
                    }
                });
            },

            checkLimit(employee) {
                if (employee.working_time_account > employee.target) {
                    return 'bg-red';
                } else if (employee.working_time_account >= 0) {
                    return '';
                } else {
                    return 'bg-green';
                }
            },

            reset() {
                Object.assign(this.$data.query, this.$options.data().query);
            },

            add(employee) {
                axios.get('/api/order/' + this.order.id + '/employee/' + employee.id + '/assign?role=' + this.query.role)
                        .then(() => {
                            this.employees.splice(this.employees.indexOf(employee), 1);

                            events.$emit('employee.added', employee.id);
                        }).then(() => this.processing = false);
            },

            getEmployees() {
                let param = this.locations.join(',');

                axios.get('/api/order/' + this.order.id + '/employees/available?locations=' + param).then((response) =>
                        this.employees = response.data
                );
            },

            getEmployee: function (id) {
                axios.get('/api/employee/' + id).then((response) => this.employees.push(response.data));
            },

            getRoles() {
                axios.get('/api/roles').then((response) => this.roles = response.data);
            },

            toggleOrder(column) {
                if (column === this.orderBy.column) {
                    this.orderBy.direction === 'desc' ? this.orderBy.direction = 'asc' : this.orderBy.direction = 'desc'
                } else {
                    this.orderBy.column = column;
                    this.orderBy.direction = 'asc';
                }
            },

            showDetails(employee) {
                this.employee == '';

                axios.get('/api/employee/' + employee.id).then((response) => this.employee = response.data);
            }
        },
        computed: {
            filteredData() {

                if (this.employees.length === 0)
                    return

                let data = this.employees.filter((row) => {
                    return  (row['last_name'] + row['first_name']).toLowerCase().indexOf(this.query.name.toLowerCase()) > -1 &&
                            row['sex'].indexOf(this.query.sex) > -1 &&
                            row['city'].toLowerCase().indexOf(this.query.city.toLowerCase()) > -1 &&
                            row['occupation_type'].indexOf(this.query.occupation_type) > -1 &&
                            (this.query.role ? row['roles'].filter(role => role.shortcut == this.query.role).length > 0 : row['roles']) &&
                            row['status'] == this.query.typeOfPool &&
                            (this.query.location.length > 0 ? row['locations'].indexOf(this.query.location) > -1 : row['locations'] !== null) &&
                            (this.query.car ? String(row['car']) == this.query.car : String(row['car']) !== null) &&
                            (this.query.driving_license ? String(row['driving_license']) == this.query.driving_license : String(row['driving_license']) !== null)
                });

                if (this.orderBy.column === 'working_time_account') {
                    if (this.orderBy.direction === 'asc') {
                        data.sort((a, b) => {
                            return parseFloat(a[this.orderBy.column]) - parseFloat(b[this.orderBy.column]);
                        })
                    } else {
                        data.sort((a, b) => {
                            return parseFloat(b[this.orderBy.column]) - parseFloat(a[this.orderBy.column]);
                        })
                    }
                } else if (this.orderBy.column === 'last_name' || this.orderBy.column === 'occupation_type') {
                    if (this.orderBy.direction === 'asc') {
                        data.sort((a, b) => {
                            if (a[this.orderBy.column] < b[this.orderBy.column])
                                return -1;

                            if (a[this.orderBy.column] > b[this.orderBy.column])
                                return 1;

                            return 0;
                        })
                    } else {
                        data.sort((a, b) => {
                            if (a[this.orderBy.column] > b[this.orderBy.column])
                                return -1;

                            if (a[this.orderBy.column] < b[this.orderBy.column])
                                return 1;

                            return 0;
                        })
                    }
                }

                return data
            }
        },
        created() {
            this.getEmployees();
            this.getRoles();

            events.$on('employee.deleted', this.getEmployees);
        }
    }

</script>