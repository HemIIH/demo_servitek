<template>
    <li>
        <a href="#" @click.prevent="newMessage">
            <i class="fa fa-envelope"></i>
        </a>
    </li>
</template>
<script>
    export default {
        methods: {
            newMessage() {
                modal('Message Modal', trans('Nachricht schreiben'), {});
            }
        }
    }
</script>