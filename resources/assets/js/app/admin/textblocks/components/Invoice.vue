<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <legend>{{trans('admin.E-Mail')}}</legend>
            </div>
            <div class="col-md-2"><i @click="edit('email')" class="fa fa-pencil fa-lg pointer"></i></div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.mail_body.label)"></label>
                <p v-html="textblocks.mail_body.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.reminder.label)"></label>
                <p v-html="textblocks.reminder.value"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <legend>{{trans('admin.Rechnungsbausteine')}}</legend>
            </div>
            <div class="col-md-2"><i @click="edit('invoice')" class="fa fa-pencil fa-lg pointer"></i></div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.intro.label)"></label>
                <p v-html="textblocks.intro.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.outro.label)"></label>
                <p v-html="textblocks.outro.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group text-justify">
                <label v-text="trans('admin.'+textblocks.payment_period.label)"></label>
                <p v-text="textblocks.payment_period.value"></p>
            </div>
        </div>
    </div>
</template>

<script>
    import Textblock from '../mixins/Textblock'

    export default {
        data() {
            return {
                element: 'invoice',
                modalName: 'Edit Invoice Modal'
            }
        },

        mixins: [Textblock]
    }
</script>