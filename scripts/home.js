// utils var and function
var service_type = {
    'S301': 'ขอซ่อมแซมอุปกรณ์ไฟฟ้า',
    'S302': 'ขอตรวจสอบและบำรุงรักษาสวิตซ์เกียร์',
    'S303': 'ขอตรวจสอบและบำรุงรักษาเคเบิล',
    'S304': 'ขอตรวจสอบและบำรุงรักษารีเลย์',
    'S305': 'ขอบำรุงรักษาหม้อแปลงไฟฟ้า',
};
var month_map_thai = {
    "January": "มกราคม",
    "February": "กุมภาพันธ์",
    "March": "มีนาคม",
    "April": "เมษายน",
    "May": "พฤษภาคม",
    "June": "มิถุนายน",
    "July": "กรกฎาคม",
    "August": "สิงหาคม",
    "September": "กันยายน",
    "October": "ตุลาคม",
    "November": "พฤศจิกายน",
    "December": "ธันวาคม"
};
var month_thai = {
    '01': 'มกราคม',
    '02': 'กุมภาพันธ์',
    '03': 'มีนาคม',
    '04': 'เมษายน',
    '05': 'พฤษภาคม',
    '06': 'มิถุนายน',
    '07': 'กรกฎาคม',
    '08': 'สิงหาคม',
    '09': 'กันยายน',
    '10': 'ตุลาคม',
    '11': 'พฤศจิกายน',
    '12': 'ธันวาคม',
};
var quarter_thai = {
    '1': 'ไตรมาส 1',
    '2': 'ไตรมาส 2',
    '3': 'ไตรมาส 3',
    '4': 'ไตรมาส 4'
}

function getThaiMonthAndYear(year_month_array){
    var year_month_name_array = [];
    for(i=0;i<year_month_array.length;i++){
        var split_data = year_month_array[i].split("-");
        var buddist_year = parseInt(split_data[0]) + 543;
        var month_thai_name = month_thai[split_data[1]];
        console.log(split_data, split_data[0], split_data[1]);
        year_month_name_array.push(month_thai_name + " พ.ศ. " + buddist_year);
    }
    return year_month_name_array;
}

function getLabelListByQuarter(year_list, quarter_list){
    var label_length = year_list.length;
    var label_list = [];
    for(i=0;i<label_length;i++){
        label_list.push(quarter_thai[quarter_list[i]] + " ปี " + (parseInt(year_list[i]) + 543));
    }
    return label_list;
}

$.blockUI({
    message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"></div>',
    overlayCSS : { 
        backgroundColor: '#ffffff',
        opacity: 1
    },
    css : {
        opacity: 1,
        border: 'none',
    }
});

function home_data() {
    $.ajax({
        url: './api/home_data.php',
        method: 'POST',
        async: true,
        cache: false,
        processData: false,
        contentType: false,
        success: function(response) {
            var obj = JSON.parse(response) || {};
            $("#high_value_card").html(obj.high_value + ' ราย');
            $("#bu_card").html(obj.bu + ' ราย');
            $("#not_bu_card").html(obj.not_bu + ' ราย');
            console.log(obj);
            $(".quantity_jobs_area").unblock();
        }				
    }); 
}
home_data();

window.onload = function () {
    $("#chartarea, .quantity_jobs_area").block({
        message: "<h4 class='font-weight-bold'>กำลังดึงข้อมูล</h4>",
        overlayCSS : { 
            backgroundColor: '#ffffff',
            opacity: 0.8
        }
    });
    graph_month();
    $.unblockUI();
}

function fetchMonthlyQuantityJobs(){
    return $.ajax({
        url: "./api/fetch_quantity_jobs_by_year.php",
        method: "POST",
        data: {
            year: new Date().getFullYear()
        },
        dataType: "JSON"
    });
}

function fetchQuarterlyQuantityJobs(){
    return $.ajax({
        url: "./api/fetch_quantity_jobs_by_quater.php",
        method: "POST",
        data: {
            year: new Date().getFullYear()
        },
        dataType: "JSON"
    });
}

