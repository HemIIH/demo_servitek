export default {
    data: function () {
        return {
            items: [],
            showForm: false,
        }
    },

    props: ['model', 'canDelete'],

    methods: {

        getItems() {
            axios.get('/api/' + this.modelType + '/' + this.model.id + '/' + this.resource).then((response) =>
                this.items = response.data
            ).then(() => this.$emit('items.received'));
        },

        cancel(entry) {
            this.$set(entry, 'editMode', false);
        },

        destroy(entry, index) {
            swal({text: trans('admin.Eintrag wirklich löschen?')}).then(() => {
                axios.delete('/api/' + this.modelType + '/' + this.model.id + '/' + this.resource + '/' + entry.id).then((response) =>
                    this.getItems()
                );
            }, (dismiss) => {
                if (dismiss === 'cancel') {
                    flash(trans('admin.Vorgang abgebrochen'), 'warning')
                }
            });
        }
    },

    created() {
        this.getItems();

        this.$on('form.submitted', () => {
            this.showForm = false;

            this.getItems();
        })
    },
}