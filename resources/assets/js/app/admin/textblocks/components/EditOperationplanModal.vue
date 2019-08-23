<template>
    <form-wrapper :action="'/api/textblocks/element/' + this.data.element">
        <template slot-scope="form">
            <legend>{{trans('admin.Textbausteine')}}</legend>

            <div v-if="data.type == 'disclaimer'">
                <div class="form-group" :class="{'has-error': form.errors.disclaimer }">
                    <label v-text="trans('admin.'+textblocks.disclaimer.label)"></label>
                    <html-editor name="disclaimer" :model="textblocks.disclaimer.value" height="400"></html-editor>
                    <span v-if="form.errors.disclaimer" class="help-block">{{ form.errors.disclaimer }}</span>
                </div>
            </div>

            <div v-if="data.type == 'signature'">
                <div class="form-group" :class="{'has-error': form.errors.signature }">
                    <label v-text="trans('admin.'+textblocks.signature.label)"></label>
                    <html-editor name="signature" :model="textblocks.signature.value" height="400"></html-editor>
                    <span v-if="form.errors.signature" class="help-block">{{ form.errors.signature }}</span>
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