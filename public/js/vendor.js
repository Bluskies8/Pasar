$(document).ready(function() {

    var selectedID = "";
    var selectedRow = "";
    var flag = false;
    var action = "";

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

    $('#denah-pasar').on('click', '.show-aksi', function() {
        $('#list-aksi').css('left', $(this).offset().left - $('#side-nav').width() - 150 /* lebar list */ + 33.5 /* lebar button */);
        $('#list-aksi').css('top', $(this).offset().top - 50 /* tinggi header */ + 30 /* tinggi button */);
        $('#list-aksi').show();
        selectedID = $(this).attr('id').substr(4);
        selectedRow = $(this).closest('tr').children();
        flag = true;

    });

    // $('#denah-pasar').load(window.location.origin + "/" + window.location.pathname.split('/')[1] + '/vendorTable/');
    $('#denah-pasar').load(window.location.protocol + "//" + window.location.host  + "/" + window.location.pathname.split('/')[1] + '/vendorTable/');
    // $('td').on('dblclick', function(){
    //     $('#input-namaPT').val("");
    //     $('#nama-stand').text($(this).attr('id'));
    //         $('#input-namaPT').val($(this).find('.nama-pt').text());
    //         $('#input-pemilik').val($(this).find('.nama-lapak').text());
    //     currentID = $(this).attr('id');
    //     console.log(currentID);
    //     $('#modal-vendor').modal('show');
    // });

    $('#item-detail').on('click', function() {
        $('#input-namaPT').val(selectedRow.eq(1).html());
        $('#input-noStand').val(selectedRow.eq(0).html());
        $('#nama-stand').text(selectedRow.eq(0).html());
        $('#input-pemilik').val(selectedRow.eq(2).html());
        $('#modal-vendor').modal('show');
        action = "update";
    });

    $('#item-delete').on('click', function() {
        console.log(selectedID)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "delete",
            url: "vendor/delete",
            data: {
                id: selectedID,
            },
            success: function(data) {
                $('#denah-pasar').load(window.location.origin + "/" + window.location.pathname.split('/')[1] + '/vendorTable/');

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    $('#tambah-transaksi').on('click', function() {
        $('#input-noStand').prop('disabled', false);
        $('#input-namaPT').val("");
        $('#input-noStand').val("");
        $('#nama-stand').text("Baru");
        $('#input-pemilik').val("");
        $('#modal-vendor').modal('show');
        action = "create";
    });

    $('#btn-save').click(function () {
        var badan_usaha = $('#input-namaPT').val();
        var seller_name = $('#input-pemilik').val();
        var no_stand = $('#input-noStand').val();
        if(action == "create"){
            url = "vendor/create";
        }else if(action == "update"){
            url = "vendor/update";
        }

        console.log(selectedID);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "post",
            url: url,
            data: {
                id: selectedID,
                no_stand:no_stand,
                seller_name: seller_name,
                badan_usaha: badan_usaha
            },
            before: function(){
                console.log(id);
                console.log(badan_usaha);
                console.log(seller_name);
            },
            success: function(data) {
                // console.log(data);
                $('#denah-pasar').load(window.location.origin + "/" + window.location.pathname.split('/')[1] + '/vendorTable/');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

});
