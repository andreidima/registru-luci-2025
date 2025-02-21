import 'bootstrap/dist/css/bootstrap.min.css'; // ✅ Ensure Bootstrap CSS is included
import * as bootstrap from 'bootstrap'; // ✅ Ensure Bootstrap JavaScript is imported globally

window.bootstrap = bootstrap; // ✅ Make Bootstrap available globally

import '../css/andrei.css'

import { createApp } from 'vue';
import { clickOutside } from './directives/clickOut';

// Import other components
import VueDatepickerNext from './components/DatePicker.vue';
import RegistruExcelImportForm from './components/RegistruExcelImportForm.vue';

// App pentru DatePicker
const datePicker = createApp({});
datePicker.component('vue-datepicker-next', VueDatepickerNext);
if (document.getElementById('datePicker') != null) {
    datePicker.mount('#datePicker');
}

const registruExcelImportForm = createApp({});
registruExcelImportForm.component('registru-excel-import-form', RegistruExcelImportForm);
if (document.getElementById('registruExcelImportForm') !== null) {
    registruExcelImportForm.mount('#registruExcelImportForm');
}

