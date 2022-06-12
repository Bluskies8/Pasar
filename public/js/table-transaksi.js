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
        // alert(currentID);
        location.href = '/details/'+currentID;
        currentID = '';
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
