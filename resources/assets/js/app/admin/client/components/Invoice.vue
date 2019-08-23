<template>
    <div class="row">
        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Rechnungsadresse')}}
                    <span class="pull-right"><i @click="editInvoice('invoiceData')" class="fa fa-pencil pointer"></i></span>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-7 form-group">
                            <label>{{trans('admin.Name')}}</label>
                            <div>{{ invoiceData.name }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Strasse')}}</label>
                            <div>{{ invoiceData.street}}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Strasse - Zusatz')}}</label>
                            <div>{{ invoiceData.address_addition ? invoiceData.address_addition : ''}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Postleitzahl')}}</label>
                            <div>{{ invoiceData.postal_code }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Stadt')}}</label>
                            <div>{{ invoiceData.city }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Land')}}</label>
                            <div>{{ invoiceData.country }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="client.invoices" class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{trans('admin.Rechnungen')}}</h4>
                </div>

                <div class="panel-body">
                    <table v-if="client.invoices.length" class="table">
                        <thead>
                        <tr>
                            <th>{{trans('admin.Rechnungsnr')}}</th>
                            <th>{{trans('admin.Rechnungsdatum')}}</th>
                            <th>{{trans('admin.Betrag')}}</th>
                            <th>{{trans('admin.Bezahlt')}}</th>
                            <th>{{trans('admin.Aktion')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="invoice in client.invoices">
                            <td>{{ invoice.id }}</td>
                            <td>{{ moment(invoice.invoice_date).format('L') }}</td>
                            <td>{{ money(invoice.sum) + ' Euro' }}</td>
                            <td>
                                <span v-if="invoice.pay_date" class="label label-success">{{trans('admin.Bezahlt am')}} {{ moment(invoice.pay_date).format('L') }}</span>
                                <span v-else class="label label-danger">{{trans('admin.offen')}}</span>
                            </td>
                            <td>
                                <a :href="'/admin/invoice/' + invoice.id + '/show'" target="_blank" class="btn btn-sm btn-default">
                                    <i class="fa fa-file-pdf-o fa-lg"></i>
                                </a>
                                <a :href="'/admin/invoice/' + invoice.id + '/proof-of-work'" target="_blank" class="btn btn-sm btn-default">
                                    <i class="fa fa-clock-o fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p v-else>{{trans('admin.Keine Rechnungen')}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Ansprechpartner für Rechnung')}}
                    <div class="pull-right">
                        <i class="fa fa-pencil pointer margin-r-5" @click="editContacts"></i>
                        <i class="fa fa-plus text-primary pointer" @click="newContact"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <ul v-if="invoiceContacts.length">
                        <li v-for="contact in invoiceContacts">
                            {{ contact.last_name + ', ' + contact.first_name }}
                            <span class="pull-right"><i @click="editContact(contact)" class="fa fa-pencil pointer"></i></span>
                        </li>
                    </ul>
                    <div v-else>-</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Weitere Rechnungsdaten')}}
                    <span class="pull-right"><i @click="editInvoice('invoiceTexts')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{trans('admin.Einleitungstext')}}</label>
                        <div v-html="invoiceData.intro"></div>
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin.Schlusstext')}}</label>
                        <div v-html="invoiceData.outro"></div>
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin.Zahlungsfrist')}}</label>
                        <div>{{ invoiceData.payment_period }} {{trans('admin.Tage')}}</div>
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin.Umsatzsteuer')}}</label>
                        <div>{{ invoiceData.default_tax_rate }} %</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searchString: '',
                contacts: [],
                invoiceData: Object.assign({}, this.client.invoice_data)
            }
        },

        props: ['client'],

        computed: {
            invoiceContacts() {
                if (! this.contacts.length) {
                    return [];
                }

                return this.contacts.filter(item => {
                    return item.accounting == 1
                })
            }
        },

        methods: {

            getContacts() {
                axios.get('/api/client/' + this.client.id + '/contacts').then((response) =>
                        this.contacts = response.data
                );
            },

            getClientsInvoiceData() {
                axios.get('/api/client/' + this.client.id).then((response) =>
                        this.invoiceData = response.data.invoice_data
                );
            },

            newContact() {
                let data = {
                    'client': this.client,
                    'contact': {
                        'accounting': 1
                    },
                    'buttonText': trans('admin.Anlegen'),
                    'type': 'create'
                }

                modal('Contact Form Modal', trans('admin.Neuer Kontakt'), data);
            },

            editContact(contact) {
                let data = {
                    'client': this.client,
                    'contact': contact,
                    'buttonText': trans('admin.Speichern'),
                    'type': 'edit'
                }

                modal('Contact Form Modal', trans('admin.Kontakt bearbeiten'), data);
            },

            editContacts() {
                let data = {
                    'client': this.client,
                    'contacts': this.contacts
                }

                modal('Contact Responsibilities Modal', trans('admin.Kontakte bearbeiten'), data);
            },

            editInvoice(type) {
                let data = {
                    'client': this.client,
                    'invoiceData': this.invoiceData,
                    'type': type
                }

                modal('Invoice Data Modal', trans('admin.Rechnungsdaten bearbeiten'), data);
            }

        },
        created() {
            this.getContacts();

            events.$on('contacts.updated', this.getContacts);
            events.$on('invoiceData.updated', this.getClientsInvoiceData);
        }
    }
</script>
