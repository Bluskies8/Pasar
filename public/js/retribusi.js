$(document).ready(function() {

    var retribusi = $('meta[name="retribusi"]').attr('content');
    var listrik = $('meta[name="listrik"]').attr('content');
    var kuli = $('meta[name="kuli"]').attr('content');
    alert(retribusi + '\n' + listrik + '\n' + kuli)
    $('#table-1').DataTable();
    $('#table-2').DataTable();

    var separatorInterval = setInterval(setThousandSeparator, 10);

    function setThousandSeparator () {
        let length = $('.thousand-separator').length;
        if (length != 0) {
            $('.thousand-separator').each(function(index, element) {
                let val = $(element).text();
                if (val != '') {
                    while(val.indexOf('.') != -1) {
                        val = val.replace('.', '');
                    }
                    let number = parseInt(val);
                    $(element).text(number.toLocaleString(['ban', 'id']));
                }
            });
            clearInterval(separatorInterval);
        }
    };

    $('#btn-retribusi').on('click', function(){
        $('#modal-retribusi').modal('show');
    });
});
