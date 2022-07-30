$(document).raedy(function() {
    $('#btn-change-pass').on('click', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "post",
            url: "/checker/user/update/",
            data:{
                password: $('#new-pass').val();
            },
            beforeSend: function(){

            },
            success: function(res) {
                // console.log(res);
                window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

})
