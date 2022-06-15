$(document).ready(function() {
    $('#table-invoice').DataTable({
        paging: false,
        columns: [
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
    var selecetedRow = -1;
    $('.show-aksi').on('click', function() {
        $('#list-aksi').show();
        $('#list-aksi').css('left', $(this).offset().left - $('#side-nav').width() - 130 /* lebar list */ + 35.5 /* lebar button */);
        $('#list-aksi').css('top', $(this).offset().top - 50 /* tinggi header */ + 30 /* tinggi button */);
        currentID = $(this).parent().parent().children('.cell-id').text();
        selecetedRow = $(this).parent().parent().attr('id');
        flag = true;
    });

    $('#item-detail').on('click', function() {
        window.open('/invoice/' + currentID, 'Invoice');
        currentID = '';
    });

    $('#item-update').on('click', function() {
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
                // console.log(currentID);
            },
            success: function(data) {
                console.log(data);
                $('.modal-invoice tbody').empty();

                jQuery.each(data.trans, function( i, trans ) {
                    jQuery.each(trans.details, function( j, detail ) {
                        $('.modal-invoice tbody').append(
                            "<tr>" +
                                "<td>" + detail.kode + "</td>" +
                                "<td>" + detail.nama_barang + "</td>" +
                                "<td>" + detail.jumlah + "</td>" +
                                "<td>" + detail.bruto + "</td>" +
                                "<td>" + detail.round + "</td>" +
                                "<td><div class='d-flex justify-content-between'>Rp <span class='thousand-separator'>" + detail.parkir + "</span></div></td>" +
                                "<td><div class='d-flex justify-content-between'>Rp <span class='thousand-separator'>" + detail.subtotal + "</span></div></td>" +
                            "</tr>"
                        );
                    });
                });

                $('#nama-lapak').text(data.stand.seller_name);
                $('#biaya-kuli').text(data.invoice.kuli);
                $('#biaya-total').text(data.invoice.total - data.invoice.parkir);
                $('#biaya-parkir').text(data.invoice.parkir);
                $('#biaya-dibayarkan').text(data.invoice.total + data.invoice.kuli);

                let biayaListrik = data.invoice.listrik;
                if (biayaListrik != 0) {
                    $("#select-listrik").val(biayaListrik).change();
                } else {
                    $("#select-listrik").val("0").change();
                }

                separatorInterval = setInterval(setThousandSeparator, 10);
                $('#modal-invoice').modal('show');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // JSON.parse(undefined);
                console.log(xhr.status);
                console.log(thrownError);
                // console.log(ajaxOptions);
            }
        });
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
            tidyBruto();
            clearInterval(separatorInterval);
        }
    };

    function tidyBruto() {
        $('#modal-invoice tbody td:nth-child(4)').each(function(index, element) {
            let temp = $(element).html();
            if (temp != '') {
                if (temp.substr(temp.indexOf('.')).length > 4) {
                    $(element).html(temp.substr(0, temp.indexOf('.') + 4));
                }
            }
        });
    }


    $('#generate-invoice').on('click', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "get",
            url: "invoice/generate",
            success: function(data) {
                console.log(data);
                location.reload();
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
                listrik: $("#select-listrik option:selected").val()
            },
            beforeSend: function(){
                // console.log(listrik);
            },
            success: function(data) {
                console.log(data);
                location.reload();
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

        let dibayarkan = 0;
        $('.biaya').each(function(index, element) {
            let val = $(element).text();
            if (val != ''){
                while(val.indexOf('.') != -1){
                    val = val.replace('.', '');
                }
                let number = parseInt(val);
                dibayarkan += number;
            }
        });
        $('#biaya-dibayarkan').text(dibayarkan.toLocaleString(['ban', 'id']))
    });

    $("#selected-date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
        function pad (str, max) {
            str = str.toString();
            return str.length < max ? pad("0" + str, max) : str;
        }
        var temp = new Date($('#selected-date').val());
        var day = temp.getDate();
        var month = pad(temp.getMonth() + 1,2);
        var year = temp.getFullYear();
        var start = [year, month, day].join('-') + ' 07:00:00';
        var end = [year, month, day+1].join('-') + ' 07:00:00';
        // ubah data tabel
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "POST",
            url: "invoice/dates",
            data: {
                start: start,
                end:end
            },
            beforeSend: function(){
                console.log("start: "+start + " end: "+end);
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
    }).trigger("change");
});
