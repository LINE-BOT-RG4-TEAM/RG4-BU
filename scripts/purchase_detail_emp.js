function lineitem_format(value, row, index) {
  return [
    '<a class="btn btn-block btn-sm btn-outline-primary po-detail" href="#" title="Like" data-toggle="modal" onclick="set_cate_id_modal('+"'" + value + "'" +')" data-target="#PoModal">',
    '<i class="fa fa-eye"></i> รายละเอียด..',
    "</a>  "
  ].join("");
}

function textCenterFormatter(value, row, index) {
  return "<div class='text-center'>" + value + "</div>";
}

function suffixQuantityTextCenterFormatter(value, row) {
  return "<div class='font-weight-bold text-center'>" + value + " ครั้ง</div>";
}

/*window.lineitem_format_Events = {
  "click .po-detail": function(e, value, row, index) {
    // redirect to page for show ca detail
    window.location.href = "?action=purchase_detail_emp&purchase_id=" + row["purchase_id"];
  }
};*/

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

$( document).ready(function() {
    var purchase_id = getUrlVars()["purchase_id"];
    $('#purchase_id').html(purchase_id);
    $('#btn-confirm').hide();
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
        beforeSend : function()
                {
                    //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
                    console.log("beforesend.....");
                    $.blockUI({
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
                },
        success: function(response) 
                  {
                    //console.log(response);
                    var obj = JSON.parse(response) || {};
                    console.log(obj);
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
                  },
        complete :function(){
                    $.unblockUI();
                    }					
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
                  html: 'ลบรายการเรียบร้อย...<br/> ',
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

$('#btn_add').hide();
$('.detail').hide();
$('#div_date').hide();



