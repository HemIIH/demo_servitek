export default {
    data() {
        return {
            textblocks: this.data
        }
    },

    props: ['data'],

    methods: {

        edit(type) {
            let data = {
                type: type,
                textblocks: this.textblocks,
                element: this.element
            }

            modal(this.modalName, trans('admin.Textbausteine bearbeiten'), data);
        },

        reloadTextblocks() {
            axios.get('/api/textblocks/get-by-type/' + this.element).then((response) =>
                this.textblocks = response.data
            )
        }

    },

    created() {
        events.$on('textblocks.updated', this.reloadTextblocks);
    }
}