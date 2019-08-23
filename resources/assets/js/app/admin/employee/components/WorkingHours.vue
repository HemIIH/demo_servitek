<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-9 panel-title">
                    {{trans('admin.Vertragl vereinbarte Arbeitszeit')}}
                </div>
                <div class=" col-md-3">
                    <div class="pull-right margin-t-5">
                        <i v-if="! showForm" @click="showForm = true" class="fa fa-plus text-primary pointer"></i>
                        <i v-else @click="showForm = false" class="fa fa-minus text-primary pointer"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body" v-show="showForm || items.length">
            <div v-if="items.length" class="margin-b-10">
                {{ hour(items[0].hours) }} {{trans('admin.Stunden')}} {{(trans('admin.Gültig ab')+ moment(items[0].valid_from).locale('en').format('ll') )}}
            </div>
            <form-wrapper v-show="showForm" :action="'/api/employee/' + this.model.id + '/workingHours'">
                <template slot-scope="form">
                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.valid_from }">
                            <label>{{trans('admin.Gültig ab')}}</label> <i v-if="form.errors.valid_from" class="fa fa-warning text-danger" :title="form.errors.valid_from"></i>
                            <datepicker name="valid_from"></datepicker>
                        </div>
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.hours }">
                            <label>{{trans('admin.Stunden')}}</label> <i v-if="form.errors.hours" class="fa fa-warning text-danger" :title="form.errors.hours"></i>
                            <input class="form-control input-sm" name="hours">
                        </div>
                    </div>

                    <submit-button class="pull-right btn-sm btn-primary" :text="trans('admin.Neu')" :loading="form.loading"></submit-button>
                </template>
            </form-wrapper>
            <table v-if="items.length && showForm" class="table">
                <thead>
                <tr>
                    <th>{{trans('admin.Gültig von')}}</th>
                    <th>{{trans('admin.Gültig bis')}}</th>
                    <th>{{trans('admin.Stunden')}}</th>
                    <th v-if="canDelete"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entry, index) in items">
                    <td :title="trans('admin.Eingetragen am')+' ' + moment(entry.created_at).locale('en').format('lll') + trans('admin.Uhr')">
                        {{ moment(entry.valid_from).locale('en').format('ll') }}
                    </td>
                    <td>
                        {{ entry.valid_to ? moment(entry.valid_to).locale('en').format('ll') : '-' }}
                    </td>
                    <td>
                        {{ hour(entry.hours) }}
                    </td>
                    <td v-if="canDelete">
                        <span @click="edit(entry)"><i class="fa fa-pencil pointer"></i></span>
                        <span v-if="index == 0" @click="destroy(entry, index)"><i class="fa fa-times text-danger pointer"></i></span>
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
                modelType: 'employee',
                resource: 'workingHours'
            }
        },

        mixins: [Collection],

        methods: {

            edit(entry) {
                let data = {
                    'workingHours': entry,
                    'employee': this.model
                };

                modal('Working Hours Modal', trans('admin.Arbeitstunden bearbeiten'), data);
            }

        },

        created() {
            events.$on('workingHours.updated', this.getItems)
        }

    }
</script>
