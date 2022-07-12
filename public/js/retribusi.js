$(document).ready(function() {
    $('#table-1').DataTable();
    $('#table-2').DataTable();

    var retribusi = $('meta[name="retribusi"]').attr('content');
    var listrik = $('meta[name="listrik"]').attr('content');
    var kuli = $('meta[name="kuli"]').attr('content');

    console.log('retribusi : ' + retribusi + '\nlistrik : ' + listrik + '\n kuli : ' + kuli);

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

    $('#clone-tambahan').addClass('d-none');

    var tambahanId = 0;
    var tambahanCount = 0;
    cloneTambahan();

    $('#icon-add').on('click', function() {
        cloneTambahan();
    });

    function cloneTambahan() {
        tambahanId++;
        tambahanCount++;
        let temp = $('#clone-tambahan').clone().prop('id', 'tambahan-' + tambahanId).appendTo("#list-tambahan");
        temp.removeClass('d-none');
        temp.addClass('d-flex');

        let selectorDelete = temp.children('.delete-tambahan');
        selectorDelete.on('click', function() {
            $(this).parent().detach();
            tambahanCount--;
        });
    }
});
