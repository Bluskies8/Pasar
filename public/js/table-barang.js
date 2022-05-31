$(document).ready(function(){
    $('#table-barang').DataTable({
        paging: false,
        info: false,
    });

    if ($('#nama-pelapak').text() != '') {
        $('#dropdown-pelapak').hide();
    }

    var formId = 0;
    $('#tambah-barang').on('click', function() {
        if ($('#modal-row').children().length == 1) {
            cloneTemplate();
            $("#form-template").hide();
        }
        $('#modal-barang').modal('show');
        $('#new-form').show();
    });

    $('#new-form').on('click', function() {
        cloneTemplate();
    });
    $('#save-barang').on('click', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            }
        });
        e.preventDefault();
        var data = [];
        var kode = document.getElementsByName('kode[]');
        var nama = document.getElementsByName('nama[]');
        var netto = document.getElementsByName('netto[]');
        var parkir = document.getElementsByName('parkir[]');
        var jumlah = document.getElementsByName('jumlah[]');
        var lapak = document.getElementsByName('pelapak');

        var temp=$("#pelapak").val();
        var lapak =  $('#list-pelapak').find('option[value="' +temp + '"]').attr('id');;
        var val = 0;
        $("input[name = 'nama[]']").each(function(){
            if(val > 0){
                data.push({
                    kode: kode[val].value,
                    nama:nama[val].value,
                    netto:netto[val].value,
                    parkir:parkir[val].value,
                    jumlah:jumlah[val].value
                });
            }
            val++;
        });
            console.log(data);
        $.ajax({
            type: "POST",
            url: "transaction/create",
            // dataType: "json",
            // data: $('form').serialize(),
            data: {
                stand_id: lapak,
                transportasi:"pick up",
                items:data
            },
            beforeSend: function(){
                console.log( this.data );
            },
            success: function(data) {
                console.log(data);
                if(data == "Berhasil Input data")
                $('#modal-barang').modal('hide');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // JSON.parse(undefined);
                console.log(xhr.status);
                console.log(thrownError);
                // console.log(ajaxOptions);
            },
        });
    });
    function cloneTemplate() {
        formId++;
        let temp = $("#form-template").clone().prop('id', 'form-' + formId).appendTo("#modal-row");
        temp.show();
    }

    //set thousand separator
    let separatorInterval = setInterval(function() {
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
    }, 10);
});
