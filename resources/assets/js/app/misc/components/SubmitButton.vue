<template>
    <button type="submit" class="btn" v-html="value" :disabled="loading"></button>
</template>

<script>
    export default {
        computed: {
            value() {
                if (this.loading)
                    return "<i class='fa fa-spinner fa-spin margin-r-10 margin-l-10'></i>";

                return this.text
            }
        },

        props: ['text', 'loading'],

        methods: {}
    };
</script>
