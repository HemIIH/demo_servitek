<template>
</template>

<script>
    import _ from 'lodash'; 
    Vue.prototype.trans = string => _.get(window.i18n, string)
    Vue.prototype.trans1 = (string, args) => {
        let value = _.get(window.i18n, string);

        _.eachRight(args, (paramVal, paramKey) => {
            value = _.replace(value, `:${paramKey}`, paramVal);
        });
        return value;
    };
</script>

