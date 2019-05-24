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
  alert("render line item");
  var i = 1;
  var html_text = "";
  while(obj[i])
  {
    alert("render while");
    html_text = html_text + "<div class='form-check'><label class='form-check-label' for='check"+i+"'><input type='checkbox' class='form-check-input' id='check"+i+"' name='option"+i+"' value='something'>"+obj[i].cate_id+"</label></div><hr>";
  }
  return html_text;
}

function check_lineitem()
{
  alert("check lineitem");
  var UserID = document.getElementById('userId').value;
  var formData = new FormData();
  formData.append('userid',UserID);
  $.ajax({
    url: './api/check_service_api.php',
    method: 'POST',
    data: formData,
    async: true,
		cache: false,
		processData: false,
		contentType: false,
    success: function(response) 
              {
                alert("check lineitem success");
                var obj = JSON.parse(response) || {};
                var html_text = render_lineitem(obj);
                alert(obj[0].cate_id);
                $("#lineitem_area-area").html(html_text);
              }				
    });
  }
$("#cartModal").on('shown.bs.modal', function(){
  alert("modal shown...");
  check_lineitem();
});

