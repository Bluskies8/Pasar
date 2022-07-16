$(document).ready(function() {

    $('#table-user').DataTable({
        info: false,
        paging: false,
        columns: [
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

    $('#item-update').on('click', function() {
        tipe = "update"
        $('.modal-title').text("Rubah Nomor Punggung");
        $('#input-nama').val($('#' + selectedID).children().eq(0).html());
        $('#input-username').val($('#' + selectedID).children().eq(1).html());
        $('#input-password').val($('#' + selectedID).children().eq(2).html());
        $('#modal-update').modal('show');
    });


    $('#item-delete').on('click', function() {
        if(confirm('yakin untuk menghapus nomor punggung ?')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "/admin/user/delete/"+selectedID,
                beforeSend: function(){

                },
                success: function(res) {
                    console.log(res);
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
