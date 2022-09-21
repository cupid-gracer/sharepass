$(document).ready(function() {
    let key = "secret key 123";

    $('.create-submit').click(function(e) {
        e.preventDefault();
        let msg = $('#input-msg').val();
        msg = escapeInput(msg);
        let ciphertext = CryptoJS.AES.encrypt(msg, key);
        $('#input-msg').val(ciphertext.toString());
        let passphrase = $('#input-pass').val();
        passphrase = escapeInput(passphrase);
        $('#input-pass').val(passphrase);

        var data = $('#form-create').serialize();
        $.ajax({
            url: 'controller/Create.php',
            type: 'POST',
            data: data,
            success: function(res) {
                var result = JSON.parse(res);
                $('.alert').hide();
                $('.result-form').hide();

                if (result['status'] != 'ok') {
                    $('.alert').text(result['msg']).show();
                    return;
                } else {
                    $('#form-create').hide();
                    $('.result-form > a').attr('href', result['url']);
                    // $('.result-form > a').text(result['url']);
                    $('#input-copy').val(result['url']);
                    $('.expiry-time').text(convertTime(result['expiry_time']));
                    $('.result-form').show();
                }
            }
        });
    });

    $('.btn-copy').click(function() {
        var copyText = document.getElementById("input-copy");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        // alert("Copied the text: " + copyText.value);

    });


    $('.decrypt-submit').click(function(e) {
        e.preventDefault();
        $('.input-url').val(window.location.href.split('/')[4]);
        var data = $('#form-decrypt').serialize();
        $.ajax({
            url: 'controller/Decrypt.php',
            type: 'POST',
            data: data,
            success: function(res) {
                var result = JSON.parse(res);
                $('.alert').hide();
                $('.result-form').hide();

                if (result['status'] != 'ok') {
                    $('.alert').text(result['msg']).show();
                    return;
                } else {
                    $('#form-decrypt').hide();
                    $('.alert').removeClass("alert-danger");
                    $('.alert').addClass("alert-info");
                    $('.alert').text('Message has now been deleted and cannot be retrieved').show();
                    let bytes = CryptoJS.AES.decrypt(result['msg'], key);
                    let plaintext = bytes.toString(CryptoJS.enc.Utf8);
                    $('textarea').val(plaintext);
                    $('.result-form').show();
                }
            }
        });
    });

    $('.btn-home').click(function() {
        window.location = '/sharepass';
    });

});