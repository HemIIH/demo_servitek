<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2 form-group" :class="{'has-error': errors.client }">
                        <label>{{trans('admin.Kunde')}}</label>
                        <i class="fa fa-refresh text-primary btn" @click="reset"></i>
                        <select class="form-control input-sm" @change="getClientAddress" v-model="clientId">
                            <option value="">{{trans('admin.Auswählen')}}</option>
                            <option v-for="client in clients" :value="client.id">{{ client.name }}</option>
                        </select>
                    </div>
                    <div v-if="client" class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': errors.contacts }">
                        <label>{{trans('admin.Ansprechpartner')}}</label>
                        <span class="margin-l-5"><i class="fa fa-pencil pointer" @click="editContacts"></i></span>
                        <span class="margin-l-5"><i class="fa fa-plus text-primary pointer" @click="newContact"></i></span>
                        <div class="checkbox" v-for="contact in contacts">
                            <label v-if="contact.accounting">
                                <input type="checkbox" name="contacts[]" :value="contact.id" v-model="contactsSelected">
                                {{ contact.last_name + ', ' + contact.first_name }}
                            </label>
                        </div>
                    </div>

                    <div v-if="client" class="col-md-4">
                        <div class="col-md-9">
                            <legend>Adresse</legend>
                        </div>
                        <div class="col-md-3">
                            <i @click="edit('invoiceData')" class="fa fa-pencil fa-lg pointer"></i>
                        </div>
                        <div class="col-md-12 form-group">
                            <div>
                                <div>
                                    <span v-if="invoiceData.name" v-text="invoiceData.name"></span>
                                    <span v-else class="text-muted">{{trans('admin.Firmenname')}}</span>
                                    <i v-if="errors['invoiceData.name']" class="fa fa-exclamation-triangle text-danger" :title="errors['invoiceData.name'][0]"></i>
                                </div>
                                <div>
                                    <span v-if="invoiceData.street" v-text="invoiceData.street"></span>
                                    <span v-else class="text-muted">{{trans('admin.Strasse')}}..</span>
                                    <i v-if="errors['invoiceData.street']" class="fa fa-exclamation-triangle text-danger" :title="errors['invoiceData.street'][0]"></i>
                                </div>
                                <div>
                                    <span v-if="invoiceData.address_addition" v-text="invoiceData.address_addition"></span>
                                    <i v-if="errors['invoiceData.address_addition']" class="fa fa-exclamation-triangle text-danger" :title="errors['invoiceData.address_addition'][0]"></i>
                                </div>
                                <div>
                                    <span v-if="invoiceData.postal_code" v-text="invoiceData.postal_code"></span>
                                    <span v-else class="text-muted">{{trans('admin.PLZ')}}..</span>
                                    <i v-if="errors['invoiceData.postal_code']" class="fa fa-exclamation-triangle text-danger" :title="errors['invoiceData.postal_code'][0]"></i>
                                    <span v-if="invoiceData.city" v-text="invoiceData.city"></span>
                                    <span v-else class="text-muted">{{trans('admin.Stadt')}}..</span>
                                    <i v-if="errors['invoiceData.city']" class="fa fa-exclamation-triangle text-danger" :title="errors['invoiceData.city'][0]"></i>
                                </div>
                                <div>
                                    <span v-if="invoiceData.country" v-text="invoiceData.country"></span>
                                    <span v-else class="text-muted">{{trans('admin.Land')}}..</span>
                                    <i v-if="errors['invoiceData.country']" class="fa fa-exclamation-triangle text-danger" :title="errors['invoiceData.country'][0]"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div v-if="client" class="row">
                    <div class="col-md-10">
                        <legend>{{trans('admin.Rechnungsdaten')}}</legend>
                    </div>
                    <div class="col-md-2">
                        <i @click="edit('invoiceTexts')" class="fa fa-pencil fa-lg pointer"></i>
                    </div>
                    <div class="col-md-3 form-group" :class="{'has-error': errors['invoiceData.intro']}">
                        <label>{{trans('admin.Einleitungstext')}}</label>
                        <div class="text-justify" v-html="invoiceData.intro"></div>
                    </div>
                    <div class="col-md-3 form-group" :class="{'has-error': errors['invoiceData.outro']}">
                        <label>{{trans('admin.Schlusstext')}}</label>
                        <div class="text-justify" v-html="invoiceData.outro"></div>
                    </div>
                    <div class="col-md-2 col-md-offset-1 form-group" :class="{'has-error': errors['invoiceData.payment_period']}">
                        <label>{{trans('admin.Zahlungsfrist')}}</label>
                        <div v-text="invoiceData.payment_period"></div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="items.length" class="panel panel-default">
            <div class="panel-heading">
                <h4>{{trans('admin.Rechnung')}} {{ client.name ? ' - ' + client.name : '' }}</h4>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{trans('admin.Auftragsnr')}}</th>
                        <th>{{trans('admin.Datum')}}</th>
                        <th>{{trans('admin.Leistung')}}</th>
                        <th>{{trans('admin.Menge')}}</th>
                        <th>{{trans('admin.Einheit')}}</th>
                        <th>{{trans('admin.Preis')}}</th>
                        <th>{{trans('admin.Steuersatz')}}</th>
                        <th>{{trans('admin.Rabatt')}}</th>
                        <th>{{trans('admin.Gesamt')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <order v-for="(item, key,index) in items" :item="item" :key="item.id" :index="key" :errors="errors"></order>
                    <order v-for="(item, key,index) in customItems" :item="item" :key="item.id" :index="key" :errors="errors"></order>
                    </tbody>
                </table>
                <div v-if="clientId">
                    <div @click="newItem++;" class="pull-left btn btn-success btn-sm pointer">
                        <i class="fa fa-plus"></i> {{trans('admin.Neu')}}
                    </div>
                    <div class="pull-right">
                        <button v-if="! loading" @click="save" class="btn btn-success btn-sm">{{trans('admin.Änderungen speichern')}}</button>
                        <button v-else class="btn btn-sm btn-success"><i class='fa fa-spinner fa-spin margin-r-10 margin-l-10'></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Order from './Order.vue';

    export default {
        data() {
            return {
                orders: [],
                items: [],
                newItem: 0,
                client: '',
                clientId: '',
                contacts: [],
                contactsSelected: [],
                clients: {},
                errors: {},
                loading: false,
                invoiceData: []
            }
        },
        components: {Order},

        computed: {
            customItems() {
                let data = [];

                for (let customItem = 0; customItem < this.newItem; customItem++) {

                    data.push({
                        id: '',
                        type: 'custom',
                        start: '',
                        end: '',
                        quantity: '',
                        price: '',
                        unit: trans('admin.Stunden'),
                        service: trans('admin.Servicekräfte'),
                        discount: 0,
                        tax_rate: this.invoiceData.default_tax_rate,
                        deleted: 0
                    });

                }

                return data;
            }
        },

        methods: {
            generateItems() {

                if (this.orders.length == 0) {
                    return [];
                }

                for (let item in this.orders) {
                    let order = this.orders[item];
                    let hours = order.total_min / 60;

                    this.items.push({
                        id: order.id,
                        type: 'order',
                        start: order.start,
                        end: order.end,
                        quantity: String(hours).replace('.', ','),
                        price: this.money(order.total_income / hours),
                        unit: trans('admin.Stunden'),
                        service: trans('admin.Servicekräfte'),
                        discount: 0,
                        tax_rate: this.invoiceData.default_tax_rate,
                        deleted: 0
                    });
                }
            },

            getClientAddress() {

                this.getContacts();

                axios.get('/api/client/' + this.clientId).then((response) => {
                    this.client = response.data
                    this.invoiceData = response.data.invoice_data
                }).then(() => this.getOrders());
            },

            getClients() {
                axios.get('/api/invoice/clients').then((response) =>
                    this.clients = response.data
                );
            },

            getContacts() {
                if (this.clientId == '') return;

                axios.get('/api/client/' + this.clientId + '/contacts').then((response) =>
                    this.contacts = response.data
                );
            },

            getOrders() {
                this.items = [];

                if (this.clientId == '') return;

                axios.get('/api/invoice/client/' + this.clientId + '/orders').then((response) =>
                    this.orders = response.data
                ).then(() => this.generateItems());
            },

            reset() {
                Object.assign(this.$data, this.$options.data());

                this.getClients();
            },

            edit(type) {
                let data = {
                    'client': this.client,
                    'invoiceData': this.invoiceData,
                    'type': type
                };

                modal('Edit Invoice Data', trans('admin.Rechnungsdaten bearbeiten'), data);
            },

            newContact() {
                let data = {
                    'client': this.client,
                    'contact': {
                        'accounting': 1
                    },
                    'buttonText': trans('admin.Anlegen'),
                    'type': 'create'
                };

                modal('Contact Form Modal', trans('admin.Neuer Kontakt'), data);
            },

            editContacts() {
                let data = {
                    'client': this.client,
                    'contacts': this.contacts
                };

                modal('Contact Responsibilities Modal', trans('admin.Kontakte bearbeiten'), data);
            },

            save() {

                this.loading = true;

                let data = {
                    client: this.client.id,
                    invoiceData: this.invoiceData,
                    contacts: this.contactsSelected,
                    items: this.items.concat(this.customItems).filter((item) => {
                        return item.deleted == 0;
                    })
                };

                axios.post('/api/invoice/client/' + this.orders[0].client_id + '/create', data).then(() => {
                    this.loading = false;

                    swal({
                        title: trans('admin.Rechnung gespeichert'),
                        type: 'success',
                        confirmButtonText: trans('admin.Zur Rechnungsliste'),
                        cancelButtonText: trans('admin.Neue Rechnung!'),
                        cancelButtonColor: '#218838'
                    }).then(() => {
                        window.location = '/admin/invoice'
                    }, (dismiss) => {
                        if (dismiss == 'cancel') {
                            this.reset();
                        }
                    })
                }).catch((data) => {
                    this.errors = data.response.data.errors;
                    this.loading = false;

                    flash(trans('admin.Rechnung konnte nicht gespeichert werden'), 'error');
                });
            }
        },

        created() {
            this.getClients();

            events.$on('invoiceData.saved', (data) => this.invoiceData = data);

            events.$on('contacts.updated', this.getContacts);
        }
    }
</script>