window.onload = function(e) {
  liff.init(function(data) {
    initializeUserId(data);
    liff
    .getProfile()
    .then(function(profile){
      $("#dear_title").text("เรียน คุณ "+profile.displayName);
      //alert(JSON.stringify(profile));
    });
  });
  var input = document.createElement("input");
  input.setAttribute("type", "hidden");
  input.setAttribute("name", "userId");
  input.setAttribute("id", "userId");
  //input.setAttribute("value", data.context.userId);
  input.setAttribute("value", 'Uaef7a8e9eedce02d663bf83aec1dd910555');
  document.getElementsByTagName("body")[0].append(input);
  quantity_service();
  //purchase_status();
};


function initializeUserId(data) {
  var input = document.createElement("input");
  input.setAttribute("type", "hidden");
  input.setAttribute("name", "userId");
  input.setAttribute("id", "userId");
  input.setAttribute("value", data.context.userId);
  document.getElementsByTagName("body")[0].append(input);
  //window.alert("created element successfully: " + $("#userId").val());
  // document.getElementById("languagefield").textContent = data.language;
  // document.getElementById("viewtypefield").textContent = data.context.viewType;
  // document.getElementById("useridfield").textContent = data.context.userId;
  // document.getElementById("utouidfield").textContent = data.context.utouId;
  // document.getElementById("roomidfield").textContent = data.context.roomId;
  // document.getElementById("groupidfield").textContent = data.context.groupId;
  quantity_service();
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
                if(obj.length > 0)
                {
                  var html_text = render_lineitem(obj);
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
                  $.notify("ลบรายการสำเร็จ", "success", { position:"top" });
                  $("#lineitem_area").html('');
                  check_lineitem()
                  quantity_service()
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

