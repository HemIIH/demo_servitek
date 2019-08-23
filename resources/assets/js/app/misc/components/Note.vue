<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-9 panel-title">
                    {{trans('admin.Notizen')}}
                </div>
                <div class=" col-md-3">
                    <div class="pull-right margin-t-5">
                        <i v-if="! show" @click="show = true" class="fa fa-plus text-primary pointer"></i>
                        <i v-else @click="show = false" class="fa fa-minus text-primary pointer"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body" v-show="show || items.length">
            <form-wrapper v-show="show" :action="'/api/' + this.type + '/' + this.model.id + '/note'" class="margin-b-5">
                <template slot-scope="form">

                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.month }">
                            <select class="form-control input-sm" name="month" v-model="month">
                                <option value="1">{{trans('admin.Januar')}}</option>
                                <option value="2">{{trans('admin.Februar')}}</option>
                                <option value="3">{{trans('admin.März')}}</option>
                                <option value="4">{{trans('admin.April')}}</option>
                                <option value="5">{{trans('admin.Mai')}}</option>
                                <option value="6">{{trans('admin.Juni')}}</option>
                                <option value="7">{{trans('admin.Juli')}}</option>
                                <option value="8">{{trans('admin.August')}}</option>
                                <option value="9">{{trans('admin.September')}}</option>
                                <option value="10">{{trans('admin.Oktober')}}</option>
                                <option value="11">{{trans('admin.November')}}</option>
                                <option value="12">{{trans('admin.Dezember')}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.year }">
                            <select class="form-control input-sm" name="year" v-model="year">
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.body }">
                        <textarea name="body" id="body" class="form-control input-sm" rows="2" required v-model="body"></textarea>
                    </div>
                    <input class="pull-right btn btn-sm btn-primary" type="submit" :value="trans('admin.Neu')">
                </template>
            </form-wrapper>

            <ul v-if="items.length" class="list-unstyled">
                <li v-for="(note, index) in visibleItems" class="margin-b-10">
                    <div class="row">
                        <div class="col-md-8">
                            <strong :title="note.user.name + ' am ' + moment(note.created_at).format('lll') + trans('admin.Uhr')">{{trans('admin.'+ moment(note.date).format('MMM') )}} {{ moment(note.date).format('YYYY') }}</strong>
                        </div>
                        <div class="col-md-4">
                            <div class="pull-right">
                                <span v-if="note.editMode">
                                    <i @click="save(note)" class="fa fa-save pointer"></i>
                                    <i @click="cancel(note)" class="fa fa-trash text-danger pointer"></i>
                                </span>
                                <span v-else>
                                    <i @click="edit(note)" class="fa fa-pencil pointer"></i>
                                    <i v-if="canDelete" @click="destroy(note, index)" class="fa fa-times text-danger pointer"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-justify">
                        <textarea v-if="note.editMode" class="form-control input-sm" rows="5" v-model="note.editedInformation" required></textarea>
                        <span v-else>{{ note.information }}</span>
                    </div>
                </li>
            </ul>

            <div class="pull-right">
                <pagination-links
                        :items="items"
                        @paginate="updatePage"
                        :currentPage="currentPage"
                >
                </pagination-links>
            </div>
        </div>
    </div>
</template>

<script>
    import Pagination from '../../mixins/Pagination';

    export default {
        data() {
            return {
                items: [],
                show: false,
                body: '',
                month: moment().format('M'),
                year: moment().format('YYYY')
            }
        },

        props: ['type', 'canDelete', 'model'],
        mixins: [Pagination],

        methods: {
            getNotes() {
                axios.get('/api/' + this.type + '/' + this.model.id + '/notes').then((response) =>
                        this.items = response.data
                ).then(this.updateVisibleItems);
            },

            edit(note) {
                this.$set(note, 'editMode', true);
                this.$set(note, 'editedInformation', note.information);
            },

            save(note) {
                this.$set(note, 'editMode', false);
                this.$set(note, 'information', note.editedInformation);

                let data = {
                    id: note.id,
                    body: note.editedInformation
                };

                axios.patch('/api/' + this.type + '/' + this.model.id + '/note', data).then((response) =>
                        this.getNotes()
                );
            },

            cancel(note) {
                this.$set(note, 'editMode', false);
            },

            destroy(note, index) {
                swal({text: trans('admin.Notiz wirklich löschen?')}).then(() => {
                    axios.delete('/api/' + this.type + '/' + this.model.id + '/note/' + note.id).then((response) =>
                        this.getNotes()
                    );
                });
            }
        },

        created() {
            this.getNotes();

            this.$on('form.submitted', () => {
                Object.assign(this.$data, this.$options.data());

                this.getNotes();
            })
        }
    }
</script>
