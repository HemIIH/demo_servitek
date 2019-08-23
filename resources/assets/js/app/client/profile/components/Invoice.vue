<template>
    <div class="row">
        <div class="col-md-7">

            <div class="panel panel-default">
                <div class="panel-heading">{{trans('admin.Rechnungsadresse')}}</div>

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
                <div class="panel-heading"><h4>{{trans('admin.Rechnungen')}}</h4></div>

                <div class="panel-body">
                    <table v-if="invoices.length" class="table">
                        <thead>
                        <tr>
                            <th>{{trans('admin.Rechnungsnr')}}</th>
                            <th>{{trans('admin.Rechnungsdatum')}}</th>
                            <th>{{trans('admin.Betrag')}}</th>
                            <th>{{trans('admin.Bezahlt')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="invoice in invoices">
                            <td>{{ invoice.id }}</td>
                            <td>{{ moment(invoice.date).format('L') }}</td>
                            <td>{{ money(invoice.sum) + ' Euro' }}</td>
                            <td>
                                <span v-if="invoice.pay_date" class="label label-success">Bezahlt am {{ moment(invoice.pay_date).format('L') }}</span>
                                <span v-else class="label label-danger">offen</span>
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                    <p v-else>{{trans('admin.Keine Rechnungen')}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('admin.Ansprechpartner für Rechnung')}}
                </div>
                <div class="panel-body">
                    <ul v-if="invoiceContacts.length" class="list-group">
                        <li v-for="contact in invoiceContacts" class="list-group-item">
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
                        </li>
                    </ul>
                    <div v-else>-</div>
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

        props: ['client', 'invoices'],

        computed: {
            invoiceContacts() {
                if (!this.contacts.length) {
                    return [];
                }

                return this.contacts.filter(item => item.accounting == 1)
            }
        },

        methods: {

            getContacts() {
                axios.get('/api/client/' + this.client.id + '/contacts').then((response) =>
                        this.contacts = response.data
                );
            },

        },
        created() {
            this.getContacts();
        }
    }
</script>
