$(document).ready(function() {
    $('#table-item').DataTable();

    $('#tambah-barang').on('click', function() {
        $('#modal-barang').modal('show');
        $('#new-form').show();
    });

    $('#new-form').on('click', function() {
        let temp = $("#form-template").clone().appendTo("#input-form");
        temp.show();
    });

    $('#ubah-barang').on('click', function() {
        $('#modal-barang').modal('show');
        $('#new-form').hide();
    });

    $('#hapus-barang').on('click', function() {
        if (confirm("Yakin untuk menghapus barang") == true) {
            // if yes
        } else {
            // if no
        }
    });
    $("#save-barang").on('click', function(e) {
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
            // console.log(data);
        // var temp = JSON.stringify(data);
        $.ajax({
            type: "POST",
            url: "transaction/create",
            // dataType: "json",
            // data: $('form').serialize(),
            data: {
                stand_id: 1,
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
});
