
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great  starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('bootstrap-datepicker');
require('summernote');

window.Vue = require('vue');
window.swal = require('sweetalert2');
window.moment = require('moment');

window.events = new Vue();

window.flash = (message, level = 'success') => events.$emit('flash', {message, level});

window.modal = (modalName, title, data, width = null) => events.$emit('open.modal', data, title, modalName, width);

require('./app/client/components');

Vue.mixin({
    methods: {
        moment(...args) {
            moment.locale('de');
            return moment(...args);
        },

        money(value) {
            if (! value)
                return;

            return value.toLocaleString('de-DE', {minimumFractionDigits: 2});
        },

        hour(value) {
            if (! value)
                return;

            return value.toLocaleString('de-DE', {minimumFractionDigits: 2});
        },

        shorten(string, limit) {
            if (string.length < limit) {
                return string
            }

            return string.substring(0, limit) + '..'
        }
    }
});

let app = new Vue({
    el: '#app',

    created() {
        swal.setDefaults({
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ok',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: trans('admin.Abbrechen'),
        })
    }
});

