<template>
    <div class="modal fade in" v-if="active" role="dialog" tabindex="-1" @click.self="close">
        <div class="modal-dialog" role="document" :style="width">
            <div class="modal-content">
                <div v-if="title" class="modal-header">
                    <button type="button" class="close" @click.self="close">&times;</button>
                    <h3 class="modal-title"> {{title}}</h3>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <component :is="component" :data="data"></component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                active: false,
                data: {},
                title: null,
                width: ''
            }
        },

        methods: {
            show() {
                this.active = true;

                this.$nextTick(() => {$('.modal').show()});
            },

            close() {
                this.active = false;
            },

            set(data, title, component, width = '') {
                this.data = data;
                this.title = title;
                this.component = component.split(' ').join('-').toLowerCase();
                this.width = width ? 'width:' + width + ';' : '';

                this.show();
            }
        },

        mounted() {
            this.$on('close', this.close);

            this.$nextTick(() => {
                events.$on('open.modal', this.set);
                events.$on('close.modal', this.close);
            });

            document.addEventListener('keydown', (e) => {
                if (this.active && e.keyCode == 27) {
                    this.close();
                }
            });
        },

        destroyed() {
            events.$off('open.modal', this.set);
        }
    }
</script>

<style>
    .modal {
        overflow-y: auto;
    }

    .modal-dialog {
        max-width: 1280px;
        min-width: 750px;
    }
</style>
