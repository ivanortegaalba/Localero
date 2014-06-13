$(document).ready(function(){
    //$('article').append('<a class = \'botonEditar\' href=\'modificarNoticia.php?idNoticia='+$(this).attr("id")+'\'>');
    //$('article').append('<a id="editar" class="botonEditar" href="">Editar</a>');
    //$(".botonEditar").attr("href",'modificarNoticia.php?idNoticia=1');
    $("#loginButton").hide();
    $("#singupButton").hide();
    $("#loginButton").offset();
    $("#nuevaButton").show();
    $("#logoutButton").show();
    $(".editarButton").show();
    $(".borrarButton").show();
    $(".formulario_comentario").show();

    
});