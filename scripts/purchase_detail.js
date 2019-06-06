function confirm_edit()
{
    /* $.ajax({
        url: './api/pending_api.php',
        method: 'POST',
        data: {form_data : $("#form").serialize()},
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
                    console.log(response);
                  },
        complete :function(){
                    $.unblockUI();
                    }					
        });*/

}
function fetch_pending_data(obj,edit)
{
    var i = 0;
    var purchase_status_html = "";
    var json = '';
    while(obj[i])
    {
        
        var num = i+1;
        var appointment_date = obj[i].appointment_date;
        if(obj[i].appointment_date == null)
        {
            appointment_date = '';
        }
        var del_from_pendimg = 'onclick="del_from_pending(' + "'" + obj[i].cate_id + "'" +')"';
        var del_btn = '<button type="button"  disabled name="btn_del" class="btn btn-block btn-lg btn-danger" '+ del_from_pendimg +'><i class="fas fa-trash" aria-hidden="true"></i>  ลบรายการ</button>';
        purchase_status_html = purchase_status_html + '<li  class="list-group-item"><div class="text-center"><label class="font-weight-bold text-primary bg-light py-2 px-5 shadow-sm" style="font-size:22px;border-radius: 20px;"><i class="fas fa-check"></i>บริการที่ '+ num +'</label></div><p style="font-size:20px;"><span class="font-weight-bold text-success"><i class="far fa-handshake"></i> บริการ: </span><span class="pl-1">'+ obj[i].cate_name +'</span></p><p style="font-size:20px;"><span class="font-weight-bold text-secondary"><i class="fas fa-comment-dots"></i> ความต้องการเพิ่มเติม:</span> <br/><span class="pl-4"><textarea class="form-control" rows="5" id="des" name="purchases['+obj[i].purchase_lineitem_id+'][desc]" disabled>' + obj[i].des + '</textarea></span><p class="font-weight-bold" style="font-size:20px;"><i class="far fa-calendar-alt"></i> นัดหมายวันรับบริการ:</p><p><input class="form-control text-center datepicker" style="font-size:22px;" type="text" disabled required name="purchases['+obj[i].purchase_lineitem_id+'][appointment_date]" value="' + appointment_date +'"/></p></p>'+del_btn+'</li>';
        i++;
    }
    
    //$('#hidden_var').append(json);
    $('#fetch_area').html(purchase_status_html);
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '+5d'
    });
    var get_param = getUrlVars();
    if('edit' in get_param || edit == 'T')
    {
        $('#edit_btn').val('confirm');
        $('#edit_btn').html('ยืนยัน');
        $('#edit_status').html(' (กำลังแก้ไข)');
        $("textarea[name*='desc']").prop( "disabled", false );
        $("input[name*='appointment_date']").prop( "disabled", false );
        $("button[name='btn_del']").prop( "disabled", false );
        $('#edit_btn').attr('type','submit');
        $('#cancle').hide();
    } 
}
function fetch_pending(edit)
{
    var purchase_id = getUrlVars()["purchase_id"];
    var formData = new FormData();
    formData.append('purchase_id',purchase_id);
    $.ajax({
        url: './api/fetch_pending_api.php',
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
                    fetch_pending_data(obj,edit);
                    $('#purchase_id').html(purchase_id);
                    $('#purchase_id_hid').val(purchase_id);
                    $('#btn_select_more').attr('href','?action=liff_service&purchase_id='+purchase_id);
                  },
        complete :function(){
                    $.unblockUI();
                    }					
        });

}

function del_from_pending(cate_id)
{
  console.log(cate_id + $('#purchase_id_hid').val());
  var formData = new FormData();
	formData.append('purchase_id',$('#purchase_id_hid').val());
  formData.append('cate_id',cate_id);
  $.ajax({
    url: './api/del_from_pending_api.php',
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
    success: function() {
                        //$.notify("เพิ่มรายการเข้าตะกร้าเรียบร้อย", "success", { position:"top" });
                        Swal.fire({
                          title: 'สำเร็จ !',
                          html: 'ลบรายการเรียบร้อย...<br/> ',
                          type: 'success',
                          timer: 5000
                      });
                      var edit = "T";
                      fetch_pending(edit);
                      $('#cancle').hide();
                  },
      complete :function(){
          $.unblockUI();
          
          }	
    });
}

function reload()
{
  console.log("reload");
  window.location.reload();
}

$( document).ready(function() {
   $('#cancle').hide();
    fetch_pending();
  });

$('#edit_btn').click(function(event){
    console.log($('#edit_btn').val());
    if($('#edit_btn').val() == 'edit'){
      event.preventDefault();
      $('#edit_btn').val('confirm');
      $('#edit_btn').html('ยืนยัน');
      $('#edit_status').html(' (กำลังแก้ไข)');
      $("textarea[name*='desc']").prop( "disabled", false );
      $("input[name*='appointment_date']").prop( "disabled", false );
      $("button[name='btn_del']").prop( "disabled", false );
      $('#edit_btn').attr('type','submit');
      $('#cancle').show();
    }
  }
);
