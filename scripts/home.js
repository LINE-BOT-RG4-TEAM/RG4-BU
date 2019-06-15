function home_data() 
{
  $.ajax({
    url: './api/home_data.php',
    method: 'POST',
    async: true,
    cache: false,
    processData: false,
    contentType: false,
    success: function(response) 
              {
                
                var obj = JSON.parse(response) || {};
                $("#high_value_card").html('จำนวน ' + obj.high_value + ' ราย');
                $("#bu_card").html('จำนวน ' + obj.bu + ' ราย');
                $("#not_bu_card").html('จำนวน ' + obj.not_bu + ' ราย');
                console.log(obj);
              }				
    }); 
}
home_data();

window.onload = function () {graph_month();}
function graph_quater()
{
    $('#myChart').remove();
    $('#chartarea').append('<canvas id="myChart" style="height:40vh; width:70vw"></canvas>');
    var ctx = document.getElementById('myChart');
                                var myChart = new Chart(ctx, {
                                                                type: 'bar',
                                                                data: {
                                                                        labels: ['ไตรมาส 1', 'ไตรมาส 2', 'ไตรมาส 3', 'ไตรมาส 4'],
                                                                        datasets: [
                                                                                    {
                                                                                        label: 'จำนวนลูกค้าที่ครบกำหนดบำรุงรักษาในแต่ละไตรมาส',
                                                                                        data: [3, 2, 1, 7],
                                                                                        backgroundColor: [
                                                                                            'rgba(255, 99, 132, 0.2)',
                                                                                            'rgba(54, 162, 235, 0.2)',
                                                                                            'rgba(255, 206, 86, 0.2)',
                                                                                            'rgba(75, 192, 192, 0.2)'
                                                                                        ],
                                                                                        borderColor: [
                                                                                            'rgba(255, 99, 132, 1)',
                                                                                            'rgba(54, 162, 235, 1)',
                                                                                            'rgba(255, 206, 86, 1)',
                                                                                            'rgba(75, 192, 192, 1)'
                                                                                        ],
                                                                                        borderWidth: 0
                                                                                    }/*,
                                                                                    {
                                                                                        label: 'จำนวน',
                                                                                        data: [7, 2, 3, 5, 2,0],
                                                                                        backgroundColor: [
                                                                                            'rgba(255, 99, 132, 0.2)',
                                                                                            'rgba(54, 162, 235, 0.2)',
                                                                                            'rgba(255, 206, 86, 0.2)',
                                                                                            'rgba(75, 192, 192, 0.2)',
                                                                                            'rgba(153, 102, 255, 0.2)',
                                                                                            'rgba(255, 159, 64, 0.2)'
                                                                                        ],
                                                                                        borderColor: [
                                                                                            'rgba(255, 99, 132, 1)',
                                                                                            'rgba(54, 162, 235, 1)',
                                                                                            'rgba(255, 206, 86, 1)',
                                                                                            'rgba(75, 192, 192, 1)',
                                                                                            'rgba(153, 102, 255, 1)',
                                                                                            'rgba(255, 159, 64, 1)'
                                                                                        ],
                                                                                        borderWidth: 1
                                                                                    }*/
                                                                                ]
                                                                        },
                                                                options: {
                                                                            responsive: false,
                                                                            scales: {
                                                                                yAxes: [{
                                                                                    ticks: {
                                                                                        beginAtZero: true
                                                                                    }
                                                                                }]
                                                                            }
                                                                        }
                                                                });
}

function graph_month()
{
    $('#myChart').remove();
    $('#chartarea').append('<canvas id="myChart" style="height:40vh; width:70vw"></canvas>');
    var ctx = document.getElementById('myChart');
                                var myChart = new Chart(ctx, {
                                                                type: 'bar',
                                                                data: {
                                                                        labels: ['มิ.ย.-62', 'ก.ค.-62', 'ส.ค.-62', 'ก.ย.-62', 'ต.ค.-62', 'พ.ย.'],
                                                                        datasets: [
                                                                                    {
                                                                                        label: 'จำนวนลูกค้าที่ครบกำหนดบำรุงรักษาในแต่ละเดือน',
                                                                                        data: [7, 2, 3, 5, 2, 3],
                                                                                        backgroundColor: [
                                                                                            'rgba(255, 99, 132, 0.2)',
                                                                                            'rgba(54, 162, 235, 0.2)',
                                                                                            'rgba(255, 206, 86, 0.2)',
                                                                                            'rgba(75, 192, 192, 0.2)',
                                                                                            'rgba(153, 102, 255, 0.2)',
                                                                                            'rgba(255, 159, 64, 0.2)'
                                                                                        ],
                                                                                        borderColor: [
                                                                                            'rgba(255, 99, 132, 1)',
                                                                                            'rgba(54, 162, 235, 1)',
                                                                                            'rgba(255, 206, 86, 1)',
                                                                                            'rgba(75, 192, 192, 1)',
                                                                                            'rgba(153, 102, 255, 1)',
                                                                                            'rgba(255, 159, 64, 1)'
                                                                                        ],
                                                                                        borderWidth: 0
                                                                                    }/*,
                                                                                    {
                                                                                        label: 'จำนวน',
                                                                                        data: [7, 2, 3, 5, 2,0],
                                                                                        backgroundColor: [
                                                                                            'rgba(255, 99, 132, 0.2)',
                                                                                            'rgba(54, 162, 235, 0.2)',
                                                                                            'rgba(255, 206, 86, 0.2)',
                                                                                            'rgba(75, 192, 192, 0.2)',
                                                                                            'rgba(153, 102, 255, 0.2)',
                                                                                            'rgba(255, 159, 64, 0.2)'
                                                                                        ],
                                                                                        borderColor: [
                                                                                            'rgba(255, 99, 132, 1)',
                                                                                            'rgba(54, 162, 235, 1)',
                                                                                            'rgba(255, 206, 86, 1)',
                                                                                            'rgba(75, 192, 192, 1)',
                                                                                            'rgba(153, 102, 255, 1)',
                                                                                            'rgba(255, 159, 64, 1)'
                                                                                        ],
                                                                                        borderWidth: 1
                                                                                    }*/
                                                                                ]
                                                                        },
                                                                options: {
                                                                            responsive: false,
                                                                            scales: {
                                                                                yAxes: [{
                                                                                    ticks: {
                                                                                        beginAtZero: true
                                                                                    }
                                                                                }]
                                                                            }
                                                                        }
                                                                });
}
