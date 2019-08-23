<template>
    <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell-o"></i>
            <span v-if="notifications.length" class="label label-warning">{{ notifications.length }}</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <ul class="menu">
                    <li v-for="notification in notifications">
                        <a class="small" href="#" @click.prevent="approveOrder(notification.order_id)">
                            {{ notification.text }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</template>
<script>
    export default {
        data() {
            return {
            }
        },
        props: ['data'],

        computed: {
            notifications() {
                return this.data.map((item) => JSON.parse(item));
            }
        },

        methods: {
            approveOrder(id) {

                axios.get('/api/order/' + id).then((response) => {
                    let data = {
                        order: response.data
                    };

                    modal('Approve Order Modal', trans('Angefrager Auftrag'), data);
                });

            }
        }
    }
</script>