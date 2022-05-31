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
