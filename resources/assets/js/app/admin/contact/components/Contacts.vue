<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{trans('admin.Ansprechpartner')}}
            <div class="pull-right">
                <i class="fa fa-pencil pointer margin-r-5" @click="editContacts"></i>
                <i @click="newContact" class="fa fa-plus text-primary pointer"></i>
            </div>
        </div>
        <div v-if="items.length" class="panel-body">
            <ul class="list-group">
                <li v-for="contact in visibleItems" class="list-group-item">
                    <div class="row">
                        <div class="col-md-7">
                            <a href="#" @click.prevent="show(contact)">{{ contact.last_name + ', ' + contact.first_name }}</a>
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
                        <div class="col-md-3">
                            <div v-if="contact.personnel_planning"><i class="fa fa-users"></i></div>
                            <div v-if="contact.accounting"><i class="fa fa-euro"></i></div>
                        </div>
                        <div class="col-md-2 text-right">
                            <i @click="edit(contact)" class="fa fa-pencil pointer"></i>
                            <i @click="destroy(contact)" class="fa fa-times pointer text-danger"></i>
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
                items: []
            }
        },

        props: ['client'],
        mixins: [Pagination],

        methods: {
            getContacts() {
                axios.get('/api/client/' + this.client.id +'/contacts').then((response) =>
                    this.items = response.data
                ).then(this.updateVisibleItems);
            },

            newContact() {
                let data = {
                    'client': this.client,
                    'contact': {},
                    'buttonText': trans('admin.Anlegen'),
                    'type': 'create'
                }

                modal('Contact Form Modal', trans('admin.Neuer Kontakt'), data);
            },

            edit(contact) {
                let data = {
                    'client': this.client,
                    'contact': contact,
                    'buttonText': trans('admin.Speichern'),
                    'type': 'edit'
                }

                modal('Contact Form Modal', trans('admin.Kontakt bearbeiten'), data);
            },

            show(contact) {
                let data = {
                    'client': this.client,
                    'contact': contact
                }

                modal('Contact Modal', trans('admin.Kontakt anzeigen'), data);
            },

            editContacts() {
                let data = {
                    'client': this.client,
                    'contacts': this.items
                }

                modal('Contact Responsibilities Modal', trans('admin.Kontakte bearbeiten'), data);
            },

            destroy(contact) {

                swal({title: trans('admin.Kontakt wirklich löschen?')}).then(() => {
                    axios.delete('/api/client/contact/' + contact.id).then(() => {
                        flash(trans('admin.Kontakt gelöscht'))
                        this.getContacts()
                    }).catch(() =>
                        flash(trans('admin.Kontakt konnte nicht gelöscht werden'), 'error')
                    );
                });
            }
        },
        created() {
            this.getContacts();

            events.$on('contacts.updated', this.getContacts);
        }
    }
</script>
