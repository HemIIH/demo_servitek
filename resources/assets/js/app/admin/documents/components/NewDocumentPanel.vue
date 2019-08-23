<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">{{trans('admin.Neues Dokument')}}</h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <select class="form-control input-sm" v-model="type">
                    <option value="">{{trans('admin.Dokumententyp auswählen')}}</option>
                    <option v-for="(document, key) in documentTypes" :value="key">{{ trans('admin.'+key) }}</option>
                </select>
            </div>

            <div class="clearfix">
                <button @click="create" class="btn btn-sm btn-primary pull-right">{{trans('admin.Auswählen')}}</button>
            </div>

            <hr>

            <div v-if="signature" class="text-center">
                <img class="col-md-12" :src="'/uploads/images/signature/' + signature" alt="Signatur">
            </div>

            <button @click="editSignature" class="btn btn-sm btn-primary btn-block">{{trans('admin.Signatur bearbeiten')}}</button>

        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                type: '',
                signature: this.employee.signature,
                documentTypes: {
                    'warning': trans('Abmahnung'),
                    'pension': trans('Befreiung Rentenversicherungspflicht'),
                    'withdrawal_receipt': trans('Kündigungsbestätigung'),
                    'contract_parttime': trans('Arbeitsvertrag - Teilzeit'),
                    'contract_temporary': trans('Arbeitsvertrag - Geringfügig'),
                    'termination': trans('Ordentliche Kündigung'),
                    'termination_without_notice': trans('Fristlose Kündigung'),
                    'termination_within_probation': trans('Kündigung in der Probezeit')
                }
            }
        },

        props: ['employee'],

        methods: {
            create() {
                if (this.type == '') return;

                let data = {
                    'type': this.type,
                    'employee': this.employee
                };

                modal('Create Document Modal', this.documentTypes[this.type], data);

                this.type = '';
            },

            editSignature() {
                let data = {
                    'employee': this.employee,
                    'signature': this.signature
                }

                modal('Create Signature Modal', trans('Mitarbeiter - Unterschrift'), data);
            }
        },

        created() {
            events.$on('signature.created', (data) => this.signature = data);

            events.$on('signature.deleted', () => this.signature = '');
        }
    }
</script>