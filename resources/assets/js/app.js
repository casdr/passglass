
require('./bootstrap');
require('datatables.net-bs');

$(document).ready(function () {
    setInterval(function () {
        var current = Math.round((new Date()).getTime() / 1000);
        if (current > SESSION_END) {
            window.location.href = '/';
        }
        if (SESSION_END - current < 0) {
            $('#session-lifetime').text('ended');
            if (LOGGED_IN) {
                window.location.href = '/';
            }
        } else {
            $('#session-lifetime').text(SESSION_END - current + ' seconds');
        }
    }, 1000);
});