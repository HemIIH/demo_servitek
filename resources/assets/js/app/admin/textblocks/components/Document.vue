<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <legend>{{trans('admin.Mail')}}</legend>
            </div>
            <div class="col-md-2"><i @click="edit('mail')" class="fa fa-pencil fa-lg pointer"></i></div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label v-text="trans('admin.'+textblocks.subject.label)"></label>
                <p v-text="textblocks.subject.value"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.mail_body.label)"></label>
                <p v-html="textblocks.mail_body.value"></p>
            </div>
        </div>
    </div>
</template>

<script>
    import Textblock from '../mixins/Textblock'

    export default {
        data() {
            return {
                element: 'document',
                modalName: 'Edit Document Modal'
            }
        },

        mixins: [Textblock]
    }
</script>