function graph_quater(){
    var ajaxCallback = fetchQuarterlyQuantityJobs();
    ajaxCallback.fail(function(error){
        console.log(error);
        return;
    });

    ajaxCallback.done(function(response){
        console.log('response', response);
        var quantity_jobs = _.map(response, "quantity_jobs");
        var year = _.map(response, "year");
        var quarter = _.map(response, "quarter");
        var label_list = getLabelListByQuarter(year, quarter);
        $('#month_name').text("รายไตรมาส");
        $('#myChart').remove();
        $('#chartarea').append('<canvas id="myChart" style="height:40vh; width:70vw"></canvas>');
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: label_list,
                datasets: [
                    {
                        label: 'จำนวนลูกค้าที่ครบกำหนดบำรุงรักษาในแต่ละไตรมาส',
                        data: quantity_jobs,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(242, 133, 97, 0.7)',
                            'rgba(242, 206, 97, 0.7)',
                            'rgba(83, 166, 166, 0.7)',
                            'rgba(71, 107, 179, 0.7)',
                            'rgba(116, 91, 170, 0.7)',
                            'rgba(79, 93, 117, 0.7)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(242, 133, 97, 0.7)',
                            'rgba(242, 206, 97, 0.7)',
                            'rgba(83, 166, 166, 0.7)',
                            'rgba(71, 107, 179, 0.7)',
                            'rgba(116, 91, 170, 0.7)',
                            'rgba(79, 93, 117, 0.7)',
                        ],
                        borderWidth: 1
                    }
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
    });
}

function graph_month() {
    var ajaxCallback = fetchMonthlyQuantityJobs();
    ajaxCallback.fail(function(error){
        console.log(error);
        $("#chartarea").html("<h4 class='p-3 text-center text-primary font-weight-bold'>ไม่มีข้อมูลลูกค้าที่ครบกำหนดบำรุงรักษา<br/>เนื่องจากฐานข้อมูลไม่มีข้อมูลลูกค้าที่เคยทำธุรกิจเสริม</h4>");
        $(".sub-criteria").html('');
        $("#chartarea").unblock();
        return;
    });

    ajaxCallback.done(function(response){
        var quantity_jobs = _.map(response, "quantity_jobs");
        var year_month_array = getThaiMonthAndYear(_.map(response, "year-month"));
        $('#month_name').text("รายเดือน");
        $('#myChart').remove();
        $('#chartarea').append('<canvas id="myChart" style="height:40vh; width:70vw"></canvas>');
        var ctx = document.getElementById('myChart');
        $("#chartarea").unblock();
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: year_month_array,
                datasets: [{
                    label: 'จำนวนลูกค้าที่ครบกำหนดบำรุงรักษาในแต่ละเดือน',
                    data: quantity_jobs,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(242, 133, 97, 0.7)',
                        'rgba(242, 206, 97, 0.7)',
                        'rgba(83, 166, 166, 0.7)',
                        'rgba(71, 107, 179, 0.7)',
                        'rgba(116, 91, 170, 0.7)',
                        'rgba(79, 93, 117, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(242, 133, 97, 0.7)',
                        'rgba(242, 206, 97, 0.7)',
                        'rgba(83, 166, 166, 0.7)',
                        'rgba(71, 107, 179, 0.7)',
                        'rgba(116, 91, 170, 0.7)',
                        'rgba(79, 93, 117, 0.7)',
                    ],
                    borderWidth: 1
                }]
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
            datasets: [{
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
            }]
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
            'onClick': function(event, item){
                console.log(item);
            }
        }
    });
}

function summaryS301Formatter(data){
    var rows_map_obj = $.map(data, function(row, index){
        return parseInt(row['S301']);
    });
    return "<div class='font-weight-bold text-right'>"+rows_map_obj.reduce(function(initialVal, value){
        return initialVal + value;
    }, 0) + " งาน</div>";
}

function summaryS302Formatter(data){
    var rows_map_obj = $.map(data, function(row, index){
        return parseInt(row['S302']);
    });
    return "<div class='font-weight-bold text-right'>"+rows_map_obj.reduce(function(initialVal, value){
        return initialVal + value;
    }, 0) + " งาน</div>";
}

function summaryS303Formatter(data){
    var rows_map_obj = $.map(data, function(row, index){
        return parseInt(row['S303']);
    });
    return "<div class='font-weight-bold text-right'>"+rows_map_obj.reduce(function(initialVal, value){
        return initialVal + value;
    }, 0) + " งาน</div>";
}

function summaryS304Formatter(data){
    var rows_map_obj = $.map(data, function(row, index){
        return parseInt(row['S304']);
    });
    return "<div class='font-weight-bold text-right'>"+rows_map_obj.reduce(function(initialVal, value){
        return initialVal + value;
    }, 0) + " งาน</div>";
}

function summaryS305Formatter(data){
    var rows_map_obj = $.map(data, function(row, index){
        return parseInt(row['S305']);
    });
    
    return "<div class='font-weight-bold text-right'>"+rows_map_obj.reduce(function(initialVal, value){
        return initialVal + value;
    }, 0) + " งาน</div>";
}

function monthlyFormatter(value, row, index){
    var summaryByMonthly = 0;
    summaryByMonthly = parseInt(row['S301']) + parseInt(row['S302']) + parseInt(row['S303']) + parseInt(row['S304']) + parseInt(row['S305']);
    return "<div class='font-weight-bold text-right'>"+summaryByMonthly+" งาน</div>";
}

