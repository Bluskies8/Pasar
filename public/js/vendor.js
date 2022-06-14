$(document).ready(function() {
    $('td').on('dblclick', function(){
        $('#input-namaPT').val("");
        $('#nama-stand').text($(this).attr('id'));
        if ($(this).find('.nama-pt').text() != "") {
            $('#input-namaPT').val($(this).find('.nama-pt').text());
            $("select option").filter(function() {
                return $(this).text() == "1";
            }).prop('selected', true);
        }
        $('#modal-vendor').modal('show');
    });
});
