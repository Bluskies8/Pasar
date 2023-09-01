$(document).ready(function() {
    $('#btn-add-pasar').on('click', function() {
        $('#form-pasar').attr('action', '/superadmin/tambahPasar');
        $('#btn-delete-pasar').hide();

        $('#modal-pasar .modal-title').text('Tambah pasar baru');
        $('#input-nama-pasar').val('');
        $('#input-alamat-pasar').val('');

        $('#modal-pasar').modal('show');
    });

    var selectedPasarId = 0;
    var namaPasar = '', alamatPasar = '';
    $('.btn-update-pasar').on('click', function() {
        selectedPasarId = $(this).closest('.card').attr('id');
        $('#form-pasar').attr('action', '/superadmin/updatePasar');
        $('#btn-delete-pasar').show();

        namaPasar = $(this).closest('div.w-100').siblings().eq(1).text();
        alamatPasar = $(this).closest('div.w-100').siblings().eq(2).text();
        $('#modal-pasar .modal-title').text('Pengaturan ' + namaPasar);
        $('#input-nama-pasar').val(namaPasar);
        $('#input-alamat-pasar').val(alamatPasar);

        $('#modal-pasar').modal('show');
    });

    $('#btn-delete-pasar').on('click', function() {
        if (confirm("Konfirmasi penghapusan " + namaPasar + " ?")) {
            window.location.href = "/superadmin/deletePasar";
        }
    });

    $('.btn-select-pasar').on('click', function() {
        selectedPasarId = $(this).closest('.card').attr('id');
        window.location.href = "/superadmin/switch/" + selectedPasarId;
    });
});
