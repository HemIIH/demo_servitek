// dashboard
Vue.component('dashboard-calendar', require('../client/dashboard/components/Calendar.vue'));
Vue.component('order-graph', require('../client/graph/components/OrderGraph.vue'));

// clients
Vue.component('client-calendar', require('../client/calendar/components/Calendar.vue'));
Vue.component('client-info', require('../client/profile/components/Info.vue'));
Vue.component('client-profile', require('../client/profile/components/Profile.vue'));
Vue.component('client-invoice', require('../client/profile/components/Invoice.vue'));
Vue.component('client-history', require('../client/profile/components/History.vue'));
Vue.component('charge-rates', require('../client/profile/components/ChargeRates.vue'));

//contacts
Vue.component('contacts', require('../client/contact/components/Contacts.vue'));
Vue.component('new-contact-modal', require('../client/contact/components/NewContactModal.vue'));
Vue.component('edit-contact-modal', require('../client/contact/components/EditContactModal.vue'));

// orders
Vue.component('new-order-modal', require('../client/order/components/NewOrderModal.vue'));
Vue.component('edit-order-modal', require('../client/order/components/EditOrderModal.vue'));
Vue.component('show-order-modal', require('../client/order/components/ShowOrderModal.vue'));

// misc - clients
Vue.component('message-modal', require('../client/misc/components/MessageModal.vue'));
Vue.component('message', require('../client/misc/components/Message.vue'));

// misc
Vue.component('html-editor', require('../misc/components/Editor.vue'));
Vue.component('datepicker', require('../misc/components/DatePicker.vue'));
Vue.component('flash', require('../misc/components/Flash.vue'));
Vue.component('notes', require('../misc/components/Note.vue'));
Vue.component('modal', require('../misc/components/Modal.vue'));
Vue.component('search', require('../misc/components/Search.vue'));
Vue.component('form-wrapper', require('../misc/components/FormWrapper.vue'));

