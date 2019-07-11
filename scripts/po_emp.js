function po_Formatter(value, row, index) {
  console.log(value, row);
    var status = row.po_status;
    var btn_list = [];
    btn_list.push('<div class="btn-group-vertical btn-block">');
    if(status == "P"){
      // view
      btn_list.push('<a class="btn btn-block btn-primary po-detail" href="javascript:void(0)" title="Like">');
      btn_list.push('<i class="fa fa-eye"></i> รายละเอียด');
      btn_list.push('</a>');

      // complete jobs
      btn_list.push('<a class="btn btn-block btn-primary close-po" href="javascript:void(0)" title="Close">');
      btn_list.push('<i class="fas fa-check"></i> ปิดงาน');
      btn_list.push('</a>');
    } else if (status == "A"){
      // view
      // btn_list.push('<a class="btn btn-block btn-primary readonly-po-detail" href="javascript:void(0)" title="Like">');
      // btn_list.push('<i class="fa fa-eye"></i> รายละเอียด');
      // btn_list.push('</a>');

      // active jobs
      btn_list.push('<a class="btn btn-block btn-primary active-po" href="javascript:void(0)" title="Close">');
      btn_list.push('<i class="fas fa-check"></i> แก้ไขงาน');
      btn_list.push('</a>');
    }
    btn_list.push("</div>");
    return btn_list.join("");
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
      window.location.href = "?action=purchase_detail_emp&purchase_id=" + row["purchase_id"]+"&readonly=true";
    },
    "click .readonly-po-detail": function(e, value, row, index) {
      // redirect to page for show ca detail
      window.location.href = "?action=purchase_detail_emp&purchase_id=" + row["purchase_id"]+"&readonly=true";
    },
    "click .close-po": function(e, value, row, index) {
      alert('click close po');
      $.ajax({
        url: "./api/update_purchase_status.php",
        method: "POST",
        data: {
          purchase_id: row['purchase_id'],
          set_status_to: "A"
        },
        beforeSend: function(){
          $.blockUI();
        },
        success: function(){
          Swal.fire(
            "ปิดงานเรียบร้อยแล้ว",
            "",
            "success"
          );
        },
        error: function(){
          Swal.fire(
            "เกิดข้อผิดพลาด",
            "",
            "danger"
          );
        },
        complete: function(){
          $.unblockUI();
          $("table").bootstrapTable('refresh');
        }
      });
    },
    "click .active-po": function(e, value, row, index) {
      // alert('click active po');
      // console.log(row);
      $.ajax({
        url: "./api/update_purchase_status.php",
        method: "POST",
        data: {
          purchase_id: row['purchase_id'],
          set_status_to: "P"
        },
        beforeSend: function(){
          $.blockUI();
        },
        success: function(){
          Swal.fire(
            "สามารถแก้ไขใบสั่งได้แล้ว",
            "",
            "success"
          );
        },
        error: function(){
          Swal.fire(
            "เกิดข้อผิดพลาด",
            "",
            "danger"
          );
        },
        complete: function(){
          $.unblockUI();
          $("table").bootstrapTable('refresh');
        }
      });
    }
  };