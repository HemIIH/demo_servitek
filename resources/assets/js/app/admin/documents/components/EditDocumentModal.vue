<template>
    <form-wrapper :action="'/api/' + data.type + '/' + data.id + '/document/' + data.document.id + '/update'">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.name }">
                            <label>{{trans('admin.Name des Dokuments')}}</label>
                            <input class="form-control input-sm" name="name" v-model="document.name">
                        </div>
                        <div class="col-md-3 col-md-offset-1 form-group" :class="{'has-error': form.errors.valid_to }">
                            <label>{{trans('admin.Gültig bis')}}</label>
                            <datepicker v-model="validTo" name="valid_to"></datepicker>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <button type="submit" class="btn btn-success">{{trans('admin.Speichern')}}</button>
            </div>
        </template>
    </form-wrapper>
</template>


<script>
    export default {
        data() {
            return {
                'document': Object.assign({}, this.data.document),
                'validTo': this.data.document.valid_to ? moment(this.data.document.valid_to).format('L') : ''
            }
        },
        props: ['data'],

        methods: {},

        created() {
            this.$on('form.submitted', () => {
                events.$emit('document.updated');

                this.$parent.$emit('close')
            })
        }
    }
</script>