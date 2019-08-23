<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <legend v-text="trans('admin.'+textblocks.disclaimer.label)"></legend>
            </div>
            <div class="col-md-2"><i @click="edit('disclaimer')" class="fa fa-pencil fa-lg pointer"></i></div>
            <div class="col-md-10 form-group text-justify">
                <p v-html="textblocks.disclaimer.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <legend v-text="trans('admin.'+textblocks.signature.label)"></legend>
            </div>
            <div class="col-md-2"><i @click="edit('signature')" class="fa fa-pencil fa-lg pointer"></i></div>
            <div class="col-md-10 form-group text-justify">
                <p v-html="textblocks.signature.value"></p>
            </div>
        </div>
    </div>
</template>

<script>
    import Textblock from '../mixins/Textblock'

    export default {
        data() {
            return {
                element: 'operation_plan',
                modalName: 'Edit Operationplan Modal'
            }
        },

        mixins: [Textblock]
    }
</script>