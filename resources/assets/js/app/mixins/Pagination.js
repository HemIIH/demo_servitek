export default {
    data() {
        return {
            currentPage: 0,
            pageSize: 5,
            visibleItems: []
        }
    },

    components: {
        'PaginationLinks': require('../misc/components/PaginationLinks.vue')
    },

    methods: {

        updatePage(pageNumber) {
            this.currentPage = pageNumber;
            this.updateVisibleItems();
        },

        updateVisibleItems() {
            this.visibleItems = this.items.slice(this.currentPage * this.pageSize, (this.currentPage +1) * this.pageSize);

            if (this.visibleItems.length === 0 && this.currentPage > 0) {
                this.updatePage(this.currentPage - 1);
            }
        }
    },

    mounted() {
        this.updateVisibleItems();
    }
}