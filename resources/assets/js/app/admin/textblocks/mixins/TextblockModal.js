export default {
    data() {
        return {
            textblocks: JSON.parse(JSON.stringify(this.data.textblocks))
        }
    },

    props: ['data'],

    created() {
        this.$on('form.submitted', function () {
            events.$emit('textblocks.updated');

            flash(trans('admin.Textbausteine erfolgreich bearbeitet'));

            this.$parent.$emit('close')
        })
    }
}