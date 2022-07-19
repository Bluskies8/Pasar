$(document).ready(function(){
    $('#table-barang').DataTable({
        columns: [
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
    var action;
    $('#add-buah').on('click', function() {
        action = "insert"
        $('.modal-title').text("Tambah Buah");
        $('#modal-update').modal('show');
    });

    $('#item-delete').on('click', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "post",
            url: "/buah/delete/"+selectedID,
            beforeSend: function(){

            },
            success: function(res) {
                // console.log(res);
                window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    $('#item-update').on('click', function() {
        action = "update"
        $('.modal-title').text("Rubah Buah");
        $('#input-nama').val($('#' + selectedID).children().eq(0).html());
        $('#modal-update').modal('show');
    });

    $('#btn-save').on('click', function() {
        var nama = $('#input-nama').val();

        (!nama)? $('#error-nama').text("Nama Buah wajib di isi"):$('#error-nama').text("");

        if(action == 'insert'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "/buah/create",
                data:{
                    nama:nama,
                },
                beforeSend: function(){

                },
                success: function(res) {
                    // console.log(res);
                    window.location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }else if(action == 'update'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "/buah/update/"+selectedID,
                data:{
                    nama:nama,
                },
                beforeSend: function(){

                },
                success: function(res) {
                    // console.log(res);
                    window.location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }
    });

});
