function reportFormatter(value, row, index){
  var reportFieldArray = [];
  var report_document_url = value || '';
  reportFieldArray.push("<div class='text-center'>");
  if(report_document_url.length > 0){
    // reportFieldArray.push("<div class='btn-group-vertical'>");
    reportFieldArray.push("<a class='btn btn-sm btn-success' href='"+report_document_url+"' target='_blank'>ดูรายงาน</a><br/>");
    reportFieldArray.push("<a class='btn btn-sm btn-danger' onclick='removeReport(\""+row['purchase_id']+"\", \""+row['purchase_lineitem_id']+"\")' href='javascript:void(0);'>ลบรายงาน</a><br/>");
    // reportFieldArray.push("</div>");
  }
  reportFieldArray.push([
    '<div class="image-upload">',
    '   <label for="file-input_'+row['purchase_lineitem_id']+'">',
    '     <i class="fas fa-upload">upload</i>',
    '   </label>',
    '   <input id="file-input_'+row['purchase_lineitem_id']+'" type="file" onchange="uploadReport(\''+row['purchase_id']+'\', \''+row['purchase_lineitem_id']+'\', this);" accept="application/pdf" data-purchase-lineitem-id="'+row['purchase_lineitem_id']+'" />',
    '</div>',
    '</div>',
    '<style>.image-upload>input { display:none; }</style>'
  ].join(""));

  return reportFieldArray.join("");
}

function contactTimeFormatter(value, row, index) {
  return [
    "<textarea class='form-control' id='contact_time_"+row["purchase_lineitem_id"]+"'>",
    value,
    "</textarea>",
    "<a href='javascript:void(0);' onclick='javascript:updateContactTime("+row["purchase_lineitem_id"]+", \""+value+"\");' class='btn btn-block btn-success btn-sm'>บันทึกข้อมูล</a>"
  ].join("");
}

function updateContactTime(purchase_lineitem_id, previous_value){
  var contact_time_value = $.trim($("#contact_time_"+purchase_lineitem_id).val()) || '';
  previous_value = previous_value == "null" ? "" : previous_value;
  if(contact_time_value.length == 0 && previous_value.length == 0){
    Swal.fire(
      'ไม่สามารถบันทึกวัน/เวลาติดต่อผู้ใช้ไฟ',
      'เนื่องจากท่านไม่ได้กรอกข้อมูลใดๆ จึงไม่สามารถบันทึกข้อมูล',
      'warning'
    );
    return;
  }

  $.ajax({
    url: "./api/update_contact_time.php",
    method: "POST",
    data: {
      purchase_lineitem_id: purchase_lineitem_id,
      contact_time: contact_time_value
    },
    beforeSend: function(){
      $.blockUI();
    },
    success: function(response){
      Swal.fire(
        "บันทึกสำเร็จ",
        '',
        "success"
      );
    },
    error: function(error){
      Swal.fire(
        'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
        'กรุณาลองบันทึกใหม่อีกครั้ง',
        'error'
      );
    },
    complete: function(){
      $.unblockUI();
      $("table").bootstrapTable("refresh");
    }
  });
}

function quotationNoticeFormatter(value, row, index){
  return [
    "<textarea class='form-control' id='quotation_notice_"+row["purchase_lineitem_id"]+"'>",
    value,
    "</textarea>",
    "<a href='javascript:void(0);' onclick='javascript:updateQuotationNotice("+row["purchase_lineitem_id"]+", \""+value+"\");' class='btn btn-block btn-success btn-sm'>บันทึกข้อมูล</a>"
  ].join("");  
}

function updateQuotationNotice(purchase_lineitem_id, previous_value){
  var quotation_notice_value = $.trim($("#quotation_notice_"+purchase_lineitem_id).val()) || '';
  previous_value = previous_value == "null" ? "" : previous_value;
  if(quotation_notice_value.length == 0 && previous_value.length == 0){
    Swal.fire(
      'ไม่สามารถบันทึกเลขที่ มท. หรือเลขที่ใบเสนอราคา',
      'เนื่องจากท่านไม่ได้กรอกข้อมูลใดๆ จึงไม่สามารถบันทึกข้อมูล',
      'warning'
    );
    return;
  }

  $.ajax({
    url: "./api/update_quotation_notice.php",
    method: "POST",
    data: {
      purchase_lineitem_id: purchase_lineitem_id,
      quotation_notice: quotation_notice_value
    },
    beforeSend: function(){
      $.blockUI();
    },
    success: function(response){
      Swal.fire(
        "บันทึกสำเร็จ",
        '',
        "success"
      );
    },
    error: function(error){
      Swal.fire(
        'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
        'กรุณาลองบันทึกใหม่อีกครั้ง',
        'error'
      );
    },
    complete: function(){
      $.unblockUI();
      $("table").bootstrapTable("refresh");
    }
  });
}

