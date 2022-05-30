$(document).ready(function(){
    if (getCookie("nav_active") != "") {
        $('.nav-item.active').removeClass('active');
        $('#nav-item-' + getCookie("nav_active")).addClass("active");
    } else {
        $('#nav-item-dashboard').removeClass('active');
    }

    var sideNav_opened = true;
    var originalWidth = $("#content").width();
    $('#minimize-nav').click(function(){
        sideNav_opened = !sideNav_opened;
        if (sideNav_opened) {
            $('#side-nav, #minimize-nav').animate({width: '200px'});
            let newWidth = originalWidth;
            $('#content').animate({width: newWidth + 'px'});
            $('#minimize-icon').removeClass('fa-chevron-right');
            $('#minimize-icon').addClass('fa-chevron-left');
        } else {
            $('#side-nav, #minimize-nav').animate({width: '50px'});
            let newWidth = originalWidth + 150;
            $('#content').animate({width: newWidth + 'px'});
            $('#minimize-icon').removeClass('fa-chevron-left');
            $('#minimize-icon').addClass('fa-chevron-right');
        }
    });

    $('.nav-item').on('click', function() {
        console.log($(this).text());
        $('.nav-item.active').removeClass('active');
        $(this).addClass('active');
        setCookie("nav_active", $('.nav-item.active p').text().toLowerCase(), 1);
    });

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
});
