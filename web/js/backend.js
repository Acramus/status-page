/**
 * ITAW Status Page
 * 
 * backend.js
 * 
 * @author Florian Weber <florian.weber.dd@icloud.com>
 */

var fillAlert = function () {
    sweetAlert('Attention!', 'All fields have to be filled!', 'error');
};

$(document).ready(function () {

    /**
     * Endpoint
     */

    $('#form-add-endpoint').submit(function (e) {

        var name = $('#input-name').val(),
                host = $('#input-host').val(),
                ip = $('#input-ip').val();

        if (name === '' || host === '' || ip === '') {
            e.preventDefault();
            fillAlert();
        }

    });

    $('#form-update-endpoint').submit(function (e) {

        var name = $('#input-name').val(),
                host = $('#input-host').val(),
                ip = $('#input-ip').val();

        if (name === '' || host === '' || ip === '') {
            e.preventDefault();
            fillAlert();
        }

    });

    /**
     * Incident
     */

    $('#form-add-incident').submit(function (e) {

        var title = $('#input-title').val();
        var description = $('#input-description').val();
        var endpoint = $('#input-endpoint').val();

        if (title === '' || description === '') {
            e.preventDefault();
            fillAlert();
        }

        if (endpoint == 0) {
            e.preventDefault();
            sweetAlert('Attention!', 'You have to select an Endpoint from the list!', 'error');
        }

    });

    $('#form-update-incident').submit(function (e) {

        var title = $('#input-title').val();
        var description = $('#input-description').val();

        if (title === '' || description === '') {
            e.preventDefault();
            fillAlert();
        }

    });

});