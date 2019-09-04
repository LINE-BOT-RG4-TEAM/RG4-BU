window.onload = function(e) {
  liff.init(function(data) {
    sessionStorage.setItem('userId', data.context.userId);
    initializeUserId(data);
    liff
    .getProfile()
    .then(function(profile){
      $("#dear_title").text("เรียน คุณ "+profile.displayName);
    });
  });
};

window.onerror = function(message, file, line, column, error) {
  console.log('onerror now');
  TrackJS.track(error);
}


function initializeUserId(data) {
  var userId = data.context.userId;
  var input = document.createElement("input");
  input.setAttribute("type", "hidden");
  input.setAttribute("name", "userId");
  input.setAttribute("id", "userId");
  input.setAttribute("value", data.context.userId);
  document.getElementsByTagName("body")[0].append(input);

  // update data in page by functions
  quantity_service();
  // try {
  //   purchase_status();
  // } catch(error) {
  //   console.error(error);
  // }
  // check_lineitem();
}

function render_lineitem(obj)
{
  var i = 0;
  var html_text = "";
  var purchase_id = obj[0].purchase_id;
  while(obj[i])
  {
    var num = i+1;
    html_text = html_text + "<p>" + num + "." + obj[i][0].cate_name + "<span class='font-weight-bold text-danger'><i class='fas fa-trash float-right' onclick='del("+obj[i].purchase_lineitem_id+")' aria-hidden='true'></i></span></p><hr>";
    i++;
  }
  $("#head_modal").html("<i class='fas fa-shopping-cart'></i> รายการบริการ " + i + " รายการ(" + purchase_id + ")");
  var btn = document.getElementById("check_out");
  btn.setAttribute("href","?action=checkout&purchase_id=" + purchase_id);
  return html_text;
}

function check_lineitem()
{
  var UserID = document.getElementById('userId').value;
  var formData = new FormData();
  formData.append('userid',UserID);
  $.ajax({
    url: './api/check_lineitem_api.php',
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
            },
    success: function(response) 
              {
                var obj = JSON.parse(response) || {};
                var html_text = "";
                if(obj.length > 0){
                  html_text = render_lineitem(obj);
                } else {
                  html_text = '<div class="text-primary text-center"><h4><i class="far fa-check-circle"></i> ท่านยังไม่ได้เลือกสินค้าลงตระกร้า</h4></div>';
                }
                $("#lineitem_area").html(html_text);
              },
    complete :function(){
                $('div.modal-dialog').unblock();
                }					
    });
  }

  function del(itemId)
  {
    //alert(itemId);
    var formData = new FormData();
    formData.append('lineitem_id',itemId);
    $.ajax({
      url: './api/del_lineitem_api.php',
      method: 'POST',
      data: formData,
      async: true,
      cache: false,
      processData: false,
      contentType: false,
      success: function(response) 
                {
                  //alert(response);
                  //$.notify("ลบรายการสำเร็จ", "success", { position:"top" });
                  Swal.fire({
                    title: 'สำเร็จ !',
                    html: 'ลบรายการจากตะกร้าเรียบร้อย...<br/> ',
                    type: 'success',
                    timer: 5000
                });
                  $("#lineitem_area").html('');
                  check_lineitem();
                  quantity_service();
                }				
    });
  }
$("#cartModal").on('shown.bs.modal', function(){
  check_lineitem();
});

$("#cartModal").on('hide.bs.modal', function(){
  $("#lineitem_area").html('');
});

function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
  });
  return vars;
}

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
