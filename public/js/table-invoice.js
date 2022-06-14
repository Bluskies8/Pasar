$(document).ready(function() {
    $('#table-invoice').DataTable({
        paging: false,
        columns: [
            null,
            null,
            null,
            null,
            { orderable: false }
        ]
    });

    let sumTotal = 0;
    $('.data-total').each(function(index, element) {
        let val = $(element).text();
        if (val != ''){
            let number = parseInt(val);
            sumTotal += number;
        }
        $('#data-total-sum').text(sumTotal.toLocaleString(['ban', 'id']));
    });

    var flag = false;
    var currentID = '';
    $('.show-aksi').on('click', function() {
        $('#list-aksi').show();
        $('#list-aksi').css('left', $(this).offset().left - $('#side-nav').width() - 130 /* lebar list */ + 35.5 /* lebar button */);
        $('#list-aksi').css('top', $(this).offset().top - 50 /* tinggi header */ + 30 /* tinggi button */);
        currentID = $(this).parent().parent().children('.cell-id').text();
        flag = true;
    });

    $('#item-detail').on('click', function() {
        window.open('/invoice/' + currentID, 'Invoice');
        currentID = '';
    });

    $(document).on('click', function() {
        setTimeout(function (){
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
            clearInterval(separatorInterval);
        }
    };


    var tambahanId = 0;
    // $('#generate-invoice').on('click', function() {
    //     if (tambahanId == 0) {
    //         cloneBiaya();
    //     }

    //     // event ini nanti akan dirubah ketika on lapak selected
    //     let biayaKuli = 0;
    //     $('.data-round').each(function(index, element) {
    //         let val = parseInt($(element).html());
    //         biayaKuli += val;
    //     });
    //     biayaKuli *= 1000;
    //     $('#biaya-kuli').text(biayaKuli.toLocaleString(['ban', 'id']));
    //     // end event

    //     $('#modal-invoice').modal('show');
    // });

    /*
    $('.btn-save').on('click', function() {
        window.open('/invoice/generate', 'Invoice');
        $('#modal-invoice').modal('hide');
    });
    */

    function cloneBiaya() {
        tambahanId++;
        let temp = $('#clone-biaya').clone().prop('id', 'tambahan-' + tambahanId).appendTo("#list-tambahan");
        temp.removeClass('d-none');
        temp.addClass('d-flex');
    }

    $(document).on('click', '.add-tambahan', function() {
        cloneBiaya();
        $(this).hide();
        $(this).siblings('.btn').show();
    });

    $(document).on('click', '.delete-tambahan', function() {
        $(this).parent().remove();
    });

    $('#select-listrik').on('change', function() {
        $('#biaya-listrik').text($("#select-listrik option:selected").text());
    });
});
