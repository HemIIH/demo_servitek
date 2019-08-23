<template>
    <textarea id="summernote" class='form-control input-sm' :name='name'></textarea>
</template>

<script>
    export default {
        props: {
            model: {
                required: true,
            },

            name: {
                type: String,
                required: true,
            },
            height: {
                type: String,
                default: '220'
            }
        },

        mounted() {

            let config = {
                height: this.height,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']]
                ]
            };

            let vm = this;

            config.callbacks = {

                onInit() {
                    $(vm.$el).summernote('code', vm.model);
                },

                onChange() {
                    vm.$emit('change', $(vm.$el).summernote('code'));
                },

                onBlur() {
                    vm.$emit('change', $(vm.$el).summernote('code'));
                }
            };

            this.$nextTick(() => {

                $(this.$el).summernote(config);

            });
        }
    }
</script>
