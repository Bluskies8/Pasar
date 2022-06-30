$(document).ready(function(){
    $('#table-transaksi').DataTable({
        columns: [
            null,
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

    $('#item-detail').on('click', function() {
        location.href = '/details/' + currentID;
        currentID = '';
    });

    $('#item-delete').on('click', function() {
        if (confirm('Yakin untuk menghapus transaksi ' + currentID + ' ?')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    // 'contentType' : "application/json",
                },
                type: "POST",
                url: "transaction/delete/",
                data: {
                    id: currentID,
                },
                beforeSend: function(){
                    //console.log(currentID);
                },
                success: function(data) {
                    console.log(data);
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }
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
});
