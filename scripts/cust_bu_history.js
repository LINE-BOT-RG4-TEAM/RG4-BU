function dateThaiFormatter(value, row) {
  var now = new Date(Date.parse(value));
  var thmonth = new Array ("มกราคม","กุมภาพันธ์","มีนาคม",
                "เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
                "ตุลาคม","พฤศจิกายน","ธันวาคม"); 

  var str_thai = now.getDate()+ " " 
                + thmonth[now.getMonth()]+ " " + (0+now.getFullYear()+543);

  return str_thai;
}

$(document).ready(function(){

  var userId = document.getElementById("userId").value;
  var ca_callback = fetchCAFromUserId(userId);

  ca_callback.done(function(data){
    var obj = JSON.parse(data) || {};
    var ca = obj["CA"];

    var history_callback = fetchDataByCA(ca);
    history_callback.done(function(data){
      var array_data = JSON.parse(data) || [];
      if(array_data.length === 0){
        Swal.fire(
          'ไม่มีประวัติการทำธุรกิจเสริมกับ กฟภ.',
          '',
          'info'
        );
      }
      $("table").bootstrapTable('load', array_data);
    });
    history_callback.fail(redirectWhenError);
  });
  ca_callback.fail(redirectWhenError);
});

function redirectWhenError(response){
  Swal.fire(
    'เกิดข้อผิดพลาด',
    'มีข้อผิดพลาดในระบบ<br/>กำลังนำท่านไปยังหน้าหลัก',
    'error'
  ).then(function(){
    window.location.href = "?action=liff_service";
  });
}

function fetchCAFromUserId(userId){
  return $.ajax({
    url: './api/fetch_ca_by_userId.php?userId='+userId,
    method: 'POST',
    async: true,
    cache: false,
    processData: false,
    contentType: false			
  });
}

function fetchDataByCA(ca){
  return $.ajax({
    url: './api/datatable/fetch_history_bu.php?ca='+ca,
    method: 'POST',
    async: true,
    cache: false,
    processData: false,
    contentType: false			
  });
}