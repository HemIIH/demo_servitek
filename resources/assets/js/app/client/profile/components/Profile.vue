<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('admin.Stammdaten')}}</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{trans('admin.Kundennummer')}}</label>
                            <div>{{ client.id }}</div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{trans('admin.Firmennanme')}}</label>
                            <div>{{ client.name }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{trans('admin.Vertragsart')}}</label>
                            <div>{{ client.type_of_contract ? client.type_of_contract : '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{trans('admin.Standort')}}</label>
                            <div>{{ client.location }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Weitere Daten</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{trans('admin.IBAN')}}</label>
                            <div>{{ client.iban }}</div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{trans('admin.BIC')}}</label>
                            <div>{{ client.bic }}</div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{trans('admin.Steuernummer')}}</label>
                            <div>{{ client.vat }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                client: this.data
            }
        },
        props: ['data']
    }
</script>
