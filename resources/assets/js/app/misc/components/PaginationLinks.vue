<template>
    <ul v-if="totalPages() > 1" class="simple-pager list-unstyled">
        <li v-if="showPreviousLink()"><a href="#" @click.prevent="updatePage(currentPage - 1)"><i class="fa fa-angle-left"></i></a></li>
        <li>{{ currentPage + 1 }} von {{ totalPages() }}</li>
        <li v-if="showNextLink()"><a href="#" @click.prevent="updatePage(currentPage + 1)"><i class="fa fa-angle-right"></i></a></li>
    </ul>
</template>

<script>
    export default {
        props: {
            items: Array,
            currentPage: Number,
            pageSize: {
                type: Number,
                default: 5
            }
        },
        methods: {
            updatePage(pageNumber) {
                this.$emit('paginate', pageNumber);
            },

            totalPages() {
                return Math.ceil(this.items.length / this.pageSize);
            },

            showPreviousLink() {
                return this.currentPage != 0;
            },

            showNextLink() {
                return this.currentPage != (this.totalPages() - 1);
            }
        }
    }
</script>

<style>
    .simple-pager li {
        display: inline;
        padding: 3px;
    }
</style>