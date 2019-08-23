<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-7 panel-title">
                    {{trans('admin.Verrechnungssatz')}}
                </div>
                <div class=" col-md-5">
                    <div class="pull-right margin-t-5">
                        <i v-if="! showForm" @click="showForm = true" class="fa fa-plus text-primary pointer"></i>
                        <i v-else @click="showForm = false" class="fa fa-minus text-primary pointer"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body" v-show="showForm || items.length">
            <form-wrapper v-show="showForm" :action="'/api/client/' + this.model.id + '/rate'">
                <template slot-scope="form">
                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.valid_from }">
                            <label>{{trans('admin.Gültig ab')}}</label> <i v-if="form.errors.valid_from" class="fa fa-warning text-danger" :title="form.errors.valid_from"></i>
                            <datepicker name="valid_from"></datepicker>
                        </div>
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.amount }">
                            <label>{{trans('admin.Betrag in')}} €</label> <i v-if="form.errors.amount" class="fa fa-warning text-danger" :title="form.errors.amount"></i>
                            <input class="form-control input-sm" name="amount">
                        </div>
                    </div>

                    <submit-button class="pull-right btn-sm btn-primary" :text="trans('admin.Neu')" :loading="form.loading"></submit-button>
                </template>
            </form-wrapper>
            <table v-if="items.length" class="table">
                <thead>
                <tr>
                    <th>{{trans('admin.Gültig von')}}</th>
                    <th>{{trans('admin.Gültig bis')}}</th>
                    <th>{{trans('admin.Betrag')}}</th>
                    <th v-if="canDelete"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entry, index) in items">
                    <td :title="trans('admin.Eingetragen am')  + moment(entry.created_at).locale('en').format('lll') + trans('admin.Uhr')">
                        {{ moment(entry.valid_from).locale('en').format('ll') }} - {{entry.valid_from}}
                    </td>
                    <td>
                        {{ entry.valid_to ? moment(entry.valid_to).locale('en').format('ll') : '-' }}
                    </td>
                    <td>
                        {{ money(entry.amount) }} €
                    </td>
                    <td v-if="canDelete">
                        <div class="pull-right">
                            <span @click="edit(entry)"><i class="fa fa-pencil pointer"></i></span>
                            <span v-if="index == 0" @click="destroy(entry, index)"><i class="fa fa-times text-danger pointer"></i></span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Collection from '../../../mixins/Collection';

    export default {
        data() {
            return {
                modelType: 'client',
                resource: 'rate'
            }
        },

        mixins: [Collection],

        methods: {

            edit(entry) {
                let data = {
                    'rate': entry,
                    'client': this.model
                }

                modal('Charge Rate Modal', trans('admin.Verrechnungssatz bearbeiten'), data)
            },

        },

        created() {
            events.$on('chargerate.updated', this.getItems)
        }
    }
</script>
