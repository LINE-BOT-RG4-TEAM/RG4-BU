function operateFormatter(value, row, index) {
  return [
    '<a class="btn btn-sm btn-outline-primary customer-detail" href="javascript:void(0)" title="Like">',
    '<i class="fa fa-eye"></i> รายละเอียด',
    "</a>  "
  ].join("");
}

function textCenterFormatter(value, row, index) {
  return "<div class='text-center'>" + value + "</div>";
}

function suffixQuantityTextCenterFormatter(value, row) {
  return "<div class='font-weight-bold text-center'>" + value + " ครั้ง</div>";
}

window.operateEvents = {
  "click .customer-detail": function(e, value, row, index) {
    // redirect to page for show ca detail
    window.location.href = "?action=customer_detail&ca=" + row["CA"];
  }
};
//// เพิ่ม function เชคจำนวนบริการในตะกร้า
function quantity_service()
{
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
               alert("function quantity_service success... ");
               $("#quantity_service").text(response + " บริการ");
              }				
    });
}

function render_lineitem(obj)
{
  var i = 1;
  var html_text = "";
  while(obj[i])
  {
    html_text = html_text + "<div class='form-check'><label class='form-check-label' for='check"+i+"'><input type='checkbox' class='form-check-input' id='check"+i+"' name='option"+i+"' value='something'>"+obj[i].cate_id+"</label></div><hr>";
  }
  return html_text;
}

function check_lineitem()
{
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
                var obj = JSON.parse(response) || {};
                var html_text = render_lineitem(obj);
                $("#lineitem_area-area").html(html_text);
              }				
    });
}

