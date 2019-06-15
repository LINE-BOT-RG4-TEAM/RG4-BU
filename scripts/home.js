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
    $('#month_name').text("รายไตรมาส");
    $('#myChart').remove();
    $('#chartarea').append('<canvas id="myChart" style="height:40vh; width:70vw"></canvas>');
    var ctx = document.getElementById('myChart');
                                var myChart = new Chart(ctx, {
                                                                type: 'bar',
                                                                data: {
                                                                        labels: ['ไตรมาส 3-62', 'ไตรมาส 4-62', 'ไตรมาส 1-63', 'ไตรมาส 2-63'],
                                                                        datasets: [
                                                                                    {
                                                                                        label: 'จำนวนลูกค้าที่ครบกำหนดบำรุงรักษาในแต่ละไตรมาส',
                                                                                        data: [
                                                                                            Math.floor((Math.random() * 10) + 1),
                                                                                            Math.floor((Math.random() * 10) + 1),
                                                                                            Math.floor((Math.random() * 10) + 1),
                                                                                            Math.floor((Math.random() * 10) + 1),
                                                                                            Math.floor((Math.random() * 10) + 1),
                                                                                            Math.floor((Math.random() * 10) + 1)
                                                                                          ],
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
                                                                            legend: {
                                                                                display: false
                                                                            },
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
    $('#month_name').text("รายเดือน");
    $('#myChart').remove();
    $('#chartarea').append('<canvas id="myChart" style="height:40vh; width:70vw"></canvas>');
    var ctx = document.getElementById('myChart');
                                var myChart = new Chart(ctx, {
                                                                type: 'bar',
                                                                data: {
                                                                        labels: ['มิ.ย.-62', 'ก.ค.-62', 'ส.ค.-62', 'ก.ย.-62', 'ต.ค.-62', 'พ.ย.-62'],
                                                                        datasets: [
                                                                                    {
                                                                                        label: 'จำนวนลูกค้าที่ครบกำหนดบำรุงรักษาในแต่ละเดือน',
                                                                                        data: [
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1)
                                                                                              ],
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
                                                                            },
                                                                            legend: {
                                                                                display: false
                                                                            },
                                                                            'onClick' : function (evt, item) {
                                                                                graph_monthly(item[0]['_model'].label);
                                                                                console.log('legd item', item);
                                                                                console.log(item[0]['_model'].label);
                                                                            }
                                                                        }
                                                                });
}

function graph_monthly(month_name)
{
    //alert("monthlyyy");
    $('#month_name').text("เดือน " + month_name);
    $('#myChart').remove();
    $('#chartarea').append('<canvas id="myChart" style="height:40vh; width:70vw"></canvas>');
    var ctx = document.getElementById('myChart');
                                var myChart = new Chart(ctx, {
                                                                type: 'bar',
                                                                data: {
                                                                        labels: [
                                                                                    'S301-ขอซ่อมแซมอุปกรณ์ไฟฟ้า',
                                                                                    'S302-ขอตรวจสอบและบำรุงรักษาสวิตซ์เกียร์',
                                                                                    'S303-ขอตรวจสอบและบำรุงรักษาเคเบิล',
                                                                                    'S304-ขอตรวจสอบและบำรุงรักษารีเลย์',
                                                                                    'S305-ขอบำรุงรักษาหม้อแปลงไฟฟ้า'
                                                                                ],
                                                                        datasets: [
                                                                                    {
                                                                                        label: 'จำนวนลูกค้าที่ครบกำหนดบำรุงรักษาในเดือน  ' + month_name,
                                                                                        data: [
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1),
                                                                                                Math.floor((Math.random() * 10) + 1)
                                                                                              ],
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
                                                                            },
                                                                            legend: {
                                                                                display: false
                                                                            }
                                                                        }
                                                                });
}
