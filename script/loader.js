$(document).ready(function() {
    setTimeout(function(){
        $("body").addClass("loaded");
        $('#loader').fadeOut();
    }, 3000);
});