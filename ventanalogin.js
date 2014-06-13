$(document).ready(function(){
    $("#loginBox").hide();
    $("#loginButton").click(function () {
        $("#loginBox").slideToggle();
        $("#loginBox").offset();
    });
});
    