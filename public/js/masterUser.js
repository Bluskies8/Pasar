$(document).ready(function() {

    $('#table-user').DataTable({
        info: false,
        paging: false,
        columns: [
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
        let lebarList = 184;
        let lebarBtn = $(this).css('width');
        lebarBtn = parseInt(lebarBtn.substr(0, lebarBtn.indexOf('px')));
        $('#list-aksi').css('left', $(this).offset().left - $('#content').children('.container').offset().left - lebarList + lebarBtn + 2);

        let tinggiHeader = 0;
        let tinggiBtn = $(this).css('height');
        tinggiBtn = parseInt(tinggiBtn.substr(0, tinggiBtn.indexOf('px')));
        $('#list-aksi').css('top', $(this).offset().top - $('#content').offset().top + tinggiBtn);

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
        action = 'insert';
        $('#input-kelas').val('');
        $('#modal-update').modal('show');
    });

    $('#item-update').on('click', function() {
        action = "update"
        $('.modal-title').text("Rubah User");
        $('#input-nama').val($('#' + selectedID).children().eq(0).html());
        $('#input-username').val($('#' + selectedID).children().eq(1).html());
        $('#input-password').val($('#' + selectedID).children().eq(2).html());
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
        if(action == 'insert'){
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
                    url: "/user/update/"+selectedID,
                    data:{
                        role:radioValue,
                        nama:nama,
                        username:username,
                        password:password,
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
});
