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
        }
        else
        {
            $(val).css("background-color","red");
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
            }
            else
            {
                $(val).css("background-color","red");
            }
        });
    });
    $('.selectRow').hide();
})
function AddRow(id)
{
// lorsqu'on change de valeur dans la liste
    var valeur = $('#selectRow'+id).val(); // valeur sélectionnée
    if (valeur == -1) { // si non vide
        $('#addRow'+id).show();
    }
    else {
        $('#addRow'+id).hide();
    }
}
function changeNPA(value, id) {


    //si c'est le NPA ou la localité qui appele la fonction
    if(id.substring(id.length-2)== '-2')
    {
        id = id.substring(0, id.length-2);
    }
    else
    {

        id = id+'-2';
    }
    $('#'+id+' option').each(function()
    {

        if($(this).val() != "")
        {
            if($(this).val() == value)
            {
                $('#'+id+' option').removeAttr('selected')
                $(this).attr('selected', true)
            }
        }
    });
}