function removeReport(purchase_id, purchase_lineitem_id){
  console.log(purchase_lineitem_id);
  $.ajax({
    url: "./api/remove_report_document.php",
    method: "POST",
    data: {
      purchase_lineitem_id: purchase_lineitem_id
    },
    beforeSend: function(){
      $.blockUI();
    },
    success: function(response){
      console.log('success', response);
      Swal.fire(
        "ลบรายงานเรียบร้อยแล้ว",
        "",
        "success"
      );
    },
    error: function(error){
      console.log('error', error);
    },
    complete: function(){
      console.log('complete');
      $("table").bootstrapTable("refresh");
      $.unblockUI();
    }
  });
  firebase.storage().ref()
  .child(purchase_id+'/'+purchase_lineitem_id+'/report.pdf')
  .delete().then(function(){
    console.log("Delete report successfully");
  }).catch(function(){
    console.log("Can't delete report...");
  });
}

function uploadReport(purchase_id, purchase_lineitem_id, e){
  // console.log('uploadReport->', purchase_id, purchase_lineitem_id);
  var file = e.files[0];
  var uploadReportStorage = firebase.storage().ref().child(purchase_id+'/'+purchase_lineitem_id+"/report.pdf");
  var uploadReportTask = uploadReportStorage.put(file);
  $.blockUI();
  uploadReportTask.on("state_changed", 
    function progress(snapshot){
      var percentage = (snapshot.bytesTransferred/snapshot.totalBytes)*100;
      console.log('percentage now ', percentage);
    },
    function error(error){
      console.log('error');
      $.unblockUI();
    },
    function complete(){
      var fullPath = uploadReportTask.snapshot.ref.fullPath;
      uploadReportTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
        $.ajax({
          url: "./api/update_report_document.php",
          method: "POST",
          data: {
            purchase_lineitem_id: purchase_lineitem_id,
            report_document_firebase_ref: fullPath,
            report_document_url: downloadURL
          },
          beforeSend: function(){
            console.log('before_send');
          },
          success: function(response){
            console.log('response', response);
          },
          error: function(error){
            console.log('error', error);
          },
          complete: function(){
            console.log('complete');
          }
        });
        Swal.fire(
          "อัปโหลดรายงานเรียบร้อยแล้ว",
          "",
          "success"
        ).then(function(){
          $.unblockUI();
          $("table").bootstrapTable("refresh");
        })
      });
    }
  );
}

function lineitem_format(value, row, index) {
  return [
    '<div class="text-center">',
    '<div class="btn-group-vertical" role="group" aria-label="Basic example">',
    ' <a class="btn btn-block btn-outline-primary po-detail" href="javascript:void(0);" title="Like" data-toggle="modal" onclick="set_cate_id_modal('+"'" + value + "'" +')" data-target="#PoModal">',
    '   <i class="fas fa-pen"></i> แก้ไข/ลบบริการ',
    " </a>",
    ' <a class="btn btn-block btn-outline-success" href="javascript:void(0);" title="Upload" data-toggle="modal" onclick="popupUploadWindow(\''+row['purchase_id']+'\', \''+row['purchase_lineitem_id']+'\');">',
    '   <i class="far fa-images"></i> อัพโหลดรูปภาพ',
    " </a>",
    '</div>',
    '</div>'
  ].join("");
}

function popupUploadWindow(purchase_id, purchase_lineitem_id) {
  var new_window = window.open('upload_activity_photo.php?purchase_id='+purchase_id+'&purchase_lineitem_id='+purchase_lineitem_id, "อัพโหลดรูปภาพก่อนหรือหลังดำเนินการ", "height=600,width=1000");
  if (window.focus) {
    new_window.focus();
  }
  return false;
}

