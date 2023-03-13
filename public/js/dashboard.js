$(document).ready(function() {

    let colors = ['rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
    let border = ['rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
    for (let i = 0; i < $('.nth-bulan').length; i++) {
        const element = $('.nth-bulan').eq(i).parent();
        element.css('background-color', colors[i]);
        element.css('border', '1px solid ' + border[i]);
    }

    var barangmasuk = $('meta[name="data-barang-masuk"]').attr('content');
    var pendapatan = $('meta[name="data-pendapatan-kotor"]').attr('content');
    var chartBarangMasuk = new Chart($('#chart-barang-masuk'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun','Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Barang Masuk',
                data: barangmasuk.split(','),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var chartPendapatanKotor = new Chart($('#chart-pendapatan-kotor'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun','Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendapatan Kotor',
                data: pendapatan.split(','),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

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
});
