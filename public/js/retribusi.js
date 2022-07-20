$(document).ready(function() {
    $('#table-1').DataTable();
    $('#table-2').DataTable();

    // var retribusi = $('meta[name="retribusi"]').attr('content');
    // var listrik = $('meta[name="listrik"]').attr('content');
    // var kuli = $('meta[name="kuli"]').attr('content');

    // console.log('retribusi : ' + retribusi + '\nlistrik : ' + listrik + '\n kuli : ' + kuli);

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

    $("#selected-date").on("change", function() {
        // this.setAttribute(
        //     "data-date",
        //     moment(this.value, "YYYY-MM-DD")
        //     .format( this.getAttribute("data-date-format") )
        // )
        function pad (str, max) {
            str = str.toString();
            return str.length < max ? pad("0" + str, max) : str;
        }
        var temp = new Date($('#selected-date').val());
        var day = pad(temp.getDate(),2);
        var month = pad(temp.getMonth() + 1,2);
        var year = temp.getFullYear();
        var start = [year, month, day].join('-');
        window.location.href = "retribusi?date="+start;
    });

    $('#btn-retribusi').on('click', function(){
        // this.setAttribute(
        //     "data-date",
        //     moment(this.value, "YYYY-MM-DD")
        //     .format( this.getAttribute("data-date-format") )
        // )
        function pad (str, max) {
            str = str.toString();
            return str.length < max ? pad("0" + str, max) : str;
        }
        var temp = new Date($('#selected-date').val());
        var day = pad(temp.getDate(),2);
        var month = pad(temp.getMonth() + 1,2);
        var year = temp.getFullYear();
        var start = [year, month, day].join('-');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "POST",
            url: "retribusi/getretri",
            data: {
                date: start
            },
            beforeSend: function(){

            },
            success: function(data) {
                console.log(data);
                $('#retribusi').val(data.retribusi);
                $('#kuli').val(data.kuli);
                $('#listrik').val(data.listrik);
                $('#total_retribusi').val(data.total);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // JSON.parse(undefined);
                console.log(xhr.status);
                console.log(thrownError);
                // console.log(ajaxOptions);
            }
        });
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

    $('#btn-save').on('click', function() {
        let nama = $('input[name="nama"]');
        let nominal = $('input[name="nominal"]');
        let tipe = $('select[name="tipe"]');
        let data = [];
        for (let i = 1; i < nama.length; i++) {
            if(nama[i].value && nominal[i].value){
                data.push({
                    nama: nama[i].value,
                    nominal: nominal[i].value,
                    tipe:tipe[i].value,
                });
            }
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'contentType' : "application/json",
            },
            type: "POST",
            url: "retribusi/create",
            data: {
                retribusi: $('#retribusi').val(),
                listrik:$('#listrik').val(),
                kuli:$('#kuli').val(),
                sampah:$('#sampah').val(),
                ponten_siang:$('#ponten_siang').val(),
                ponten_malam:$('#ponten_malam').val(),
                parkir_siang:$('#parkir_siang').val(),
                parkir_malam:$('#parkir_malam').val(),
                motor_siang:$('#motor_siang').val(),
                motor_malam:$('#motor_malam').val(),
                tambahan:data
            },
            beforeSend: function(){

            },
            success: function(data) {
                console.log(data);
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // JSON.parse(undefined);
                console.log(xhr.status);
                console.log(thrownError);
                // console.log(ajaxOptions);
            }
        });
    });
});
