$(document).ready(function() {
    $('#table-invoice').DataTable({
        paging: false,
        columns: [
            null,
            null,
            null,
            null,
            { orderable: false }
        ]
    });

    let sumTotal = 0;
    $('.data-total').each(function(index, element) {
        let val = $(element).text();
        if (val != ''){
            let number = parseInt(val);
            sumTotal += number;
        }
        $('#data-total-sum').text(sumTotal.toLocaleString(['ban', 'id']));
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
        window.open('/invoice/' + currentID, 'Invoice');
        currentID = '';
    });

    $('#item-update').on('click', function() {
        // code ajax data invoice
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "POST",
            url: "invoice/transdetail",
            data: {
                id: currentID,
            },
            beforeSend: function(){
                console.log(currentID);
            },
            success: function(data) {
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // JSON.parse(undefined);
                console.log(xhr.status);
                console.log(thrownError);
                // console.log(ajaxOptions);
            }
        });
        // end ajax

        let biayaKuli = 0;
        $('.data-round').each(function(index, element) {
            let val = parseInt($(element).html());
            biayaKuli += val;
        });
        biayaKuli *= 1000;
        $('#biaya-kuli').text(biayaKuli.toLocaleString(['ban', 'id']));

        let biayaListrik = 0;
        if (biayaListrik != 0) {
            $("#select-listrik").val(biayaListrik).change();
        } else {
            $("#select-listrik").val("0").change();
        }

        $('#modal-invoice').modal('show');
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

    //set thousand separator
    var separatorInterval = setInterval(setThousandSeparator, 10);

    function setThousandSeparator () {
        let length = $('.thousand-separator').length;
        if (length != 0) {
            $('.thousand-separator').each(function(index, element) {
                let val = $(element).text();
                if (val != ''){
                    while(val.indexOf('.') != -1){
                        val = val.replace('.', '');
                    }
                    let number = parseInt(val);
                    $(element).text(number.toLocaleString(['ban', 'id']));
                }
            });
            clearInterval(separatorInterval);
        }
    };


    $('#generate-invoice').on('click', function() {
        // code ajax untuk generate invoice
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "get",
            url: "invoice/generate",
            data: {

            },
            beforeSend: function(){

            },
            success: function(data) {
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    $('.btn-save').on('click', function() {
        // code ajax untuk update selected invoice
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "POST",
            url: "invoice/update",
            data: {
                id: currentID,
                // listrik: ambil dr dropdown
            },
            beforeSend: function(){
                console.log(currentID);
            },
            success: function(data) {
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // JSON.parse(undefined);
                console.log(xhr.status);
                console.log(thrownError);
                // console.log(ajaxOptions);
            }
        });
        $('#modal-invoice').modal('hide');
    });

    $('#select-listrik').on('change', function() {
        $('#biaya-listrik').text($("#select-listrik option:selected").text());
    });
});
