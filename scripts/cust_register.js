window.onload = function(e) {
  liff.init(function(data) {
    initializeApp(data);
  });
};

function initializeApp(data) {
  liff
    .getProfile()
    .then(function(profile) {
      // check registered status
      $.ajax({
        url: "api/check_registered_status.php",
        method: "GET",
        data: "userId=" + profile.userId,
        beforeSend: function() {},
        success: function(response) {
          var responseJSON = JSON.parse(response) || {};
          if (!("status" in responseJSON)) {
            window.alert("ระบบทำงานไม่ถูกต้อง, กรุณาลองใหม่อีกครั้ง");
            liff.closeWindow();
            return;
          }

          if (responseJSON.status == 200) {
            window.alert(
              "ท่านลงทะเบียนเรียบร้อยแล้ว, ระบบจะนำท่านสู่ PEA SmartBiz ค่ะ"
            );
            window.location.replace("customer.php?action=liff_service");
          } else {
            $("#uIdInput").val(profile.userId);
            $("#profileImage").attr("src", profile.pictureUrl);
            $("#uNameInput").text(profile.displayName);
          }
        },
        error: function() {
          window.alert("Error ajax fetch data");
        }
      });
    })
    .catch(function(error) {
      window.alert("Error getting profile: " + error);
    });
}

function updateLINEInformationAjax(form_data){
  return $.ajax({
    url: "api/update_line_information.php",
    method: "POST",
    data: form_data
  });
}

$(function() {
  $("form").submit(function(event) {
    event.preventDefault();
    // check existing
    var form_data = $(this).serializeArray();
    $.ajax({
      url: "api/check_before_update_line_information.php",
      method: "POST",
      data: form_data,
      beforeSend: function(){
        $.blockUI({
          message: "<h4 class=\"p-1 font-weight-bold text-center\">กำลังตรวจสอบข้อมูล</h4>"
        });
      },
      success: function(response){
        // can update data
        // var callback = updateLINEInformationAjax();
        alert('ไม่พบปัญหา');
      },
      error: function(error){
        var status = error.status;
        var responseText = error.responseText;
        if(status == "404"){
          Swal.fire({
            title: "Error!",
            text: responseText,
            type: "error",
            confirmButtonText: "ปิดหน้าต่างนี้"
          });
        } else if(status == "409"){
          Swal.fire({
            title: "มีผู้ลงทะเบียนใช้งานแล้ว",
            text: responseText,
            type: "question",
            showCancelButton: true,
            confirmButtonText: "แทนที่ผู้ใช้ทันที",
            cancelButtonText: 'ยกเลิก'
          }).then(function(result){
            if (result.value) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            } else {
              alert('กดยกเลิก');
            }
          });
        }
      },
      complete: function(){
        $.unblockUI();
      }
    });
    // $.ajax({
    //   url: "api/update_line_infomation.php",
    //   method: "POST",
    //   data: $(this).serializeArray(),
    //   beforeSend: function() {
    //     // window.alert("beforeSend alert");
    //     $.blockUI({
    //       message: "<h4 class=\"p-1 font-weight-bold text-center\">กำลังตรวจสอบข้อมูล</h4>"
    //     });
    //   },
    //   success: function(response) {
    //     Swal.fire({
    //       title: "สำเร็จ!",
    //       text: "ระบบบันทึกข้อมูลของท่านเรียบร้อยแล้ว ขอบคุณครับ",
    //       type: "success",
    //       confirmButtonText: "ปิดหน้าต่างนี้"
    //     }).then(function() {
    //       liff
    //         .sendMessages([
    //           {
    //             type: "text",
    //             text: "ลงทะเบียนสำเร็จ"
    //           }
    //         ])
    //         .then(function() {
    //           liff.closeWindow();
    //         });
    //     });
    //   },
    //   error: function(error) {
    //     Swal.fire({
    //       title: "Error!",
    //       text: "ไม่พบหมายเลขผู้ใช้ไฟฟ้า(CA) ที่ท่านกรอก, กรุณาตรวจสอบหมายเลขดังกล่าวอีกครั้งค่ะ",
    //       type: "error",
    //       confirmButtonText: "ปิดหน้าต่างนี้"
    //     });
    //   },
    //   complete: function() {
    //     // window.alert("endding form");
    //     $.unblockUI();
    //   }
    // });
  });
});
