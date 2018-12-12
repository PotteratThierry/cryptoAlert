$(function() {

    $('.pswd').keyup(function()
    {
        // crée les variable du mots de passe et de sa repetition
        var pswd = $('#pswd').val();
        var pswdRepeat = $('#pswdRepeat').val();

        //valdation de la longueur
        if ( pswd.length >= 6 )
        {
            $('#length').removeClass('invalid').addClass('valid');
        }
        else
        {
            $('#length').removeClass('valid').addClass('invalid');
        }
        //validation d'au moins une lettre
        if ( pswd.match(/[a-z]/) )
        {
            $('#letter').removeClass('invalid').addClass('valid');
        }
        else
        {
            $('#letter').removeClass('valid').addClass('invalid');
        }

        //validation d'au moins une lettre Majuscule
        if ( pswd.match(/[A-Z]/) )
        {
            $('#capital').removeClass('invalid').addClass('valid');
        }
        else
        {
            $('#capital').removeClass('valid').addClass('invalid');
        }

        //validation d'au moins d'un nombre
        if ( pswd.match(/\d/) )
        {
            $('#number').removeClass('invalid').addClass('valid');
        }
        else
        {
            $('#number').removeClass('valid').addClass('invalid');
        }
        //validation de la correspondance entre mots de passe et sa repetition
        if ( pswd == pswdRepeat && pswd != "" && pswdRepeat != "")
        {
            $('#repeat').removeClass('invalid').addClass('valid');
        }
        else
        {
            $('#repeat').removeClass('valid').addClass('invalid');
        }
    })
        .focus(function()
        {
            $('#pswd_info').show();
        })
        .blur(function()
        {
            $('#pswd_info').hide();
        });

});
