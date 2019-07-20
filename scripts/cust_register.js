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

function getLINEInformationAjax(form_data){
  return $.ajax({
    url: "api/update_line_information.php",
    method: "POST",
    data: form_data
  });
}

function successUpdateLINEInfoCallback(){
  // can update data
  $.blockUI({
    message: "<h4 class=\"p-1 font-weight-bold text-center\">กำลังบันทึกข้อมูล...</h4>"
  });
  var updateLINEInfoCallback = getLINEInformationAjax();
  updateLINEInfoCallback.done(function(){
    Swal.fire({
      title: "สำเร็จ!",
      text: "ระบบบันทึกข้อมูลของท่านเรียบร้อยแล้ว ขอบคุณค่ะ",
      type: "success",
      confirmButtonText: "ปิดหน้าต่างนี้"
    }).then(function() {
      liff
        .sendMessages([
          {
            type: "sticker",
            packageId: "11537",
            stickerId: "52002734"
          },
          {
            type: "text",
            text: "ยินดีด้วยค่ะ ท่านลงทะเบียนการใช้งาน PEA SmartBiz เรียบร้อยแล้ว"
          },
          {
            type: "text",
            text: "ท่านสามารถเลือกบริการเสริมจาก กฟภ. จากแท็บ `เมนู` ด้านล่างได้เลยค่ะ :)"
          }
        ])
        .then(function() {
          liff.closeWindow();
        });
    });
  });
  updateLINEInfoCallback.fail(function(){
    Swal.fire({
      title: "เกิดข้อผิดพลาด!",
      text: "ไม่สามารถบันทึกข้อมูลได้, กรุณาลองใหม่อีกครั้ง",
      type: "error",
      confirmButtonText: "ปิดหน้าต่างนี้"
    });
  });
  updateLINEInfoCallback.always(function(){
    $.unblockUI();
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
      success: function(){
        // can update data
        $.blockUI({
          message: "<h4 class=\"p-1 font-weight-bold text-center\">กำลังบันทึกข้อมูล...</h4>"
        });
        var updateLINEInfoCallback = getLINEInformationAjax(form_data);
        updateLINEInfoCallback.done(function(){
          Swal.fire({
            title: "สำเร็จ!",
            text: "ระบบบันทึกข้อมูลของท่านเรียบร้อยแล้ว ขอบคุณค่ะ",
            type: "success",
            confirmButtonText: "ปิดหน้าต่างนี้"
          }).then(function() {
            liff
              .sendMessages([
                {
                  type: "sticker",
                  packageId: "11537",
                  stickerId: "52002734"
                },
                {
                  type: "text",
                  text: "ยินดีด้วยค่ะ ท่านลงทะเบียนการใช้งาน PEA SmartBiz เรียบร้อยแล้ว"
                },
                {
                  type: "text",
                  text: "ท่านสามารถเลือกบริการเสริมของ กฟภ. จากรูปตระกร้าด้านล่างได้เลยค่ะ"
                }
              ])
              .then(function() {
                liff.closeWindow();
              });
          });
        });
        updateLINEInfoCallback.fail(function(){
          Swal.fire({
            title: "เกิดข้อผิดพลาด!",
            text: "ไม่สามารถบันทึกข้อมูลได้, กรุณาลองใหม่อีกครั้ง",
            type: "error",
            confirmButtonText: "ปิดหน้าต่างนี้"
          });
        });
        updateLINEInfoCallback.always(function(){
          $.unblockUI();
        });
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
              // can update data
              $.blockUI({
                message: "<h4 class=\"p-1 font-weight-bold text-center\">กำลังบันทึกข้อมูล...</h4>"
              });
              var updateLINEInfoCallback = getLINEInformationAjax(form_data);
              updateLINEInfoCallback.done(function(){
                Swal.fire({
                  title: "สำเร็จ!",
                  text: "ระบบบันทึกข้อมูลของท่านเรียบร้อยแล้ว ขอบคุณค่ะ",
                  type: "success",
                  confirmButtonText: "ปิดหน้าต่างนี้"
                }).then(function() {
                  liff
                    .sendMessages([
                      {
                        type: "sticker",
                        packageId: "11537",
                        stickerId: "52002734"
                      },
                      {
                        type: "text",
                        text: "ยินดีด้วยค่ะ ท่านลงทะเบียนการใช้งาน PEA SmartBiz เรียบร้อยแล้ว"
                      },
                      {
                        type: "text",
                        text: "ท่านสามารถเลือกบริการเสริมของ กฟภ. จากรูปตระกร้าด้านล่างได้เลยค่ะ"
                      }
                    ])
                    .then(function() {
                      liff.closeWindow();
                    });
                });
              });
              updateLINEInfoCallback.fail(function(){
                Swal.fire({
                  title: "เกิดข้อผิดพลาด!",
                  text: "ไม่สามารถบันทึกข้อมูลได้, กรุณาลองใหม่อีกครั้ง",
                  type: "error",
                  confirmButtonText: "ปิดหน้าต่างนี้"
                });
              });
              updateLINEInfoCallback.always(function(){
                $.unblockUI();
              });
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
