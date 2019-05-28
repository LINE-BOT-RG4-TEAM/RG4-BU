console.log("js run");
var UserID = document.getElementById('userId').value;
console.log(UserID);
 /* var formData = new FormData();
  formData.append('userid',UserID);
  $.ajax({
    url: './api/purchase_status_api.php',
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
                var obj = JSON.parse(response) || {};
                if(obj.length > 0)
                {
                  var html_text = render_lineitem(obj);
                }
                $("#lineitem_area").html(html_text);
              },
    complete :function(){
                $.unblockUI();
                }					
    });*/
