$(document).ready(function() {
    //set thousand separator
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
            tidyBruto();
            clearInterval(separatorInterval);
        }
    };

    function tidyBruto() {
        $('#table-detail-invoice tbody td:nth-child(4)').each(function(index, element) {
            let temp = $(element).html();
            if (temp != '') {
                if (temp.substr(temp.indexOf('.')).length > 4) {
                    $(element).html(temp.substr(0, temp.indexOf('.') + 4));
                }
            }
        });
    }
});
