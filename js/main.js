/**
 * Created by Potterat Thierry on 06.06.14.
 */

$(document).ready(function()
{

    //colorie les droit dans l'administration
    var lstDroit = $('.droit');
    var Ccss = "";
    (lstDroit).each(function(index,val)
    {
        if($(val).val() == 1)
        {
            $(val).css("background-color","green");
            $(val).css("color","white");
        }
        else
        {
            $(val).css("background-color","red");
            $(val).css("color","white");
        }
    });

    lstDroit.change(function () {
        var lstDroit = $('.droit');
        var Ccss = "";
        (lstDroit).each(function(index,val)
        {
            if($(val).val() == 1)
            {
                $(val).css("background-color","green");
                $(val).css("color","white");
            }
            else
            {
                $(val).css("background-color","red");
                $(val).css("color","white");
            }
        });
    });
    $('.selectRow').hide();
})


