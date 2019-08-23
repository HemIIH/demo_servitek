<template>
    <div>
        <div class="box box-primary">
            <div class="box-body box-profile">
                <div class="pull-left">
                    <i v-if="client.active" class="fa fa-circle fa-2x text-success"></i>
                    <i v-else class="fa fa-circle fa-2x text-danger"></i>
                </div>

                <h4 class="text-center clearfix">{{trans('admin.Kundennr')}} {{ client.id }}</h4>

                <img v-if="client.logo" class="profile-user-img img-responsive" :src="client.logo" alt="Profilbild" style="border: none; !important">

                <h3 class="profile-username text-center">{{ client.name }}</h3>

                <p class="text-center"><b>Status:</b> {{ client.active ? trans('admin.Aktiv') : trans('admin.Inaktiv') }}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Vertragsart</b> <span class="pull-right">{{ client.type_of_contract ? client.type_of_contract : '-' }}</span>
                    </li>
                    <li v-if="client.locations" class="list-group-item">
                        <b>Standorte</b> <span class="pull-right">{{ client.locations.replace(/["\[\]]/g, '') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.Details')}}</h3>
            </div>
            <div class="box-body">
                <strong><i class="fa fa-map-marker margin-r-5"></i>{{trans('admin.Adresse')}}</strong>

                <p class="text-muted">
                    {{ client.street }}<br>
                    {{ client.postal_code }} {{ client.city }}
                </p>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['client']
    }
</script>
