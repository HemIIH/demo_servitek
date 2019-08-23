<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{trans('admin.Ansprechpartner')}}
            <div class="pull-right">
                <i @click="newContact" class="fa fa-plus text-primary pointer"></i>
            </div>
        </div>
        <div v-if="items.length" class="panel-body">
            <ul class="list-group">
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
                        <div class="col-md-2 text-right">
                            <i @click="edit(contact)" class="fa fa-pencil pointer"></i>
                        </div>
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
    import Pagination from '../../../mixins/Pagination';

    export default {
        data() {
            return {
                items: ''
            }
        },

        props: ['client'],
        mixins: [Pagination],

        methods: {

            getContacts() {
                axios.get('/api/c/contacts').then((response) =>
                        this.items = response.data
                ).then(this.updateVisibleItems);
            },

            newContact() {
                let data = {
                    'client': this.client,
                    'contact': {}
                }

                modal('New Contact Modal', trans('Neuer Kontakt'), data);
            },

            edit(contact) {
                let data = {
                    'client': this.client,
                    'contact': contact
                }

                modal('Edit Contact Modal', trans('Kontakt bearbeiten'), data);
            }
        },
        created() {
            this.getContacts();

            events.$on('contacts.updated', this.getContacts);
        }
    }
</script>
