$(document).ready(function () {
    $('form.matkalistaus').on('submit', function (submit) {

        // Otetaan kohdelomakkeesta data-confirm-attribuutin arvo
        var confirm_message = $(this).attr('data-confirm');
        // Pyydetään käyttäjältä vahvistusta
        if (!confirm(confirm_message)) {
            // Jos käyttäjä ei anna vahvistusta, ei lähetetä lomaketta
            submit.preventDefault();
        }
    });
});

$(document).ready(function () {
    $('form.henkilolistaus').on('submit', function (submit) {

        // Otetaan kohdelomakkeesta data-confirm-attribuutin arvo
        var confirm_message = $(this).attr('data-confirm');
        // Pyydetään käyttäjältä vahvistusta
        if (!confirm(confirm_message)) {
            // Jos käyttäjä ei anna vahvistusta, ei lähetetä lomaketta
            submit.preventDefault();
        }
    });
});



