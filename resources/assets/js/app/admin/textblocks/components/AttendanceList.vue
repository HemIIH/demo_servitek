<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <legend>{{trans('admin.E-Mail')}}</legend>
            </div>
            <div class="col-md-2">
                <i @click="edit('email')" class="fa fa-pencil fa-lg pointer"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.mail_body.label)"></label>
                <p v-html="textblocks.mail_body.value"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <legend>{{trans('admin.PDF')}}</legend>
            </div>
            <div class="col-md-2">
                <i @click="edit('pdf')" class="fa fa-pencil fa-lg pointer"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.header.label)"></label>
                <p v-html="textblocks.header.value"></p>
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary pull-right" :href="'/admin/settings/textblocks/attendance-list/pdf'" target="_blank">{{trans('admin.Vorschau')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.call_to_action.label)"></label>
                <p v-html="textblocks.call_to_action.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.disclaimer.label)"></label>
                <p v-html="textblocks.disclaimer.value"></p>
            </div>
        </div>
    </div>
</template>

<script>
    import Textblock from '../mixins/Textblock'

    export default {
        data() {
            return {
                element: 'attendance_list',
                modalName: 'Edit Attendancelist Modal'
            }
        },

        mixins: [Textblock]
    }
</script>