function noticeFormatter(notice, row, index){
  return [
    "<textarea class='form-control' id='notice_id_"+row["purchase_lineitem_id"]+"'>",
    notice,
    "</textarea>",
    "<a href='javascript:void(0);' onclick='javascript:updateNotice("+row["purchase_lineitem_id"]+", \""+notice+"\");' class='btn btn-block btn-success btn-sm'>บันทึกข้อมูล</a>"
  ].join("");
}

function updateNotice(purchase_lineitem_id, previous_value){
  var notice_value = $.trim($("#notice_id_"+purchase_lineitem_id).val()) || '';
  previous_value = previous_value == "null" ? "" : previous_value;
  if(notice_value.length == 0 && previous_value.length == 0){
    Swal.fire(
      'ไม่สามารถบันทึกหมายเหตุ',
      'เนื่องจากท่านไม่ได้กรอกข้อมูลใดๆ จึงไม่สามารถบันทึกข้อมูล',
      'warning'
    );
    return;
  }

  $.ajax({
    url: "./api/update_notice_purchase_lineitem.php",
    method: "POST",
    data: {
      purchase_lineitem_id: purchase_lineitem_id,
      notice: notice_value
    },
    beforeSend: function(){
      $.blockUI();
    },
    success: function(response){
      Swal.fire(
        "บันทึกสำเร็จ",
        '',
        "success"
      );
    },
    error: function(error){
      Swal.fire(
        'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
        'กรุณาลองบันทึกใหม่อีกครั้ง',
        'error'
      );
    },
    complete: function(){
      $.unblockUI();
      $("table").bootstrapTable("refresh");
    }
  });
}

function textCenterFormatter(value, row, index) {
  return "<div class='text-center'>" + value + "</div>";
}

function suffixQuantityTextCenterFormatter(value, row) {
  return "<div class='font-weight-bold text-center'>" + value + " ครั้ง</div>";
}

function set_cate_id_modal(data)
{
  $('#modal_cate_id').html(data);
}

function product_detail()
{
  var purchase_id = getUrlVars()["purchase_id"];
  //$('#modal_cate_id').html(data);
  var cate_id = $('#modal_cate_id').text();
  $('#modal_purchase_id').html(purchase_id);
  var formData = new FormData();
  formData.append('purchase_id',purchase_id);
  formData.append('cate_id',cate_id);
  formData.append('request','modal'); //กำหนดเงื่อนไขให้ api
  $.ajax({
    url: './api/product_detail_emp_api.php',
    method: 'POST',
    data: formData,
    async: true,
    cache: false,
    processData: false,
    contentType: false,
    beforeSend : function()
            {
                //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
                console.log("beforesend.....");
                $('div.modal-dialog').block({
                  message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                  overlayCSS : { 
                    backgroundColor: '#ffffff',
                    opacity: 0.8
                  },
                  css : {
                    opacity: 1,
                    border: 'none',
                  }
                });
                //$('.blockUI.blockMsg').center();
            },
    success: function(response) 
              {
                //console.log(response);
                var obj = JSON.parse(response) || {};
                console.log(obj);
                $('#cate_name').val(obj[0].cate_name);
                $('#des').val(obj[0].des);
                $('#app_date').val(obj[0].appointment_date);
                $('#des').prop( "disabled", true );
                $('#app_date').prop( "disabled", true );
               
              },
    complete :function(){
              $('div.modal-dialog').unblock();
                }					
    });

}

