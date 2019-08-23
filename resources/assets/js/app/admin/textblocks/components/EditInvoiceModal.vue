<template>
    <form-wrapper :action="'/api/textblocks/element/' + this.data.element">
        <template slot-scope="form">

            <div v-if="data.type == 'email'">
                <legend>{{trans('admin.E-Mail')}}</legend>
                <div class="form-group" :class="{'has-error': form.errors.mail_body }">
                    <label v-text="trans('admin.'+textblocks.mail_body.label)"></label>
                    <html-editor name="mail_body" :model="textblocks.mail_body.value"></html-editor>
                    <span v-if="form.errors.mail_body" class="help-block">{{ form.errors.mail_body }}</span>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.reminder }">
                    <label v-text="trans('admin.'+textblocks.reminder.label)"></label>
                    <html-editor name="reminder" :model="textblocks.reminder.value"></html-editor>
                    <span v-if="form.errors.reminder" class="help-block">{{ form.errors.reminder }}</span>
                </div>
            </div>

            <div v-if="data.type == 'invoice'">
                <legend>{{trans('admin.PDF')}}</legend>
                <div class="form-group" :class="{'has-error': form.errors.intro }">
                    <label v-text="trans('admin.'+textblocks.intro.label)"></label>
                    <html-editor name="intro" :model="textblocks.intro.value" height="150"></html-editor>
                    <span v-if="form.errors.intro" class="help-block">{{ form.errors.intro }}</span>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.outro }">
                    <label v-text="trans('admin.'+textblocks.outro.label)"></label>
                    <html-editor name="outro" :model="textblocks.outro.value" height="150"></html-editor>
                    <span v-if="form.errors.outro" class="help-block">{{ form.errors.outro }}</span>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group" :class="{'has-error': form.errors.payment_period }">
                        <label v-text="trans('admin.'+textblocks.payment_period.label)"></label>
                        <input name="payment_period" class="form-control input-sm" v-model="textblocks.payment_period.value">
                        <span v-if="form.errors.payment_period" class="help-block">{{ form.errors.payment_period }}</span>
                    </div>
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