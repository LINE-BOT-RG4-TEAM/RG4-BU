function lineitem_format(value, row, index) {
  return [
    '<a class="btn btn-sm btn-outline-primary po-detail" href="#" title="Like" data-toggle="modal" onclick="product_detail('+"'" + value + "'" +')" data-target="#cartModal">',
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

function product_detail(data)
{
  console.log(data);
  var purchase_id = getUrlVars()["purchase_id"];
  $('#modal_cate_id').html(data);
  $('#modal_purchase_id').html(purchase_id);
  var formData = new FormData();
  formData.append('purchase_id',purchase_id);
  formData.append('cate_id',data);
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
          });;
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