// Your web app's Firebase configuration
var firebaseConfig = {
  apiKey: "<?=getenv('FIREBASE_API_KEY')?>",
  authDomain: "<?=getenv('FIREBASE_AUTH_DOMAIN')?>",
  databaseURL: "<?=getenv('FIREBASE_DATABASE_URL')?>",
  projectId: "<?=getenv('FIREBASE_PROJECT_ID')?>",
  storageBucket: "<?=getenv('FIREBASE_STORAGE_BUCKET')?>",
  messagingSenderId: "<?=getenv('FIREBASE_MESSAGING_SENDER_ID')?>",
  appId: "<?=getenv('FIREBASE_APP_ID')?>"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

$( document).ready(function() {
  var purchase_id = getUrlVars()["purchase_id"];
  $("#hidden_purchase_id").val(purchase_id);
  $('#purchase_id').html(purchase_id);
  // $('#btn-confirm').hide();
  fetch_purchase_emp();
});

function fetch_purchase_emp()
{
    var purchase_id = getUrlVars()["purchase_id"];
    var formData = new FormData();
    formData.append('purchase_id',purchase_id);
      $.ajax({
      url: './api/fetch_purchase_emp_api.php',
      method: 'POST',
      data: formData,
      async: true,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend : function() {
        console.log("beforesend.....");
        $.blockUI({
          message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
          overlayCSS : { 
            backgroundColor: '#ffffff',
            opacity: 1
          },
          css : {
            opacity: 1,
            border: 'none',
          }
      });
    },
    success: function(response) {
      var obj = JSON.parse(response) || {};
      // console.log(obj);
      $('#bp').val(obj[0].BP);
      $('#ca').val(obj[0].CA);
      $('#business_type').val(obj[0].BUSINESS_TYPE);
      $('#customer_name').val(obj[0].CUSTOMER_NAME);
      $('#address').val(obj[0].ADDRESS);
      $('#tel').val(obj[0].CA_TEL);
      $('#hml_type').val(obj[0].HML_Type);
      $('#KAM_TYPE').val(obj[0].KAM_TYPE);
      $('#kamr').val(obj[0].KAMR);
      $("#FullName").val(obj[0].FullName);
      $("#CA_EMAIL").val(obj[0].CA_EMAIL);

      var purchase_id = obj[0].PURCHASE_ID;
      var confident_document_path = obj[0].confident_document || '';
      if(confident_document_path.length > 0) {
        // view document config
        $("#view_document").attr("target", "_blank");
        $("#view_document")
          .removeClass("btn-outline-success disabled")
          .addClass("btn-success");
        $("#view_document").attr("href", obj[0].confident_document);

        // delete document config
        $("#delete_document")
          .removeClass("btn-outline-danger disabled")
          .addClass("btn-danger")
          .attr("onclick", "javascript:delete_document('"+purchase_id+"');");

        }
      // set send email btn config
      $("#send_confirm_email")
        .removeClass("btn-outline-dark disabled")
        .addClass("btn-dark")
        .attr("onclick", "javascript:sendEmail('"+purchase_id+"');");
    },
    complete :function(){
      $.unblockUI();
    }					
  });
}

function sendEmail(purchase_id){
  Swal.fire({
    title: '<strong>แน่ใจหรือไม่ ?</strong>',
    type: 'question',
    html:
      'ท่านต้องการส่งข้อมูลการสั่งซื้อเพื่อยืนยันการให้บริการ' +
      'แก่ผู้ใช้ไฟผ่าน email หรือไม่ ',
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<i class="far fa-paper-plane"></i> ส่งอีเมล์',
    confirmButtonAriaLabel: 'Thumbs up, great!',
    cancelButtonText:
      '<i class="fas fa-times"></i> ยกเลิก',
    cancelButtonAriaLabel: 'Thumbs down',
  }).then(function(response){
    if(!response.value){
      return;
    }

    $.ajax({
      method: 'GET',
      url: './api/send_email.php?purchase_id='+purchase_id,
      beforeSend: function(){
        $.blockUI({
          message: '<h3 class="p-2 text-dark">กำลังส่งอีเมล์, กรุณารอสักครู่ค่ะ</h3>'
        });
      },
      success: function(response){
        console.log('response', response);
        Swal.fire(
          'ส่งอีเมล์สำเร็จ!',
          '',
          'success'
        );
      },
      error: function(err){
        console.log('err', err);
        Swal.fire(
          'ส่งไม่สำเร็จ',
          '',
          'error'
        );
      }, 
      complete: function(){
        $.unblockUI();
      }
    });
  })
}

function delete_document(purchase_id){
  if(!confirm("ต้องการลบเอกสารใบเสร็จหรือไม่ ?")){
    return;
  }
  var documentRef = firebase.storage().ref().child(purchase_id+'/confident-document.pdf');

  // Delete the file
  documentRef.delete().then(function() {
    $.ajax({
      url: "./api/delete_document.php",
      method: "POST",
      data: {
        purchase_id: purchase_id
      },
      beforeSend: function(){
        $.blockUI();
      },
      success: function(response){
        Swal.fire(
          'ลบเอกสารเรียบร้อยแล้ว',
          '',
          'success'
        ).then(function(){
          window.location.reload();
        });
      },
      error: function(err){
        Swal.fire(
          'ลบเอกสารไม่สำเร็จ, กรุณาลองใหม่อีกครั้ง',
          '',
          'error'
        ).then(function(){
          window.location.reload();
        })
      }
    });
  }).catch(function(error) {
    Swal.fire(
      '',
      'ไม่สามารถลบไฟล์ได้ กรุณาลองใหม่อีกครั้ง',
      'error'
    ).then(function(){
      window.location.reload();
    });
  });
}

function edit()
{
  if($('#edit').val() == 'confirm')
  { 
    var purchase_id = getUrlVars()["purchase_id"];
    var formData = new FormData();
    formData.append('purchase_id',purchase_id);
    formData.append('cate_id',$('#modal_cate_id').text());
    formData.append('des',$('#des').val());
    formData.append('appointment_date',$('#app_date').val());
    formData.append('request','edit'); //กำหนดเงื่อนไขให้ api
    $.ajax({
            url: './api/product_detail_emp_api.php',
            method: 'POST',
            data: formData,
            async: true,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend : function()
            {
                //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
                console.log("beforesend.....");
                $('div.modal-dialog').block({
                  message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                  overlayCSS : { 
                    backgroundColor: '#ffffff',
                    opacity: 0.8
                  },
                  css : {
                    opacity: 1,
                    border: 'none',
                  }
                });
                //$('.blockUI.blockMsg').center();
            },
            success: function(response) 
              {
                console.log(response);
                Swal.fire({
                  title: 'สำเร็จ !',
                  html: 'แก้รายการเรียบร้อย...<br/> ',
                  type: 'success',
                  timer: 5000
              });
              window.location.reload();
              },
             complete :function(){
              $('div.modal-dialog').unblock();
                }					
          });
  }
  else if($('#edit').val() == 'edit')
  {
    $('#des').prop( "disabled", false );
    $('#app_date').prop( "disabled", false ); 
    $('#head_modal').append('(กำลังแก้ไข)');
    $('#edit').html('ยืนยันการแก้ไข')
    $('#edit').val('confirm')
  }
}

$("#PoModal").on('shown.bs.modal', function(){
  product_detail()
});

$("#select_service_modal").on('shown.bs.modal', function(){
  fetch_product();
});

function fetch_product()
{
    var purchase_id = getUrlVars()["purchase_id"];
    $('#select_service_modal_purchase_id').html(purchase_id);
    $('#select_service_product_name').html('<option>กรุณาเลือก</option>');
    $('#select_service_des').text('');
    $('#btn_add').hide();
    $('.detail').hide();
    $('#div_date').hide();
    $('#app_date_add2po').val('');
    var formData = new FormData();
    formData.append('request','product_cate'); //กำหนดเงื่อนไขให้ api
    $.ajax({
            url: './api/product_detail_emp_api.php',
            method: 'POST',
            data: formData,
            async: true,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend : function()
            {
                //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
                console.log("beforesend.....");
                $('div.modal-dialog').block({
                  message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                  overlayCSS : { 
                    backgroundColor: '#ffffff',
                    opacity: 0.8
                  },
                  css : {
                    opacity: 1,
                    border: 'none',
                  }
                });
                //$('.blockUI.blockMsg').center();
            },
            success: function(response) 
              {
                var obj = JSON.parse(response) || {};
                var i=0;
                var cate_select = '';
                while(obj[i])
                {
                  cate_select = cate_select + '<option value="'+obj[i].cate_id+'">'+ obj[i].cate_id + '--' + obj[i].cate_name +'</option>';
                  i++;
                }
                $('#select_service_cate_name').html('<option>กรุณาเลือก</option>' + cate_select);

              },
             complete :function(){
              $('div.modal-dialog').unblock();
                }					
          });;
}

function fetch_level2(cate_id)
  {
    console.log(cate_id);
    $('#select_service_product_name').html('<option>กรุณาเลือก</option>');
    $('#select_service_des').text('');
    $('#btn_add').hide();
    $('.detail').hide();
    $('#div_date').hide();
    $('#app_date_add2po').val('');
    var formData = new FormData();
    formData.append('cate_id',cate_id);
    formData.append('request','product_cate_level_2'); //กำหนดเงื่อนไขให้ api
    $.ajax({
            url: './api/product_detail_emp_api.php',
            method: 'POST',
            data: formData,
            async: true,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend : function()
            {
                //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
                console.log("beforesend.....");
                $('div.sub_cate').block({
                  message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                  overlayCSS : { 
                    backgroundColor: '#ffffff',
                    opacity: 0.8
                  },
                  css : {
                    opacity: 1,
                    border: 'none',
                  }
                });
                //$('.blockUI.blockMsg').center();
            },
            success: function(response) 
              {
                var obj = JSON.parse(response) || {};
                var i=0;
                var cate_select = '';
                while(obj[i])
                {
                  cate_select = cate_select + '<option value="'+obj[i].cate_id+'">'+ obj[i].cate_id + '--' + obj[i].cate_name +'('+obj[i].is_product+')</option>';
                  i++;
                }
                $('#select_sub_cate').html('<option>กรุณาเลือก</option>' + cate_select);

              },
             complete :function(){
              $('div.sub_cate').unblock();
                }					
          });
          $('#sub_cate_label').html('หมวดหมู่ย่อย');
          $('#select_sub_cate').show();
}

function fetch_level3(cate_id)
{
  console.log(cate_id);
  var formData = new FormData();
  formData.append('cate_id',cate_id);
  formData.append('request','product_cate_level_3'); //กำหนดเงื่อนไขให้ api
  $.ajax({
          url: './api/product_detail_emp_api.php',
          method: 'POST',
          data: formData,
          async: true,
          cache: false,
          processData: false,
          contentType: false,
          beforeSend : function()
          {
              //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
              console.log("beforesend.....");
              $('div.sub_cate').block({
                message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                overlayCSS : { 
                  backgroundColor: '#ffffff',
                  opacity: 0.8
                },
                css : {
                  opacity: 1,
                  border: 'none',
                }
              });
              //$('.blockUI.blockMsg').center();
          },
          success: function(response) 
            {
              var obj = JSON.parse(response) || {};
              if(obj.length == 0)
              {
                $('#btn_add').show();
                $('#sub_cate_label').html('บริการ ' + $("#select_sub_cate :selected").text());
                $('#select_sub_cate').hide();
                fetch_desc($("#select_sub_cate :selected").val());
                $('#btn_add').attr('onclick','add2po("'+$("#select_sub_cate :selected").val()+'")')
                $('.detail').show();
                $('#div_date').show();
              }
              else if(obj.length > 0)
              {
                $('#btn_add').hide();
                $('#sub_cate_label').html('หมวดหมู่ย่อย ' + $("#select_sub_cate :selected").text());
                $('#select_sub_cate').show();
              }
              var i=0;
              var cate_select = '';
              while(obj[i])
              {
                cate_select = cate_select + '<option value="'+obj[i].cate_id+'">'+ obj[i].cate_id + '--' + obj[i].cate_name +'('+obj[i].is_product+')</option>';
                i++;
              }
              $('#select_sub_cate').html('<option>กรุณาเลือก</option>' + cate_select);

            },
            complete :function(){
            $('div.sub_cate').unblock();
              }					
        });
  
}

function fetch_desc(product_id)
{
    console.log(product_id+".....");
    var formData = new FormData();
    formData.append('cate_id',product_id);
    formData.append('request','fetch_desc'); //กำหนดเงื่อนไขให้ api
    $.ajax({
            url: './api/product_detail_emp_api.php',
            method: 'POST',
            data: formData,
            async: true,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend : function()
            {
                //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
                console.log("beforesend.....");
                $('div.desc').block({
                  message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                  overlayCSS : { 
                    backgroundColor: '#ffffff',
                    opacity: 0.8
                  },
                  css : {
                    opacity: 1,
                    border: 'none',
                  }
                });
                //$('.blockUI.blockMsg').center();
            },
            success: function(response) 
              {
                var obj = JSON.parse(response) || {};
                console.log(obj);
                $('#select_service_des').text(obj[0].content_body);
              },
             complete :function(){
              $('div.desc').unblock();
                }					
          });

}

function add2po(product)
{
    // validate data
    var appointment_date = $("#app_date_add2po").val() || '';
    console.log();
    if(appointment_date.length == 0){
      Swal.fire(
        '',
        'กรุณากรอกวันที่นัดหมายของบริการ',
        'warning'
      );
      $("#app_date_add2po").focus();
      return;
    }
    var purchase_id = getUrlVars()["purchase_id"];
    var formData = new FormData();
    formData.append('cate_id',product);
    formData.append('purchase_id',purchase_id);
    formData.append('des',$('#detail_from_cus').val());
    formData.append('app_date',$('#app_date_add2po').val());
    formData.append('request','add2po'); //กำหนดเงื่อนไขให้ api
    $.ajax({
            url: './api/product_detail_emp_api.php',
            method: 'POST',
            data: formData,
            async: true,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend : function()
            {
                //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
                console.log("beforesend.....");
                $('div.modal-dialog').block({
                  message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                  overlayCSS : { 
                    backgroundColor: '#ffffff',
                    opacity: 0.8
                  },
                  css : {
                    opacity: 1,
                    border: 'none',
                  }
                });
                //$('.blockUI.blockMsg').center();
            },
            success: function(response) 
              {
                console.log(response);
                if(response == 'already')
                      {
                          Swal.fire({
                            title: 'แจ้งเตือน !',
                            html: 'มีรายการนี้อยู่ในตะกร้าแล้ว...<br/> ',
                            type: 'warning',
                            timer: 5000
                        });
                      }
                      else if(response == 'inserted')
                      { 
                        //$.notify("เพิ่มรายการเข้าตะกร้าเรียบร้อย", "success", { position:"top" });
                        Swal.fire(
                                  {
                                    title: 'สำเร็จ !',
                                    html: 'เพิ่มรายการเข้าตะกร้าเรียบร้อย...<br/> ',
                                    type: 'success',
                                    timer: 5000
                                  }
                                 );
                        window.location.reload();
                      }
               
              },
             complete :function(){
              $('div.modal-dialog').unblock();
                }					
          });
}

function del()
{
    var purchase_id = getUrlVars()["purchase_id"];
    var formData = new FormData();
    formData.append('purchase_id',purchase_id);
    formData.append('cate_id',$('#modal_cate_id').text());
    formData.append('request','del'); //กำหนดเงื่อนไขให้ api
    $.ajax({
      url: './api/product_detail_emp_api.php',
      method: 'POST',
      data: formData,
      async: true,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend : function() {
        $('div.modal-dialog').block({
          message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
          overlayCSS : { 
            backgroundColor: '#ffffff',
            opacity: 0.8
          },
          css : {
            opacity: 1,
            border: 'none',
          }
        });
        //$('.blockUI.blockMsg').center();
      },
      success: function(response) {
        console.log('success', response);

        var photo_array = JSON.parse(response) || [];
        $.each(photo_array, function(index, photo_obj){
          firebase.storage().ref().child(photo_obj.firebase_ref).delete().then(function(){
            console.log('delete', photo_obj.firebase_ref);
          }).catch(function(){
            console.log('error delete', photo_obj.firebase_ref);
          });
        });

        Swal.fire({
          title: 'สำเร็จ !',
          html: 'ลบรายการเรียบร้อย...<br/> ',
          type: 'success',
          timer: 3000
        });
        window.location.reload();
        // $("table").bootstrapTable('refresh');
      },
      complete :function(){
        $('div.modal-dialog').unblock();
      }					
    });
    
}

function notifyCustomerAndOfficers(purchase_id){
  // ajax call
  Swal.fire({
    title: 'ต้องการแจ้งเตือน ?',
    text: "ไม่สามารถยกเลิกข้อความได้ที่ส่งไปแล้วได้",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'แจ้งเตือน',
    cancelButtonText: 'ยกเลิก'
  }).then(function(result){
    if(result.value){
      $.ajax({
        url: "./api/notify_update_purchase.php",
        method: "POST",
        data: {
          purchase_id: purchase_id
        },
        beforeSend: function(){
          $.blockUI({
            message: "ระบบกำลังแจ้งเตือน..."
          });
        },
        success: function(response){
          Swal.fire(
            "สำเร็จ",
            "ดำเนินการแจ้งเตือนไปยังผู้ใช้ไฟ และพนักงาน กบล.​กฟข. เรียบร้อยแล้ว",
            "success"
          );
        },
        error: function(error){
          Swal.fire(
            'ไม่สามารถแจ้งเตือน',
            JSON.stringify(error),
            'error'
          )
        },
        complete: function(){
          $.unblockUI();
        }
      });
    }
  });
}

$('#btn_add').hide();
$('.detail').hide();
$('#div_date').hide();