function grandSummaryFormatter(data){
    var rows_map_obj = data.map(function(row){
        return parseInt(row['S301']) + parseInt(row['S302']) + parseInt(row['S303']) + parseInt(row['S304']) + parseInt(row['S305']);
    });
    return rows_map_obj.reduce(function(initialVal, value){
        return initialVal + value;
    }, 0) + " งาน";
}

function quantityJobsS301Formatter(value, row, index) {
    if(parseInt(value) > 0){
        return [
            '<u class="font-weight-bold" data-toggle="modal" data-target="#jobsModalLgCenter" data-code="S301" data-row="'+encodeURIComponent(JSON.stringify(row))+'" data-quantity="'+value+'">',
            value+" งาน",
            "</u>"
        ].join("");
    } else {
        return value;
    }
}
function quantityJobsS302Formatter(value, row, index) {
    if(parseInt(value) > 0){
        return [
            '<u class="font-weight-bold" data-toggle="modal" data-target="#jobsModalLgCenter" data-code="S302" data-row="'+encodeURIComponent(JSON.stringify(row))+'" data-quantity="'+value+'">',
            value+" งาน",
            "</u>"
        ].join("");
    } else {
        return value;
    }
}

function quantityJobsS303Formatter(value, row, index) {
    if(parseInt(value) > 0){
        return [
            '<u class="font-weight-bold" data-toggle="modal" data-target="#jobsModalLgCenter" data-code="S303" data-row="'+encodeURIComponent(JSON.stringify(row))+'" data-quantity="'+value+'">',
            value+" งาน",
            "</u>"
        ].join("");
    } else {
        return value;
    }
}

function quantityJobsS304Formatter(value, row, index) {
    if(parseInt(value) > 0){
        return [
            '<u class="font-weight-bold" data-toggle="modal" data-target="#jobsModalLgCenter" data-code="S304" data-row="'+encodeURIComponent(JSON.stringify(row))+'" data-quantity="'+value+'">',
            value+" งาน",
            "</u>"
        ].join("");
    } else {
        return value;
    }
}
function quantityJobsS305Formatter(value, row, index) {
    if(parseInt(value) > 0){
        return [
            '<u class="font-weight-bold" data-toggle="modal" data-target="#jobsModalLgCenter" data-code="S305" data-row="'+encodeURIComponent(JSON.stringify(row))+'" data-quantity="'+value+'">',
            value+" งาน",
            "</u>"
        ].join("");
    } else {
        return value;
    }
}

function monthThaiFormatter(value, row){
    return month_map_thai[value];
}

function buddistYearFormatter(value, row) {
    return parseInt(value) + 543;
}

function caFormatter(value) {
    return [
        '<a class="btn btn-dark" target="_blank" href="index.php?action=customer_detail&ca='+value+'">',
        value,
        '</a>'
    ].join("");
}

function dateThaiFormatter(value, row) {
    var now = new Date(Date.parse(value));
  
    var thmonth = new Array ("มกราคม","กุมภาพันธ์","มีนาคม",
              "เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
              "ตุลาคม","พฤศจิกายน","ธันวาคม"); 
  
    var str_thai = now.getDate()+ " " 
            + thmonth[now.getMonth()]+ " " + (0+now.getFullYear()+543);
  
    // console.log(str_thai);
    return str_thai;
  }

$(function(){
    $("#jobsModalLgCenter").on('hide.bs.modal', function(event) {
        $("#modal_table").bootstrapTable('destroy');
    });
    $('#jobsModalLgCenter').on('show.bs.modal', function (event) {
        $(".modal-body").block();
        var button = $(event.relatedTarget); // Button that triggered the modal
        var row = button.data('row'); // Extract info from data-* attributes
        var quantity = button.data('quantity'); // Extract info from data-* attributes
        var code = button.data('code'); // Extract info from data-* attributes
        var data_row = JSON.parse(decodeURIComponent(row));
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('ผู้ที่ใช้ไฟฟ้าที่ครบกำหนดบำรุงรักษารหัส ' + code + ' - ' + service_type[code]);
        // modal.find('.modal-body').html("ค้นพบ "+quantity+" รายการ");
        var html_array = [];
        html_array.push("<div class='font-weight-bold text-primary'>ค้นพบ "+quantity+" รายการ</div>");
        $.ajax({
            url: "./api/fetch_list_of_history.php",
            method: "POST",
            data: {
                data_row: JSON.stringify(data_row),
                code: code
            },
            success: function(response){
                // console.log(JSON.parse(response));
                var data = JSON.parse(response);
                $("#modal_table").bootstrapTable({data: data});
            },
            error: function(error){
                console.log(error);
            },
            complete: function(){
                // console.log('complete');
                $(".modal-body").unblock();
            }
        });
    })
});