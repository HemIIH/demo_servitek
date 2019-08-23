
Vue.component('trans-view', require('../admin/Main.vue'));
Vue.component('order', require('../admin/calendar/components/Order.vue'));

// tables
Vue.component('timetracking-table', require('../admin/timetracking/components/TimetrackingTable.vue'));
Vue.component('order-table', require('../admin/order/components/OrderTable.vue'));
Vue.component('client-table', require('../admin/client/components/ClientTable.vue'));
Vue.component('employee-table', require('../admin/employee/components/EmployeeTable.vue'));
Vue.component('invoice-table', require('../admin/invoice/components/InvoiceTable.vue'));
Vue.component('user-table', require('../admin/user/components/UserTable.vue'));

// invoice
Vue.component('new-invoice', require('../admin/invoice/components/NewInvoice.vue'));
Vue.component('edit-invoice-data', require('../admin/invoice/components/EditInvoiceData.vue'));

//dashboard
Vue.component('dashboard-calendar', require('../admin/dashboard/components/Calendar.vue'));

// calendar
Vue.component('calendar-overview', require('../admin/calendar/components/Overview.vue'));
Vue.component('date-selection', require('../admin/calendar/components/DateSelection.vue'));
Vue.component('orders-by-week', require('../admin/calendar/components/OrdersByWeek.vue'));
Vue.component('orders-by-month', require('../admin/calendar/components/OrdersByMonth.vue'));

// clients
Vue.component('client-overview', require('../admin/client/components/Overview.vue'));
Vue.component('client-account', require('../admin/client/components/Account.vue'));
Vue.component('client-history', require('../admin/client/components/History.vue'));
Vue.component('client-calendar', require('../admin/client/components/Calendar.vue'));
Vue.component('client-profile', require('../admin/client/components/Profile.vue'));
Vue.component('client-invoice', require('../admin/client/components/Invoice.vue'));
Vue.component('client-contacts', require('../admin/contact/components/Contacts.vue'));
Vue.component('new-client-modal', require('../admin/client/components/NewClientModal.vue'));
Vue.component('edit-client-modal', require('../admin/client/components/EditClientModal.vue'));
Vue.component('charge-rate-modal', require('../admin/client/components/ChargeRateModal.vue'));
Vue.component('invoice-data-modal', require('../admin/client/components/InvoiceDataModal.vue'));
Vue.component('charge-rates', require('../admin/client/components/ChargeRates.vue'));
Vue.component('send-client-document-modal', require('../admin/client/components/SendDocumentModal.vue'));

// employees
Vue.component('navigate', require('../admin/employee/components/Navigate.vue'));
Vue.component('employee-overview', require('../admin/employee/components/Overview.vue'));
Vue.component('employee-account', require('../admin/employee/components/Account.vue'));
Vue.component('employee-history', require('../admin/employee/components/History.vue'));
Vue.component('employee-calendar', require('../admin/employee/components/Calendar.vue'));
Vue.component('calendar-date-menu', require('../admin/employee/components/CalendarDateMenu.vue'));
Vue.component('employee-profile', require('../admin/employee/components/Profile.vue'));
Vue.component('new-employee-modal', require('../admin/employee/components/NewEmployeeModal.vue'));
Vue.component('edit-employee-modal', require('../admin/employee/components/EditEmployeeModal.vue'));
Vue.component('wage-modal', require('../admin/employee/components/WageModal.vue'));
Vue.component('working-hours-modal', require('../admin/employee/components/WorkingHoursModal.vue'));
Vue.component('time-off-modal', require('../admin/employee/components/TimeOffModal.vue'));
Vue.component('edit-time-off-modal', require('../admin/employee/components/EditTimeOffModal.vue'));
Vue.component('wages', require('../admin/employee/components/Wage.vue'));
Vue.component('working-hours', require('../admin/employee/components/WorkingHours.vue'));
Vue.component('extra-business', require('../admin/employee/components/ExtraBusiness.vue'));
Vue.component('payroll-modification', require('../admin/employee/components/PayrollModification.vue'));
Vue.component('send-employee-document-modal', require('../admin/employee/components/SendDocumentModal.vue'));

