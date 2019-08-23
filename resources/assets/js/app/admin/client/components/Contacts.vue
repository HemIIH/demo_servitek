<template>
    <div class="box box-primary collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.Kontakte')}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <ul v-if="items.length"  class="list-group">
                <li v-for="contact in visibleItems" class="list-group-item">
                    <div class="row">
                        <div class="col-md-10">
                            {{ contact.last_name + ', ' + contact.first_name }}
                            <div v-if="contact.phone" class="small margin-l-10">
                                <i class="fa fa-phone margin-r-5"></i>{{ contact.phone }}
                            </div>
                            <div v-if="contact.mobile" class="small margin-l-10">
                                <i class="fa fa-phone margin-r-5"></i>{{ contact.mobile }}
                            </div>
                            <div v-if="contact.email" class="small margin-l-10">
                                <i class="fa fa-envelope margin-r-5"></i>{{ contact.email }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div v-if="contact.personnel_planning"><i class="fa fa-users"></i></div>
                            <div v-if="contact.accounting"><i class="fa fa-euro"></i></div>
                        </div>
                    </div>
                </li>
            </ul>
            <p v-else>{{trans('admin.Keine Kontkate')}}</p>

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
    import Pagination from '../../../mixins/Pagination';

    export default {
        data() {
            return {
                items: this.contacts
            }
        },

        props: ['contacts'],

        mixins: [Pagination],
    }
</script>
