$(function() {

    let loginName = $('#loginName');
    let loginFormat = $('#login_format');
    loginFormat.hide();

    loginName.change(function() {
        if(loginName.val() !== "")
        {
            if ( loginName.val().match(/([^A-Za-z0-9])/) )
            {
                loginFormat.show();
            }
            else
            {
                loginFormat.hide();
            }

        }
        else
        {
            loginFormat.hide();
        }

    });
});