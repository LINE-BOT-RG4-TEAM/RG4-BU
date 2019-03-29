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
          window.location.href = "?action=cust_register&status=success";
        },
        error: function() {
          $("#uIdInput").val(profile.userId);
          $("#profileImage").attr("src", profile.pictureUrl);
          $("#uNameInput").text(profile.displayName);
        },
        complete: function() {}
      });
    })
    .catch(function(error) {
      window.alert("Error getting profile: " + error);
    });
}

$(function() {
  $("form").submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: "api/update_line_infomation.php",
      method: "POST",
      data: $(this).serializeArray(),
      beforeSend: function() {
        // window.alert("beforeSend alert");
      },
      success: function(response) {
        window.alert(JSON.stringify(response));
        Swal.fire({
          title: "สำเร็จ!",
          text: "ระบบบันทึกข้อมูลของท่านเรียบร้อยแล้ว ขอบคุณครับ",
          type: "success",
          confirmButtonText: "ปิดหน้าต่างนี้"
        }).then(function() {
          liff
            .sendMessages([
              {
                type: "text",
                text: "ลงทะเบียนสำเร็จ"
              }
            ])
            .then(function() {
              liff.closeWindow();
            });
        });
      },
      error: function() {
        Swal.fire({
          title: "Error!",
          text: "ระบบผิดพลาด กรุณาส่งข้อมูลอีกครั้ง",
          type: "error",
          confirmButtonText: "ปิดหน้าต่างนี้"
        });
      },
      complete: function() {
        // window.alert("endding form");
      }
    });
  });
});
