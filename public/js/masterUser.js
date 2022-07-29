$(document).ready(function() {

    $('#table-user').DataTable({
        info: false,
        paging: false,
        columns: [
            null,
            null,
            null,
            null,
            null,
            null,
            { orderable: false }
        ]
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
    $('#add-user').on('click', function() {
        $('.modal-title').text("Buat User baru");
        $('.input-radio').each(function(index, element) {
            $(element).prop("checked", false);
        });
        $('#input-nama').val('');
        $('#input-username').val('');
        $('#input-password').val('');
        $('#input-shif-id').val('');
        $('#input-shif-masuk').val('');
        $('#input-shif-keluar').val('');
        action = 'insert';
        $('#modal-update').modal('show');
    });

    $('#item-update').on('click', function() {
        action = "update"
        var explode =$('#' + selectedID).children().eq(5).html().split(' - ');
        console.log(explode)
        $('.modal-title').text("Rubah User");
        $('#input-nama').val($('#' + selectedID).children().eq(0).html());
        $('#input-username').val($('#' + selectedID).children().eq(1).html());
        $('#input-password').val($('#' + selectedID).children().eq(2).html());
        $('#input-shif-id').val($('#' + selectedID).children().eq(4).html());
        $('#input-shif-masuk').val(explode[0]);
        $('#input-shif-keluar').val(explode[1]);
        var selectedRole = $('#' + selectedID).children().eq(3).html();
        $('.input-radio').each(function(index, element) {
            $(element).prop("checked", false);
            if ($(element).siblings('.form-check-label').text() == selectedRole) {
                $(element).prop("checked", true);
            }
        });
        $('#modal-update').modal('show');
    });

    $('#btn-save').on('click', function(){
        var radioValue = $("input[name='role']:checked").val();
        var nama = $('#input-nama').val();
        var username = $('#input-username').val();
        var password = $('#input-password').val();
        var shif_start = $('#input-shif-masuk').val();
        var shif_end = $('#input-shif-keluar').val();
        var shif = $('#input-shif-id').val();
        console.log((shif_start > shif_end))
        let check = false;
        if(shif_start > shif_end){
            check = false;
        }
        if(shif_start && shif_end || !shif_start && !shif_end){
            check=true;
        }else{
            (!shif_start)?$('#error-msg-masuk').text("Jam Mulai harus di isi"):$('#error-msg-masuk').text("");
            (!shif_end)?$('#error-msg-keluar').text("Jam Selesai harus di isi"):$('#error-msg-keluar').text("");
        }
        if($.inArray(shif,['1','2','3']) == -1){
            check = false;
        }else{
            check = true;
        }
        if(action == 'insert'){
            if(check == true){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "post",
                    url: "/user/create",
                    data:{
                        role:radioValue,
                        nama:nama,
                        username:username,
                        password:password,
                        tambaban_start:shif_start,
                        tambahan_end:shif_end,
                        shif:shif
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
            }else if(action == 'update'){

                if(check == true){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        type: "post",
                        url: "/user/update/"+selectedID,
                        data:{
                            role:radioValue,
                            nama:nama,
                            username:username,
                            password:password,
                            tambahan_start:shif_start,
                            tambahan_end:shif_end,
                            shif:shif
                        },
                        beforeSend: function(){

                        },
                        success: function(res) {
                            // console.log(res);
                            // window.location.reload();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        }
                    });
                }
            }
    });

    $('#item-delete').on('click', function() {
        if(confirm('yakin untuk menghapus user ini ?')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "/user/delete/"+selectedID,
                beforeSend: function(){

                },
                success: function(res) {
                    window.location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }
    });

    $('#btn-reset-clock').on('click', function() {
        $('#input-shif-masuk').val(null);
        $('#input-shif-keluar').val(null);
    });
});
