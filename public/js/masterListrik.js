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
        let lebarList = 125;
        let lebarBtn = $(this).css('width');
        let lebarTambahan = 2;
        lebarBtn = parseInt(lebarBtn.substr(0, lebarBtn.indexOf('px')));
        $('#list-aksi').css('left', $(this).offset().left - $(this).closest('.card').offset().left - lebarList + lebarBtn + lebarTambahan);

        let tinggiBtn = $(this).css('height');
        let tinggiHeader = 0;
        tinggiBtn = parseInt(tinggiBtn.substr(0, tinggiBtn.indexOf('px')));
        $('#list-aksi').css('top', $(this).offset().top - $(this).closest('.card').offset().top + tinggiBtn + tinggiHeader);

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
    var role = window.location.pathname.split('/');
    $('#add-listrik').on('click', function() {
        action = "insert";
        $('.modal-title').text("Tambah Listrik");
        $('#modal-update').modal('show');
    });

    $('#item-delete').on('click', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "post",
            url: "/"+role[1]+"/listrik/delete/"+selectedID,
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
        $('.modal-title').text("Rubah listrik");
        $('#input-nama').val($('#' + selectedID).children().eq(0).html());
        $('#modal-update').modal('show');
    });

    $('#btn-save').on('click', function() {
        var nama = $('#input-nama').val();

        (!nama)? $('#error-nama').text("Nama listrik wajib di isi"):$('#error-nama').text("");

        if(action == 'insert'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "/"+role[1]+"/listrik/create",
                data:{
                    value:nama,
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
                url: "/"+role[1]+"/listrik/update/"+selectedID,
                data:{
                    value:nama,
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
