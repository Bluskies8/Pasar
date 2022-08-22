$(document).ready(function(){
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    $(document).keydown(function(e){
        if(e.which === 123){
            return false;
        }
    });

    $('#check-confirm').hide();
    $('#table-barang').DataTable({
        paging: false,
        info: false
    });

    if ($('#nama-pelapak').text() != '') {
        $('#pelapak').hide();
    }

    var formCount;
    var formID;
    var action;
    $('#tambah-barang').on('click', function() {
        action = "insert";
        formCount = 0;
        formID = 0;
        let save = $('#form-template').detach();
        $('#modal-row').empty().append(save);
        cloneForm();
        $('#modal-barang').modal('show');
        $('#new-form').show();
    });

    $('#new-form').on('click', function() {
        cloneForm();
    });

    function cloneForm() {
        formCount++;
        formID++;
        $('#save-barang').prop('disabled', false);
        let temp = $('#form-template').clone().prop('id', 'form-' + formID).appendTo("#modal-row");

        let btnRemoveForm = $('#form-' + formID).children().children().children('.btn-remove-form');
        $(btnRemoveForm).on('click', function() {
            formCount--;
            if (formCount == 0) {
                $('#save-barang').prop('disabled', true);
            }
            $(this).parent().parent().parent().detach();
        });

        let errorMessage = $('#form-' + formID + " .error-msg").prop('id', 'error-message-' + formID);
        let errorMessagebuah = $('#form-' + formID + " .error-msg-jumlah").prop('id', 'error-jumlah-' + formID);

        temp.show();
    }

    //set thousand separator
    var separatorInterval = setInterval(setThousandSeparator, 10);
    var role = window.location.pathname.split('/');

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

    $('#save-barang').on('click', function() {
        let kode = $('select[name="kode"]');
        let nama = $('input[name="nama"]');
        let jumlah = $('input[name="jumlah"]');
        let parkir = $('select[name="parkir"]');
        var check = [];
        var check2 = [];
        var data = [];
        console.log(action);
        if(action == "insert"){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "get",
                url: "/"+role[1]+"/buah/cari",
                beforeSend: function(){
                    // console.log(this.data);
                },
                success: function(res) {
                    console.log(res);
                    res.forEach(element => {
                        data.push(element.name);
                    });
                    for (let i = 1; i < formCount + 1; i++) {
                        console.log(jumlah[i].value);
                        if(!jumlah[i].value){
                            $('#error-jumlah-'+i).text('jumlah harus di isi')
                            check2[i] = "false";
                        }else{
                            $('#error-jumlah-'+i).text('');
                        }
                        if($.inArray( nama[i].value, data ) == -1){
                            $('#error-message-'+i).text("buah tidak terdaftar");

                            check[i] = "false";
                        }else{
                            $('#error-message-'+i).text("");
                            check[i] = "true";
                        }
                    }
                    if($.inArray( "false", check ) == -1 && $.inArray( "false", check2 ) == -1){
                        for (let i = 1; i < formCount + 1; i++) {
                            if(nama[i].value && jumlah[i].value){
                                let temp = $('#tr-template').clone().appendTo("#table-barang tbody");
                                temp.attr('id','tr-' + (i + 1));
                                temp.find('.data-kode').html(kode[i].value);
                                temp.find('.data-nama').html(nama[i].value);
                                temp.find('.data-jumlah').html(jumlah[i].value);
                                temp.find('.data-parkir').text(parkir[i].value);
                                temp.show();
                            }
                        }
                        $('#modal-barang').modal('hide');
                        separatorInterval = setInterval(setThousandSeparator, 10);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }else if(action == 'update'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "get",
                url: "/"+role[1]+"/buah/cari",
                beforeSend: function(){
                    // console.log(this.data);
                },
                success: function(res) {
                    res.forEach(element => {
                        data.push(element.name);
                    });
                    for (let i = 1; i < formCount + 1; i++) {
                        if(!jumlah[i].value){
                            $('#error-jumlah-'+i).text('jumlah harus di isi')
                            check2[i] = "false";
                        }else{
                            $('#error-jumlah-'+i).text('');
                        }
                        if($.inArray( nama[i].value, data ) == -1){
                            $('#error-message-'+i).text("buah tidak terdaftar");

                            check[i] = "false";
                        }else{
                            $('#error-message-'+i).text("");
                            check[i] = "true";
                        }
                    }
                    if($.inArray( "false", check ) == -1 && $.inArray( "false", check2 ) == -1){
                        var temp = [];
                        for (let i = 1; i < formCount + 1; i++) {
                            temp.push({
                                id : $('#form-' + i + ' #id-dtrans').val(),
                                kode: $('#form-' + i + ' .select-kode').val(),
                                jumlah: $('#form-' + i + ' .jumlah-buah').val(),
                            });
                        }
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            type: "get",
                            url: "/"+role[1]+"/details/update/"+ $('#id-transaksi').text(),
                            data:{
                                data: temp
                            },
                            beforeSend: function(){
                                // console.log(this.data);
                            },
                            success: function(res) {
                                console.log(res)
                                window.location.reload();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log(xhr.status);
                                console.log(thrownError);
                            }
                        });
                        // $('#modal-barang').modal('hide');
                        separatorInterval = setInterval(setThousandSeparator, 10);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }

    });

    $('#save-detail').on('click', function(e) {
        // insert data table ke db
        $(this).prop('disabled', true);
        let save = $('#tr-template').detach();

        let lapak = $('#list-pelapak').find('option[value="' + $('#pelapak').val() + '"]').attr('id');
        if (typeof lapak === "undefined") {
            alert("pilih nama lapak terlebih dahulu !");
            return;
        }

        let data = [];

        $('tbody tr').each(function() {
            let parkir = $(this).find('.data-parkir').html();
            while(parkir.indexOf('.') != -1){
                parkir = parkir.replace('.', '');
            }

            data.push({
                kode: $(this).find('.data-kode').html(),
                nama: $(this).find('.data-nama').html(),
                jumlah: $(this).find('.data-jumlah').html(),
                parkir: parkir
            });
        });

        if (data.length == 0) {
            alert("silahkan tambah barang terlebih dahulu !");
            return;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "POST",
            url: "/"+role[1]+"/transaction/create",
            data: {
                stand_id: lapak,
                transportasi:"pick up",
                items:data
            },
            beforeSend: function(){
                // console.log(this.data);
            },
            success: function(data) {
                console.log(data)
                //pindah ke halaman stock dan data masuk ke tabel
                if(data == "Success") {
                    window.location.href = 'stock';
                }else{
                    $('.alert-confirm').html(data);
                    $('#check-confirm').show();
                }
                // $('#tambah-barang').hide();
                // $('#save-detail').hide();
                // $('#pelapak').hide();
                // $('#nama-pelapak').text($('#pelapak').val());
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // JSON.parse(undefined);
                console.log(xhr.status);
                console.log(thrownError);
                // console.log(ajaxOptions);
            }
        });

        // untuk mengembalikan template
        $('tbody').prepend(save);
    });

    $('#update-detail').on('click', function() {
        action = "update";
        formCount = 0;
        formID = 0;
        let save = $('#form-template').detach();
        $('#modal-row').empty().append(save);
        $('.modal-title').text('Rubah Barang');
        $('#modal-barang').modal('show');
        for (let i = 0; i < $('#table-barang tbody tr').length; i++) {
            const element = $('#table-barang tbody tr').eq(i);
            cloneForm2(element);
        }
    });

    function cloneForm2(element) {
        formCount++;
        formID++;
        $('#save-barang').prop('disabled', false);
        let temp = $('#form-template').clone().prop('id', 'form-' + formID).appendTo("#modal-row");

        $('#form-' + formID + ' #id-dtrans').val(element.children('td:nth-child(8)').html());
        // set select id
        $('#form-' + formID + ' .select-kode').val(element.children('td:nth-child(1)').html());

        // set nama buah
        $('#form-' + formID + ' .nama-buah').val(element.children('td:nth-child(2)').html());
        $('#form-' + formID + ' .nama-buah').attr('disabled','disabled');

        // set jumlah buah
        $('#form-' + formID + ' .jumlah-buah').val(element.children('td:nth-child(3)').html());

        // set select parkir
        let removedDot = element.children('td:nth-child(6)').children().children('.thousand-separator').text().replace('.', '');
        $('#form-' + formID + ' .select-parkir').val(removedDot);
        $('#form-' + formID + ' .select-parkir').attr('disabled','disabled');

        let btnRemoveForm = $('#form-' + formID).children().children().children('.btn-remove-form');
        $(btnRemoveForm).on('click', function() {
            formCount--;
            if (formCount == 0) {
                $('#save-barang').prop('disabled', true);
            }
            $(this).parent().parent().parent().detach();
        });

        let errorMessage = $('#form-' + formID + " .error-msg").prop('id', 'error-message-' + formID);
        let errorMessagebuah = $('#form-' + formID + " .error-msg-jumlah").prop('id', 'error-jumlah-' + formID);

        temp.show();
    }

    tidyBruto();

    function tidyBruto() {
        $('#table-barang tbody td:nth-child(4)').each(function(index, element) {
            let temp = $(element).html();
            if (temp != '') {
                if (temp.substr(temp.indexOf('.')).length > 4) {
                    $(element).html(temp.substr(0, temp.indexOf('.') + 4));
                }
            }
        });
    }
});
