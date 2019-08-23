<template>
    <div>
        <div v-show="signature">
            <img style="height: 150px; width: auto;" :src="'/uploads/images/signature/' + signature" alt="Signatur">

            <div class="pull-right">
                <button @click="destroy" class="btn btn-danger">{{trans('admin.Löschen')}}</button>
            </div>
        </div>

        <div v-show="! signature">
            <div class="margin-r-10 margin-l-10">
                <canvas style="border:1px solid gray;" id="signature-pad" width="700" height="300"></canvas>
            </div>
            <div class="pull-right">
                <button @click="save" class="btn btn-primary">{{trans('admin.Speichern')}}</button>
                <button @click="clear" class="btn btn-danger">{{trans('admin.Abbrechen')}}</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                signaturePad: '',
                signature: this.data.signature
            }
        },
        props: ['data'],

        methods: {
            save() {
                let data = this.signaturePad.toDataURL('image/png');

                axios.post('/api/employee/' + this.data.employee.id + '/signature', {data}).then((response) => {
                    events.$emit('signature.created', response.data);

                    this.$parent.$emit('close')
                }).catch((error) => console.log(error));
            },

            clear() {
                this.signaturePad.clear();

                this.$parent.$emit('close')
            },

            destroy() {
                axios.delete('/api/employee/' + this.data.employee.id + '/signature').then(() => {
                    this.signature = '';

                    events.$emit('signature.deleted');
                }).catch((error) => console.log(error));
            }
        },

        mounted() {
            let element = document.getElementById('signature-pad');

            if (element) {
                this.signaturePad = new SignaturePad(element, {
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    penColor: 'rgb(0, 0, 0)'
                });
            }

        }
    }
</script>

