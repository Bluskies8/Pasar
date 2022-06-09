$(document).ready(function() {
    $('#table-invoice').DataTable({
        columns: [
            null,
            null,
            null,
            null,
            { orderable: false }
        ]
    });

    var flag = false;
    var currentID = '';
    $('.show-aksi').on('click', function() {
        $('#list-aksi').show();
        $('#list-aksi').css('left', $(this).offset().left - $('#side-nav').width() - 130 /* lebar list */ + 35.5 /* lebar button */);
        $('#list-aksi').css('top', $(this).offset().top - 50 /* tinggi header */ + 30 /* tinggi button */);
        currentID = $(this).parent().parent().children('.cell-id').text();
        flag = true;
    });

    var tambahanId = 0;
    $('#generate-invoice').on('click', function() {
        if (tambahanId == 0) {
            cloneBiaya();
        }
        $('#modal-invoice').modal('show');
    });

    function cloneBiaya() {
        tambahanId++;
        let temp = $('#clone-biaya').clone().prop('id', 'tambahan-' + tambahanId).appendTo("#list-tambahan");
        temp.removeClass('d-none');
        temp.addClass('d-flex');
    }

    $(document).on('click', '.add-tambahan', function() {
        cloneBiaya();
        $(this).hide();
        $(this).siblings('.btn').show();
    });

    $(document).on('click', '.delete-tambahan', function() {
        $(this).parent().remove();
    });
});
