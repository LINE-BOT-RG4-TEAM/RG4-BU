function render_purchase_status(obj)
{
    console.log(obj.pending);
    var i = 0;
    var html_purchase_pending = '';
    while(obj.pending[i])
    {
        var num = i+1;
        html_purchase_pending = html_purchase_pending + '<a class="nav-link" href="?action=purchase_detail&purchase_id='+obj.pending[i]+'"><p>'+num+'.เลขที่ '+obj.pending[i]+'</p><hr></a>';
        i++;
    }
    if(html_purchase_pending == ''){html_purchase_pending = '--ไม่มีข้อมูล--'}
    $("#pending").html(html_purchase_pending);

    var i = 0;
    var html_purchase_approve = '';
    while(obj.approve[i])
    {
        var num = i+1;
        html_purchase_approve = html_purchase_approve + '<a class="nav-link"><p>'+num+'.เลขที่ '+obj.approve[i]["PURCHASE_ID"]+'</p><hr></a>';
        i++;
    }
    if(html_purchase_approve == ''){html_purchase_approve = '--ไม่มีข้อมูล--'}
    $("#approve").html(html_purchase_approve);
}
function purchase_status(userId)
{
    console.log("js run");
    // var UserID = document.getElementById('userId').value;
    var formData = new FormData();
    formData.append('userid',userId);
    $.ajax({
      url: './api/purchase_status_api.php',
      method: 'POST',
      data: formData,
      async: true,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend : function(){
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
      success: function(response) {
        console.log("success");
        var obj = JSON.parse(response) || {};
        render_purchase_status(obj);
      },
      complete :function(){
        console.log("complete");
        $.unblockUI();
      }					
    });
}

$(document).ready(function() {
//   alert('from document ready');
  var userId = localStorage.getItem('userId');
  purchase_status(userId);
//   alert('from purchase_status: '+document.getElementById("userId").value);
});
