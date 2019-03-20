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
