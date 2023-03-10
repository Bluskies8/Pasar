$(document).ready(function() {
    $('#table-stock').load(window.location.origin + "/" + window.location.pathname.split('/')[1] + '/stockTable/' + new Date().getFullYear() + '/' + ("0" + (new Date().getMonth() + 1)).slice(-2), function() {
        setThousandSeparator();
    });

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
        }
    };

    var flag = false;
    var role = window.location.pathname.split('/');
    var selectedID = '';
    $('#table-stock').on('click', '.show-aksi', function() {
        $('#list-aksi').css('left', $(this).offset().left - $('#side-nav').width() - 150 /* lebar list */ + 33.5 /* lebar button */);
        $('#list-aksi').css('top', $(this).offset().top - 50 /* tinggi header */ + 30 /* tinggi button */);
        $('#list-aksi').show();
        selectedID = $(this).attr('id').substr(4);
        flag = true;
    });
    function toShortFormat(mon,year) {

        const monthNames = ["Jan", "Feb", "Mar", "Apr",
                            "May", "Jun", "Jul", "Aug",
                            "Sep", "Oct", "Nov", "Dec"];

        // const monthIndex = this.getMonth();
        const monthName = monthNames[mon];
        // const year = this.getFullYear();

        return `${monthName}-${year}`;
    }
    $('#selected-date').on('change', function(){
        var tempmonth = new Date($(this).val()).getMonth();
        var tempyear = new Date($(this).val()).getFullYear();
        $(this).attr('data-date', toShortFormat(tempmonth, tempyear));
        $('#table-stock').load(window.location.origin + "/" + window.location.pathname.split('/')[1] + '/stockTable/' + tempyear + '/' + ("0" + (tempmonth + 1)).slice(-2), function() {
            setThousandSeparator();
        });

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

    $('#item-detail').on('click', function() {
        location.href = '/'+role[1]+'/details/' + selectedID;
        selectedID = '';
    });

    $('#item-delete').on('click', function() {
        if (confirm('Yakin untuk menghapus transaksi ' + selectedID + ' ?')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    // 'contentType' : "application/json",
                },
                type: "POST",
                url: "/"+role[1]+"/transaction/delete/"+selectedID,
                beforeSend: function(){
                    //console.log(currentID);
                },
                success: function(data) {
                    console.log(data);
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }
    });
});
