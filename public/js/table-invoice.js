$(document).ready(function() {
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    $(document).keydown(function(e){
        if(e.which === 123){
            return false;
        }
    });

    $('#table-invoice').DataTable({
        scrollY: '77.1vh',
        scrollCollapse: true,
        paging: false,
        columns: [
            null,
            null,
            null,
            { orderable: false }
        ]
    });
    $('#table-invoice_filter').parent().siblings().append($('#container-tanggal').detach());
    $('#table-invoice_filter').parent().siblings().addClass('d-flex justify-content-center justify-content-md-start');
    $('#table-invoice_filter').closest('.row').addClass('g-0');

    let sumTotal = 0;
    function calculateTotal() {
        sumTotal = 0;
        $('.data-total').each(function(index, element) {
            let val = $(element).text();
            if (val != ''){
                let number = parseInt(val);
                sumTotal += number;
            }
        });
        sumTotal /= 2;
        $('#data-total-sum').text(sumTotal.toLocaleString(['ban', 'id']));
    }

    var flag = false;
    var currentID = '';
    var action;
    var role = window.location.pathname.split('/');
    var selectedRow = -1;
    $('.show-aksi').on('click', function() {
        $('#list-aksi').show();
        $('#list-aksi').css('left', $(this).offset().left - $('#side-nav').width() - 150 /* lebar list */ + 35.5 /* lebar button */);
        $('#list-aksi').css('top', $(this).offset().top - 50 /* tinggi header */ + 30 /* tinggi button */);
        currentID = $(this).parent().parent().children('.cell-id').text();
        selectedRow = $(this).parent().parent().attr('id');
        flag = true;
    });

    $('#item-detail').on('click', function() {
        window.open('/'+role[1]+'/invoice/' + currentID, 'Invoice');
        currentID = '';
    });

    $('#item-update').on('click', function() {
        $('#modal-invoice tbody').empty();
        action = "update";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "POST",
            url: "/"+role[1]+"/invoice/transdetail",
            data: {
                stand_id: selectedRow,
                invoice: currentID
            },
            beforeSend: function(){
                // console.log(currentID);
            },
            success: function(data) {
                // console.log(data);
                $('#modal-invoice tbody').empty();

                jQuery.each(data.trans, function( i, trans ) {
                    jQuery.each(trans.details, function( j, detail ) {
                        $('#modal-invoice tbody').append(
                            "<tr>" +
                                "<td>" + detail.htrans_id + "</td>" +
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

                $('#pelapak').val(data.stand.seller_name + " - " + data.stand.no_stand);
                $('#biaya-kuli').text(data.kuli);
                $('#biaya-total').text(data.total);
                $('#biaya-parkir').text(data.parkir);
                $('#biaya-dibayarkan').text(data.dibayarkan);
                $('#biaya-listrik').text(data.listrik);
                console.log(data.listrik);
                let biayaListrik = data.listrik;
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
        setTimeout(function() {
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

    var idlapak;
    $('#pelapak').on('change',function(e) {
        var namalapak = this.value;

        $('#list-pelapak option').each(function(index, element) {
            if(namalapak == element.value){
                idlapak = element.id;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        // 'contentType' : "application/json",
                    },
                    type: "POST",
                    url: "/"+role[1]+"/invoice/transdetail",
                    data: {
                        stand_id: element.id,
                    },
                    success: function(data) {
                        console.log(data)
                        $('#modal-invoice tbody').empty();

                        jQuery.each(data.trans, function( i, trans ) {
                            jQuery.each(trans.details, function( j, detail ) {
                                $('#modal-invoice tbody').append(
                                    "<tr>" +
                                        "<td>" + detail.htrans_id + "</td>" +
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
                        $('#biaya-kuli').text(data.kuli);
                        $('#biaya-total').text(data.total);
                        $('#biaya-parkir').text(data.parkir);
                        $('#biaya-dibayarkan').text(data.dibayarkan);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
    });

    $('#generate-invoice').on('click', function() {
        action = "insert";
        $("#select-listrik").val("0").change();
        $('#modal-invoice tbody').empty();
        $('#pelapak').val('');
        $('#biaya-kuli').text(0);
        $('#biaya-total').text(0);
        $('#biaya-parkir').text(0);
        $('#biaya-dibayarkan').text(0);
        $('#modal-invoice').modal('show');
        /*
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "get",
            url: "/"+role[1]+"/invoice/generate",
            success: function(data) {
                console.log(data);
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        */
    });

    $('.btn-save').on('click', function() {
        // code ajax untuk update selected invoice
        if(action == "insert"){
            if($('#pelapak').val()!=""){
                $('.error-msg-stand').text("");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        // 'contentType' : "application/json",
                    },
                    type: "get",
                    url: "/"+role[1]+"/invoice/generate/"+idlapak,
                    data: {
                        listrik: $("#select-listrik option:selected").val()
                    },
                    beforeSend: function(){
                        // console.log(listrik);
                    },
                    success: function(data) {
                        console.log(data);
                        if(data == 'success'){
                            location.reload();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // JSON.parse(undefined);
                        console.log(xhr.status);
                        console.log(thrownError);
                        // console.log(ajaxOptions);
                    }
                });
            }else{
                $('.error-msg-stand').text("stand harus di isi");
            }
        }else if(action == 'update'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    // 'contentType' : "application/json",
                },
                type: "post",
                url: "/"+role[1]+"/invoice/update",
                data: {
                    id:currentID,
                    listrik: $("#select-listrik option:selected").val()
                },
                beforeSend: function(){
                    // console.log(listrik);
                },
                success: function(data) {
                    console.log(data);
                    (data == 'err listrik')?$('.error-msg-listrik').text("value listrik salah"):$('.error-msg-listrik').text("");
                    if(data == 'success'){
                        location.reload();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    // JSON.parse(undefined);
                    console.log(xhr.status);
                    console.log(thrownError);
                    // console.log(ajaxOptions);
                }
            });
        }
        // $('#modal-invoice').modal('hide');
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
        var day = pad(temp.getDate(),2);
        var month = pad(temp.getMonth() + 1,2);
        var year = temp.getFullYear();
        var start = [day, month, year].join('-');
        window.location.href = "/"+role[1]+"/invoice?date="+start;
    });

});
