<template>
    <div>
        <general :client="client"></general>

        <detail :client="client"></detail>

        <blacklist :client="client"></blacklist>

        <contacts-box :contacts="client.contacts"></contacts-box>
    </div>
</template>

<script>
    export default {
        props: ['client'],
        components: {
            'General': require('./General.vue'),
            'Detail': require('./Details.vue'),
            'Blacklist': require('./Blacklist.vue'),
            'ContactsBox': require('./Contacts.vue'),
        }
    }
</script>