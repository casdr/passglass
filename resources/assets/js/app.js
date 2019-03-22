require('./bootstrap')
require('datatables.net-bs')

import 'babel-polyfill'


const openpgp = require('openpgp')
const bent = require('bent')
const getJSON = bent('json')

openpgp.initWorker({path: BASE_URL + '/js/openpgp.worker.min.js'});

const encryptPassword = async (password) => {
    const keys = await getJSON(BASE_URL + '/passwords/keys')
    const options = {
        message: openpgp.message.fromText(password),
        publicKeys: (await openpgp.key.readArmored(keys.keys)).keys
    }
    await openpgp.encrypt(options).then(ciphertext => {
        $('#encrypted').val(ciphertext.data);
    })
}

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

    var submitted = false;
    var oldPassword = "";

    $('#encrypt').click(function (event) {
        var password = $('#password').val();

        encryptPassword(password)
    });
});