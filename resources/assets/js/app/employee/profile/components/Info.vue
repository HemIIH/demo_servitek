<template>
    <div>
        <div class="box box-primary">
            <div class="box-body box-profile">
                <div class="pull-left">
                    <i v-if="employee.active" class="fa fa-circle text-success fa-lg"></i>
                    <i v-else class="fa fa-circle text-danger fa-lg"></i>
                </div>

                <h4 class="text-center clearfix">{{trans('employee.Personalnr')}} {{ employee.id }}</h4>

                <img v-if="employee.photo" class="profile-user-img img-responsive img-circle" :src="'/uploads/images/photos/employees/' + employee.photo" alt="Profilbild">

                <h3  class="profile-username text-center">{{ employee.first_name + ' ' + employee.last_name }}</h3>

                <p class="text-muted text-center">{{ employee.sex == 'm' ? trans('employee.männlich') : trans('employee.weiblich') }}</p>

                <p class="text-center"><b>{{trans('employee.Status')}}:</b> {{ employee.active ? trans('employee.Aktiv') : trans('employee.Inaktiv') }}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{trans('employee.E-Mail')}}</b>
                        <div class="pull-right">{{ employee.email }}</div>
                    </li>
                    <li class="list-group-item">
                        <b>{{trans('employee.Telefon')}}</b>
                        <div class="pull-right">{{ employee.phone }}</div>
                    </li>
                    <li class="list-group-item">
                        <b>{{trans('employee.Mobil')}}</b>
                        <div class="pull-right">{{ employee.mobile }}</div>
                    </li>
                    <li class="list-group-item">
                        <b>{{trans('employee.Alter')}}</b>
                        <div class="pull-right">
                            {{ moment().diff(moment(employee.date_of_birth, 'DD.MM.YYYY').format(), 'years') }} {{trans('employee.Jahre')}}
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('employee.Details')}}</h3>
            </div>
            <div class="box-body">
                <strong><i class="fa fa-map-marker margin-r-5"></i> {{trans('employee.Adresse')}}</strong>

                <div class="text-muted">
                    <div>{{ employee.street }}</div>
                    <div>{{ employee.postal_code + ' ' + employee.city }}</div>
                </div>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> {{trans('employee.Einsatzort')}}</strong>

                <p class="text-muted">
                    {{ JSON.parse(employee.locations).join(', ') }}
                </p>

                <hr>

                <strong><i class="fa fa-bank margin-r-5"></i> {{trans('employee.Beschäftiung')}}</strong>

                <div class="text-muted">
                    <div>
                        {{trans('employee.Eintrittsdatum')}}
                        <span class="pull-right">{{ employee.entry_date }}</span>
                    </div>
                    <div v-if="employee.exit_date">
                        {{trans('employee.Austrittsdatum')}}
                        <span class="pull-right">{{ employee.exit_date }}</span>
                    </div>
                    <div>
                        {{trans('employee.Beschäftigungsart')}}
                        <span class="pull-right">{{ employee.occupation_type == 'temporary' ? trans('employee.Geringfügig') : trans('employee.Teilzeit') }}</span>
                    </div>
                    <div>
                        {{trans('employee.Vereinbarte Arbeitszeit')}}
                        <span class="pull-right">{{ employee.contractual_working_hours }} {{trans('employee.Stunden')}}</span>
                    </div>
                </div>

                <hr>

                <strong><i class="fa fa-automobile margin-r-5"></i> {{trans('employee.Sonstiges')}}</strong>

                <div class="text-muted">
                    <div>
                        {{trans('employee.PKW')}}
                        <div class="pull-right">
                            <i v-if="employee.car" class="fa fa-check text-success"></i>
                            <i v-else class="fa fa-ban text-danger"></i>
                        </div>
                    </div>
                    <div>
                        {{trans('employee.Führerschein')}}
                        <div class="pull-right">
                            <i v-if="employee.driving_license" class="fa fa-check text-success"></i>
                            <i v-else class="fa fa-ban text-danger"></i>
                        </div>
                    </div>
                    <div>
                        {{trans('employee.Semesterticket')}}
                        <div class="pull-right">
                            <i v-if="employee.public_transportation" class="fa fa-check text-success"></i>
                            <i v-else class="fa fa-ban text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <wages :wages="employee.wages"></wages>
    </div>
</template>

<script>
    export default {
        props: ['employee']
    }
</script>
