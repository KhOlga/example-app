window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// })
//
require( 'jquery' );
require('bootstrap');

require('jszip');
require('pdfmake');
require('datatables.net-bs5')();
require('datatables.net-autofill-bs5')();
require('datatables.net-buttons-bs5')();
require('datatables.net-buttons/js/buttons.colVis.js')();
require('datatables.net-buttons/js/buttons.html5.js')();
require('datatables.net-buttons/js/buttons.print.js')();
require('datatables.net-colreorder-bs5')();
require('datatables.net-datetime')();
require('datatables.net-fixedcolumns-bs5')();
require('datatables.net-fixedheader-bs5')();
require('datatables.net-keytable-bs5')();
require('datatables.net-rowgroup-bs5')();
require('datatables.net-scroller-bs5')();
require('datatables.net-searchbuilder-bs5')();
require('datatables.net-searchpanes-bs5')();
require('datatables.net-select-bs5')();