export default {
    data() {
        return {
            model: {},
            query: {
                page: 1,
                column: 'id',
                direction: 'desc',
                search_input: '',
            }
        }
    },
    props: ['source', 'canCreate', 'canUpdate', 'canDelete'],
    computed: {
        queryString() {
            let string = [];

            for (let param in this.query)
                string.push(encodeURIComponent(param) + '=' + encodeURIComponent(this.query[param]));

            return string.join('&');
        }
    },
    methods: {

        next() {
            if (this.model.next_page_url) {
                this.query.page++
                this.fetchData()
            }
        },

        prev() {
            if (this.model.prev_page_url) {
                this.query.page--
                this.fetchData()
            }
        },

        toggleOrder(column) {
            if (column == this.query.column) {
                this.query.direction === 'desc' ? this.query.direction = 'asc' : this.query.direction = 'desc'
            } else {
                this.query.column = column
                this.query.direction = 'asc'
            }

            this.fetchData()
        },

        getSortingIcon(column) {
            if (this.query.column != column)
                return '&uarr;&darr;';

            return (this.query.direction === 'desc') ? '&darr;' : '&uarr;';
        },

        reset() {
            Object.assign(this.$data, this.$options.data());

            this.fetchData()
        },

        fetchData() {
            axios.get(`/api/${this.source}?${this.queryString}`)
                .then((response) => {
                    Vue.set(this.$data, 'model', response.data)
                }).catch((response) => console.log(response));
        },

        search() {
            this.query.page = 1;

            this.fetchData();
        },

        deleteRessource(id) {
            swal({title:  'Permanently delete data?'}).then(() => {
                axios.delete('/api/' + this.source + '/' + id).then(() => {
                    flash('Record deleted')
                    this.fetchData()
                }).catch(() =>
                    flash("Record could not be deleted", 'error')
                );
            });
        }
    },

    created() {
        this.fetchData()
    },
};