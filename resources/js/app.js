import './bootstrap';

import dateTimePicker from '../../vendor/permittedleader/forms-for-laravel/resources/js/components/dateTimePicker';

document.addEventListener('alpine:init', () => {
    Alpine.data('dateTimePicker', dateTimePicker);
});