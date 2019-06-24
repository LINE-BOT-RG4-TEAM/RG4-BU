function po_Formatter(value, row, index) {
    return [
      '<a class="btn btn-block btn-primary po-detail" href="javascript:void(0)" title="Like">',
      '<i class="fa fa-eye"></i> รายละเอียด',
      "</a>  "
    ].join("");
  }

  function documentFormatter(value, row, index){
    var url = value || '';
    if(url.length > 0){
      return [
        '<a class="btn btn-success btn-block" href="'+url+'" target="_blank">',
        '<i class="fas fa-file-invoice-dollar"></i> ใบเสร็จ',
        '</a>'
      ].join("");
    }else{
      return [
        '<a class="btn btn-outline-success btn-block disabled" href="javascript:void(0);">',
        '<i class="fas fa-file-invoice-dollar"></i> ใบเสร็จ',
        '</a>'
      ].join("");
    }
  }
  
  function textCenterFormatter(value, row, index) {
    return "<div class='text-center'>" + value + "</div>";
  }
  
  function suffixQuantityTextCenterFormatter(value, row) {
    return "<div class='font-weight-bold text-center'>" + value + " ครั้ง</div>";
  }
  
  window.po_Events = {
    "click .po-detail": function(e, value, row, index) {
      // redirect to page for show ca detail
      window.location.href = "?action=purchase_detail_emp&purchase_id=" + row["purchase_id"];
    }
  };