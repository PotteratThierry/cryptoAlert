$(function() {

    let mail = $('#loginName');
    let mailFormat = $('#mail_format');
    mailFormat.hide();

    mail.change(function() {
        if(mail.val() !== "")
        {
            if ( mail.val().match(/#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#/) )
            {
                mailFormat.show();
            }
            else
            {
                mailFormat.hide();
            }

        }
        else
        {
            mailFormat.hide();
        }

    });
});