<template>
    <div>
        <general :employee="employee"></general>

        <detail :employee="employee"></detail>

        <roles :employee="employee"></roles>
    </div>
</template>

<script>
    import General from './General.vue';
    import Detail from './Details.vue';
    import Roles from './Roles.vue';

    export default {
        props: ['employee'],
        components: {
            'General': require('./General.vue'),
            'Detail': require('./Details.vue'),
            'Roles': require('./Roles.vue'),
        }
    }
</script>