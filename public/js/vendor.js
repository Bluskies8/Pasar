$(document).ready(function() {
    $('td').on('dblclick', function(){
        $('#input-namaPT').val("");
        $('#nama-stand').text($(this).attr('id'));
        if ($(this).find('.nama-pt').text() != "") {
            $('#input-namaPT').val($(this).find('.nama-pt').text());
            $('#input-pemilik').val($(this).find('.nama-lapak').text());
        }
        $('#modal-vendor').modal('show');
    });
});
