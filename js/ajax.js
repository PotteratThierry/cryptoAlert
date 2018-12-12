$(function() {
    let loginName = $('#loginName');
    let loginInfo = $('#login_info');
    loginInfo.hide();

    loginName.change(function() {

            if(loginName.val() !== "")
            {
                $.post('../controller/createAccount_controller.php', { login_name_ajax: loginName.val()},
                    function(data)
                    {
                        if (data === "1")
                        {
                            loginInfo.show()
                        }
                        else
                        {
                            loginInfo.hide()
                        }
                });
            }
            else
            {
                loginInfo.hide()
            }
    });

    let mail = $('#mail');
    let mail_info = $('#mail_info');
    mail_info.hide();

    mail.change(function()
        {
            if(mail.val() !== "")
            {
                $.post('../controller/createAccount_controller.php', { mail_ajax: mail.val()},
                    function(data) {
                        if (data === "1")
                        {
                            mail_info.show()
                        }
                        else
                        {
                            mail_info.hide()
                        }
                });
            }
            else
            {
                mail_info.hide()
            }
        });
});
