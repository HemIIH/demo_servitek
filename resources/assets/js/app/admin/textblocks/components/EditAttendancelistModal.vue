<template>
    <form-wrapper :action="'/api/textblocks/element/' + this.data.element">
        <template slot-scope="form">

            <div v-if="data.type == 'email'">
                <legend>{{trans('admin.E-Mail')}}</legend>
                <div class="form-group" :class="{'has-error': form.errors.mail_body }">
                    <label v-text="trans('admin.'+textblocks.mail_body.label)"></label>
                    <html-editor name="mail_body" :model="textblocks.mail_body.value" height="140"></html-editor>
                    <span v-if="form.errors.mail_body" class="help-block">{{ form.errors.mail_body }}</span>
                </div>
            </div>

            <div v-if="data.type == 'pdf'">
                <legend>{{trans('admin.PDF')}}</legend>
                <div class="form-group" :class="{'has-error': form.errors.header }">
                    <label v-text="trans('admin.'+textblocks.header.label)"></label>
                    <html-editor name="header" :model="textblocks.header.value" height="140"></html-editor>
                    <span v-if="form.errors.header" class="help-block">{{ form.errors.header }}</span>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.call_to_action }">
                    <label v-text="trans('admin.'+textblocks.call_to_action.label)"></label>
                    <html-editor name="call_to_action" :model="textblocks.call_to_action.value"></html-editor>
                    <span v-if="form.errors.call_to_action" class="help-block">{{ form.errors.call_to_action }}</span>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.disclaimer }">
                    <label v-text="trans('admin.'+textblocks.disclaimer.label)"></label>
                    <html-editor name="disclaimer" :model="textblocks.disclaimer.value"></html-editor>
                    <span v-if="form.errors.disclaimer" class="help-block">{{ form.errors.disclaimer }}</span>
                </div>
            </div>

            <submit-button class="pull-right btn-md btn-success" :text="trans('admin.Speichern')" :loading="form.loading"></submit-button>

        </template>
    </form-wrapper>
</template>

<script>
    import TextblockModal from '../mixins/TextblockModal'

    export default {
        mixins: [TextblockModal]
    }
</script>