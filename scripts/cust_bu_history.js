function dateThaiFormatter(value, row) {
  var now = new Date(Date.parse(value));
  var thmonth = new Array ("มกราคม","กุมภาพันธ์","มีนาคม",
                "เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
                "ตุลาคม","พฤศจิกายน","ธันวาคม"); 

  var str_thai = now.getDate()+ " " 
                + thmonth[now.getMonth()]+ " " + (0+now.getFullYear()+543);

  return str_thai;
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

function initialLIFFData(data){
  // initial liff data
  initializeUserId(data);

  var userId = data.context.userId;
  var ca_callback = fetchCAFromUserId(userId);

  ca_callback.done(function(data){
    var obj = JSON.parse(data) || {};
    var ca = obj["CA"];

    var history_callback = fetchDataByCA(ca);
    history_callback.done(function(data){
      $.unblockUI();
      var array_data = JSON.parse(data) || [];
      if(array_data.length == 0){
        Swal.fire(
          'ไม่มีประวัติการทำธุรกิจเสริมกับ กฟภ.',
          'ท่านสามารถเลือกบริการเสริมที่สนใจ ได้จากหน้าหลักค่ะ',
          'info'
        );
      }
      $("table").bootstrapTable('load', array_data);
    });
    history_callback.fail(redirectWhenError);
  });
  ca_callback.fail(redirectWhenError);
}

function handleErrorLIFF(error){
  Swal.fire(
    'เกิดข้อผิดพลาด',
    'การตั้งค่าผู้ใช้จากไลน์เกิดข้อผิดพลาด',
    'error'
  ).then(redirectWhenError);
}

$(document).ready(function(){
  liff.init(initialLIFFData, handleErrorLIFF);
});

function redirectWhenError(response){
  Swal.fire(
    'เกิดข้อผิดพลาด',
    'มีข้อผิดพลาดในระบบ<br/>กำลังนำท่านไปยังหน้าหลัก',
    'error'
  ).then(function(){
    $.unblockUI();
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