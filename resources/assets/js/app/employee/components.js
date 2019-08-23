// calendar
Vue.component('trans-view', require('../employee/Main.vue'));
Vue.component('calendar-by-week', require('../employee/calendar/components/CalendarByWeek.vue'));
Vue.component('calendar-by-month', require('../employee/calendar/components/CalendarByMonth.vue'));
Vue.component('order', require('../employee/calendar/components/Order.vue'));

// employees
Vue.component('employee-info', require('../employee/profile/components/Info.vue'));
Vue.component('employee-profile', require('../employee/profile/components/Profile.vue'));
Vue.component('edit-employee-modal', require('../employee/profile/components/EditEmployeeModal.vue'));
Vue.component('employee-history', require('../employee/profile/components/History.vue'));
Vue.component('wages', require('../employee/profile/components/Wages.vue'));
Vue.component('payroll-modification', require('../employee/profile/components/PayrollModification.vue'));
Vue.component('extra-business', require('../employee/profile/components/ExtraBusiness.vue'));

// orders
Vue.component('show-order-modal', require('../employee/order/components/ShowOrderModal.vue'));
Vue.component('requested-orders', require('../employee/order/components/RequestedOrders.vue'));

// misc - clients
Vue.component('message-modal', require('../employee/misc/components/MessageModal.vue'));
Vue.component('message', require('../employee/misc/components/Message.vue'));

// misc
Vue.component('html-editor', require('../misc/components/Editor.vue'));
Vue.component('datepicker', require('../misc/components/DatePicker.vue'));
Vue.component('flash', require('../misc/components/Flash.vue'));
Vue.component('notes', require('../misc/components/Note.vue'));
Vue.component('modal', require('../misc/components/Modal.vue'));
Vue.component('search', require('../misc/components/Search.vue'));
Vue.component('form-wrapper', require('../misc/components/FormWrapper.vue'));
Vue.component('submit-button', require('../misc/components/SubmitButton.vue'));



