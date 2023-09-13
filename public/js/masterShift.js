$(document).ready(function(){
    $('#table-shift').DataTable({
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
    $('#add-shift').on('click', function() {
        action = "insert";
        $('.modal-title').text("Tambah Shift Baru");
        $('#modal-update').modal('show');
    });

    $('#item-delete').on('click', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "post",
            url: "/"+role[1]+"/shift/delete/"+selectedID,
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
        $('.modal-title').text("Rubah Shift");
        $('#input-nama').val($('#' + selectedID).children().eq(0).html());
        $('#modal-update').modal('show');
    });

    $('#btn-save').on('click', function() {
        var nama = $('#input-nama').val();
        var waktuMasuk = $('#input-waktu-masuk').val();
        var waktuKeluar = $('#input-waktu-keluar').val();

        (!nama)? $('#error-nama').text("Nama shift wajib di isi"):$('#error-nama').text("");
        (!waktuMasuk)? $('#error-waktu-masuk').text("Waktu shift wajib di isi"):$('#error-waktu-masuk').text("");
        (!waktuKeluar)? $('#error-waktu-keluar').text("Waktu shift wajib di isi"):$('#error-waktu-keluar').text("");

        if(action == 'insert'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "/"+role[1]+"/shift/create",
                data:{
                    value:nama,
                    waktu_masuk: waktuMasuk,
                    waktu_keluar: waktuKeluar

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
                url: "/"+role[1]+"/shift/update/"+selectedID,
                data:{
                    value:nama,
                    waktu_masuk: waktuMasuk,
                    waktu_keluar: waktuKeluar
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