// documents
Vue.component('document-list', require('../admin/documents/components/DocumentList.vue'));
Vue.component('new-document-panel', require('../admin/documents/components/NewDocumentPanel.vue'));
Vue.component('upload-document', require('../admin/documents/components/UploadDocument.vue'));
Vue.component('create-document-modal', require('../admin/documents/components/CreateDocumentModal.vue'));
Vue.component('edit-document', require('../admin/documents/components/EditDocumentModal.vue'));
Vue.component('create-signature-modal', require('../admin/documents/components/CreateSignatureModal.vue'));

// orders
Vue.component('order-overview', require('../admin/order/components/Overview.vue'));
Vue.component('show-order-modal', require('../admin/order/components/ShowOrderModal.vue'));
Vue.component('approve-order-modal', require('../admin/order/components/ApproveOrderModal.vue'));
Vue.component('new-order-modal', require('../admin/order/components/NewOrderModal.vue'));
Vue.component('copy-order-modal', require('../admin/order/components/CopyOrderModal.vue'));
Vue.component('duplicate-order-modal', require('../admin/order/components/DuplicateOrderModal.vue'));
Vue.component('edit-order-modal', require('../admin/order/components/EditOrderModal.vue'));
Vue.component('assign-employees-modal', require('../admin/order/components/AssignEmployeesModal.vue'));
Vue.component('assigned-employees-list', require('../admin/order/components/AssignedEmployeesList.vue'));
Vue.component('calculations', require('../admin/order/components/Calculations.vue'));

// contacts
Vue.component('contact-modal', require('../admin/contact/components/ContactModal.vue'));
Vue.component('contact-form-modal', require('../admin/contact/components/ContactFormModal.vue'));
Vue.component('contact-responsibilities-modal', require('../admin/contact/components/ContactResponsibilitiesModal.vue'));

// user
Vue.component('user-photo', require('../admin/user/components/UserPhoto.vue'));

// textblocks
Vue.component('textblocks-attendance-list', require('../admin/textblocks/components/AttendanceList.vue'));
Vue.component('textblocks-invoice', require('../admin/textblocks/components/Invoice.vue'));
Vue.component('textblocks-operation-plan', require('../admin/textblocks/components/OperationPlan.vue'));
Vue.component('textblocks-signature', require('../admin/textblocks/components/Signature.vue'));
Vue.component('textblocks-document', require('../admin/textblocks/components/Document.vue'));
Vue.component('edit-signature-modal', require('../admin/textblocks/components/EditSignatureModal.vue'));
Vue.component('edit-attendancelist-modal', require('../admin/textblocks/components/EditAttendancelistModal.vue'));
Vue.component('edit-invoice-modal', require('../admin/textblocks/components/EditInvoiceModal.vue'));
Vue.component('edit-operationplan-modal', require('../admin/textblocks/components/EditOperationplanModal.vue'));
Vue.component('edit-document-modal', require('../admin/textblocks/components/EditDocumentModal.vue'));

// template
Vue.component('document-template', require('../admin/textblocks/components/Template.vue'));
Vue.component('edit-template-modal', require('../admin/textblocks/components/EditTemplateModal.vue'));

// charts
Vue.component('bar-chart', require('../admin/graph/components/BarChart.vue'));
Vue.component('pie-chart', require('../admin/graph/components/PieChart.vue'));

// misc
Vue.component('notifications', require('../admin/misc/components/Notifications.vue'));
Vue.component('salary-table', require('../admin/misc/components/SalaryTable.vue'));

Vue.component('html-editor', require('../misc/components/Editor.vue'));
Vue.component('datepicker', require('../misc/components/DatePicker.vue'));
Vue.component('submit-button', require('../misc/components/SubmitButton.vue'));
Vue.component('flash', require('../misc/components/Flash.vue'));
Vue.component('notes', require('../misc/components/Note.vue'));
Vue.component('modal', require('../misc/components/Modal.vue'));
Vue.component('search', require('../misc/components/Search.vue'));
Vue.component('form-wrapper', require('../misc/components/FormWrapper.vue'));

