$(document).ready(function(){
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    $(document).keydown(function(e){
        if(e.which === 123){
            return false;
        }
    });

    $('#table-transaksi').DataTable({
        columns: [
            null,
            null,
            null,
            null,
            null,
            null,
            { orderable: false }
        ],
        paging: false,
        initComplete: function(settings, json) {
            $('#table-transaksi_filter').parent().prev().append($('#container-tanggal').detach());
            $('#container-tanggal').show();
        },
    });

    var flag = false;
    var currentID = '';
    var role = window.location.pathname.split('/');
    $('.show-aksi').on('click', function() {
        $('#list-aksi').show();
        $('#list-aksi').css('left', $(this).offset().left - $('#side-nav').width() - 150 /* lebar list */ + 35.5 /* lebar button */);
        $('#list-aksi').css('top', $(this).offset().top - 50 /* tinggi header */ + 30 /* tinggi button */);
        currentID = $(this).parent().parent().children('.cell-id').text();
        flag = true;
    });

    $('#item-detail').on('click', function() {
        location.href = '/'+role[1]+'/details/' + currentID;
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
                url: "/"+role[1]+"/transaction/delete/"+currentID,
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
