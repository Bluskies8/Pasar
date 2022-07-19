$(document).ready(function(){
    $('#table-barang').DataTable({
        columns: [
            null,
            null,
            { orderable: false }
        ],
        paging: false
    });

    var flag = false;
    var selectedID = '';
    $('.show-aksi').on('click', function() {
        $('#list-aksi').css('left', $(this).offset().left - $('#side-nav').width() - 130 /* lebar list */ + 30.25 /* lebar button */);
        $('#list-aksi').css('top', $(this).offset().top - 50 /* tinggi header */ + 24 /* tinggi button */);
        $('#list-aksi').show();
        selectedID = $(this).closest('tr').attr('id');
        flag = true;
    });

    $(document).on('click', function() {
        setTimeout(function (){
            if (flag) {
                flag = !flag;
            } else {
                if ($('#list-aksi').css('display') == 'block') {
                    $('#list-aksi').hide();
                }
            }
        }, 10);
    });

    $('#item-update').on('click', function() {
        action = "update"
        $('.modal-title').text("Rubah User");
        $('#input-kode').val($('#' + selectedID).children().eq(0).html());
        $('#input-nama').val($('#' + selectedID).children().eq(1).html());
        $('#modal-update').modal('show');
    });

    $('#btn-save').on('click', function() {

    });
});
