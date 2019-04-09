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
  alert("function quantity_service ");
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
                alert("function quantity_service success ");
               $("#quantity_service").text(response + " บริการ");
              }				
    });
}

