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
    liff
    .getProfile()
    .then(function(profile){
      var displayName = profile.displayName;
      var userId = profile.userId;
      var pictureURL = profile.pictureUrl;

      // show a data into a page
      $("#LINEDisplayName").text(displayName);
      $("#userIdHidden").val(userId);
      $("#profileImage").attr("src", pictureURL);

      // fetch user data 
      var userProfileAjax = fetchUserData(userId);
      userProfileAjax.done(function(data){
        var obj_data = JSON.parse(data) || {};
        var ca_txt = obj_data.CA;
        var fullName_txt = obj_data.FullName;
        var caTel_txt = obj_data.CA_TEL;
        var caEmail_txt = obj_data.CA_EMAIL;

        $("#ca_txt, #ca_hidden").val(ca_txt);
        $("#fullName_txt, #fullName_hidden").val(fullName_txt);
        $("#caTel_txt, #caTel_hidden").val(caTel_txt);
        $("#caEmail_txt, #caEmail_hidden").val(caEmail_txt);

        initializeUserId(data);

        $.unblockUI();
      });
      userProfileAjax.fail(redirectWhenError);
    })
    .catch(redirectWhenError);
}

function handleErrorLIFF(error){
  Swal.fire(
    'เกิดข้อผิดพลาด',
    'การตั้งค่าผู้ใช้จากไลน์เกิดข้อผิดพลาด',
    'error'
  ).then(redirectWhenError);
}

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

function fetchUserData(userId){
  return $.ajax({
    url: './api/fetch_ca_by_userId.php?userId='+userId,
    method: 'POST',
    async: true,
    cache: false,
    processData: false,
    contentType: false			
  });
}

$(function(){
    liff.init(initialLIFFData, handleErrorLIFF);
});

$("form").submit(function(event){
  event.preventDefault();

  var params_obj = {
    "CA": $("#ca_hidden").val(),
    "changed_data": []
  };

  // validate data form
  var change_flag = false;
  var fullName_txt = $("#fullName_txt").val() || '';
  var fullName_hidden = $("#fullName_hidden").val() || '';
  if(fullName_txt != fullName_hidden){
    params_obj["changed_data"].push({"FullName": fullName_txt});
    change_flag = true;
  }

  var caTel_txt = $("#caTel_txt").val() || '';
  var caTel_hidden = $("#caTel_hidden").val() || '';
  if(caTel_txt != caTel_hidden){
    params_obj["changed_data"].push({"CA_TEL": caTel_txt});
    change_flag = true;
  }

  var caEmail_txt = $("#caEmail_txt").val() || '';
  var caEmail_hidden = $("#caEmail_hidden").val() || '';
  if(caEmail_txt != caEmail_hidden){
    params_obj["changed_data"].push({"CA_EMAIL": caEmail_txt});
    change_flag = true;
  }

  // check flag is changed or not
  if(!change_flag){
    Swal.fire(
      '',
      'ไม่สามารถบันทึกได้<br/>เนื่องจากท่านไม่ได้แก้ไขข้อมูลใดๆ',
      'warning'
    );
    return;
  }


  $.ajax({
    url: './api/update_customer_profile.php',
    method: 'POST',
    data: params_obj,
    beforeSend: function(){

    },
    success: function(response){
      Swal.fire(
        '',
        'แก้ไขข้อมูลของท่านเรียบร้อยแล้วค่ะ',
        'success'
      ).then(function(){
        window.location.reload();
      });
    },
    error: function(error){
      alert('error '+JSON.stringify(error));
      window.location.reload();
    }	
  });
});