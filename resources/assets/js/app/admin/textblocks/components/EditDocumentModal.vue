<template>
    <form-wrapper :action="'/api/textblocks/element/' + this.data.element">
        <template slot-scope="form">

            <div class="row">
                <div class="col-md-4 form-group" :class="{'has-error': form.errors.subject }">
                    <label v-text="trans('admin.'+textblocks.subject.label)"></label>
                    <input name="subject" class="form-control input-sm" v-model="textblocks.subject.value">
                    <span v-if="form.errors.subject" class="help-block">{{ form.errors.subject }}</span>
                </div>
            </div>

            <div class="form-group" :class="{'has-error': form.errors.mail_body }">
                <label v-text="trans('admin.'+textblocks.mail_body.label)"></label>
                <html-editor name="mail_body" :model="textblocks.mail_body.value" height="150"></html-editor>
                <span v-if="form.errors.mail_body" class="help-block">{{ form.errors.mail_body }}</span>
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