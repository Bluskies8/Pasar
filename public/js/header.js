$(document).ready(function() {
    $('header .btn.p-0').on('click', function() {
        $(this).next().toggle();
    });
});
