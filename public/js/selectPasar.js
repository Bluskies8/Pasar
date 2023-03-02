$(document).ready(function() {
    $('#show-add-pasar').on('click', function() {
        $('#add-pasar').modal('show');
    });

    $('.select-pasar').on('click', function() {
        var id = $(this).find('.card').attr('id');
        window.location.href = "/superadmin/switch/"+id;
    });
});
