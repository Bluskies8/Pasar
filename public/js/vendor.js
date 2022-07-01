$(document).ready(function() {

    var currentID = "";
    $('td').on('dblclick', function(){
        $('#input-namaPT').val("");
        $('#nama-stand').text($(this).attr('id'));
        // if ($(this).find('.nama-pt').text() != "") {
            $('#input-namaPT').val($(this).find('.nama-pt').text());
            $('#input-pemilik').val($(this).find('.nama-lapak').text());
        // }
        currentID = $(this).attr('id');
        console.log(currentID);
        $('#modal-vendor').modal('show');
    });
    $('#btn-save').click(function () {
        var badan_usaha = $('#input-namaPT').val();
        var seller_name = $('#input-pemilik').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "post",
            url: "vendor/update",
            data: {
                id: currentID,
                seller_name: seller_name,
                badan_usaha: badan_usaha
            },
            before: function(){
                console.log(id);
                console.log(badan_usaha);
                console.log(seller_name);
            },
            success: function(data) {
                console.log(data);
                // location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
});
