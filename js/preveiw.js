/**
 * Created by Potterat Thierry on 29.05.14.
 */

var SIGNATURE_WIDTH = 500;
var SIGNATURE_HEIGHT = 150;
var AVATAR_WIDTH = 200;
var AVATAR_HEIGHT = 200;

$(document).ready(function()
{

    //partour toute les élément de class image_file
    var LstImg = $('.image_file');
    (LstImg).each(function(index,val) {

        //crée le déclencheur pour chacun d'eux
        var input = document.getElementById(val.id);
        input.onchange=verifTaille;

        function verifTaille(){
            file =input.files[0];
            window.URL = window.URL || window.webkitURL;
            img = new Image();

            // à l'événement load, je lance la suite
            img.onload = function(){
                if(index == 0)
                {

                    var maxWidth = AVATAR_WIDTH;
                    var maxHeight = AVATAR_HEIGHT;
                }
                if(index== 1)
                {
                    var maxWidth = SIGNATURE_WIDTH;
                    var maxHeight = SIGNATURE_HEIGHT;
                }


                var resize = 0;
                var width = img.width;
                var height = img.height;

                //crée des variable temporaire pour le teste de la longueur et de la largeur

                var tmpHeight = img.height;
                var tmpWidth = img.width;
                //verifier que la hauteur de l'image est plus grande que la hauteur maximale
                if(tmpHeight > maxHeight)
                {
                    //calcule du % de redimentionnement, et crée la nouvelle hauteur et largeur
                    resize = (maxHeight * 100)/tmpHeight;
                    tmpWidth = (tmpWidth * resize)/100;
                    tmpHeight = maxHeight
                }
                //verifier que la nouvelle largeur de l'image est plus grande que la largeur maximale
                if(tmpWidth > maxWidth)
                {
                    //calcule du % de redimentionnement, et crée la nouvelle hauteur et largeur
                    resize = (maxWidth * 100)/tmpWidth;
                    tmpHeight = (tmpHeight * resize)/100;
                    tmpWidth = maxWidth
                }
                //transfère les variable temporaire au variable finale
                $('#preveiw'+index).css("height", tmpHeight.toFixed(2));
                $('#preveiw'+index).css("width",tmpWidth.toFixed(2) );
            }
            img.src = window.URL.createObjectURL(file);
            $('#msgFormatError'+index).addClass("hidden");
            printPreveiwImg(index);
    }
    });
});
function printPreveiwImg(idImg) {

    var files = 'idImage'+idImg;
    var preview = 'preveiw'+idImg;
    // get selected file element
    var oFile = document.getElementById(files).files[0];

    // filter for image files
    var rFilter = /^(image\/bmp|image\/gif|image\/jpeg|image\/png)$/i;
    if (! rFilter.test(oFile.type)) {
        $('#msgFormatError'+idImg).removeClass("hidden");
    }
    // get preview element
    var oImage = document.getElementById(preview);
    // prepare HTML5 FileReader
    var oReader = new FileReader();
    oReader.onload = function(e){
        // e.target.result contains the DataURL which we will use as a source of the image
        oImage.src = e.target.result;
        oImage.onload = function () { // binding onload event
        };
    };
    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}

