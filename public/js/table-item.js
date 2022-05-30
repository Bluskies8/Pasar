$(document).ready(function(){
    $('#table-item').DataTable();

    $('#tambah-barang').on('click', function() {
        $('#modal-barang').modal('show');
        $('#new-form').show();
    });

    $('#new-form').on('click', function() {
        let temp = $("#form-template").clone().appendTo("#modal-row");
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
});
