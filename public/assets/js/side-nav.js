$(document).ready(function(){
    var sideNav_opened = true;
    $("#minimize-nav").click(function(){
        sideNav_opened = !sideNav_opened;
        if (sideNav_opened) {
            $("#side-nav, #minimize-nav").animate({width: '200px'});
            $("#minimize-icon").removeClass('fa-chevron-right');
            $("#minimize-icon").addClass('fa-chevron-left');
        } else {
            $("#side-nav, #minimize-nav").animate({width: '50px'});
            $("#minimize-icon").removeClass('fa-chevron-left');
            $("#minimize-icon").addClass('fa-chevron-right');
        }
    });
});
