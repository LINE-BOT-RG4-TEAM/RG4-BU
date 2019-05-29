function confirm_edit()
{
    $.ajax({
        url: './api/pending_api.php',
        method: 'POST',
        data: $("#form").serialize(),
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
        });

}
function fetch_pending_data(obj)
{
    var i = 0;
    var purchase_status_html = "";
    while(obj[i])
    {
        var num = i+1;
        purchase_status_html = purchase_status_html + '<li  class="list-group-item"><div class="text-center"><label class="font-weight-bold text-primary bg-light py-2 px-5 shadow-sm" style="font-size:22px;border-radius: 20px;"><i class="fas fa-check"></i>บริการที่ '+ num +'</label></div><p style="font-size:20px;"><span class="font-weight-bold text-success"><i class="far fa-handshake"></i> บริการ: </span><span class="pl-1">'+ obj[i].cate_name +'</span></p><p style="font-size:20px;"><span class="font-weight-bold text-secondary"><i class="fas fa-comment-dots"></i> ความต้องการเพิ่มเติม:</span> <br/><span class="pl-4"><textarea class="form-control" rows="5" id="des" name = "des" disabled>' + obj[i].des + '</textarea></span><p class="font-weight-bold" style="font-size:20px;"><i class="far fa-calendar-alt"></i> นัดหมายวันรับบริการ:</p><p><input class="form-control text-center datepicker" style="font-size:22px; type="date" disabled name="date_input" value="' + obj[i].appointment_date +'"/></p></p></li>';
        i++;
    }
    $('#fetch_area').html(purchase_status_html);
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '+5d'
    });
}
function fetch_pending()
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
                    console.log(response);
                    var obj = JSON.parse(response) || {};
                    fetch_pending_data(obj);
                    $('#purchase_id').html(purchase_id);
                    $('#btn_select_more').attr('href','?action=liff_service&purchase_id='+purchase_id);
                  },
        complete :function(){
                    $.unblockUI();
                    }					
        });

}


$( document).ready(function() {
    fetch_pending();
    var obj_test = getUrlVars();
    console.log(obj_test);
    if('purchase_id1' in obj_test)
    {
        console.log('มีนะ');
    }
  });

$('#edit_btn').click(
                        function()
                        {
                            console.log($('#edit_btn').val());
                            if($('#edit_btn').val() == 'edit')
                            {
                                $('#edit_btn').val('confirm');
                                $('#edit_btn').html('ยืนยัน');
                                $('#edit_status').html(' (กำลังแก้ไข)');
                                $("textarea[name='des']").prop( "disabled", false );
                                $("input[name='date_input']").prop( "disabled", false );
                            }
                            else if($('#edit_btn').val() == 'confirm')
                            {
                                confirm_edit();
                                /*$('#edit_btn').val('edit');
                                $('#edit_btn').html('แก้ไข');
                                $('#edit_status').html('');
                                $("textarea[name='des']").prop( "disabled", true );
                                $("input[name='date_input']").prop( "disabled", true );*/
                            }
                            
                        }
                    );

