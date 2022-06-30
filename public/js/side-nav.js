$(document).ready(function(){

    var originalWidth = $(window).width() - 200;
    var sideNav_opened = true;

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

    if (getCookie("nav_active") != "") {
        $('.nav-item.active').removeClass('active');
        $('#nav-item-' + getCookie("nav_active")).addClass("active");
    } else {
        $('#nav-item-dashboard').removeClass('active');
    }

    if (getCookie("nav_open") == "false") {
        sideNav_opened = false;
        closeNav(false);
    }

    function openNav(animate) {
        originalWidth = $(window).width() - 200;
        if (animate) {
            $('#side-nav, #minimize-nav').animate({width: '200px'});
            $('#content').animate({width: originalWidth + 'px'});
        } else {
            $('#side-nav, #minimize-nav').css('width', '200px');
            $('#content').css('width', originalWidth + 'px');
        }
        $('#minimize-icon').removeClass('fa-chevron-right');
        $('#minimize-icon').addClass('fa-chevron-left');
        setCookie("nav_open", true, 1);
    }

    function closeNav(animate) {
        originalWidth = $(window).width() - 50;
        if (animate) {
            $('#side-nav, #minimize-nav').animate({width: '50px'});
            $('#content').animate({width: originalWidth + 'px'});
        } else {
            $('#side-nav, #minimize-nav').css('width', '50px');
            $('#content').css('width', originalWidth + 'px');
        }
        $('#minimize-icon').removeClass('fa-chevron-left');
        $('#minimize-icon').addClass('fa-chevron-right');
        setCookie("nav_open", false, 1);
    }

    $('#minimize-nav').click(function(){
        sideNav_opened = !sideNav_opened;
        if (sideNav_opened) {
            openNav(true);
        } else {
            closeNav(true);
        }
    });

    $('.nav-item').on('click', function() {
        $('.nav-item.active').removeClass('active');
        $(this).addClass('active');
        setCookie("nav_active", $('.nav-item.active p').text().toLowerCase(), 1);
    });

    if ($(window).width() < 768) {
        sideNav_opened = false;
        closeNav(false);
    }

    $(window).resize(function() {
        if ($(window).width() < 768) {
            sideNav_opened = false;
            closeNav();
        } else {
            if (sideNav_opened) {
                originalWidth = $(window).width() - 200;
            } else {
                originalWidth = $(window).width() - 50;
            }
            $('#content').css('width', originalWidth + 'px');
        }
    });
});
