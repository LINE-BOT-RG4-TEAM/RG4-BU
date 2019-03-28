$(function() {
    $.ajax({
      method: "GET",
      url: "./api/datatable/fetch_detail_by_ca.php",
      data: "ca=" + $("#hidden_ca").val(),
      beforeSend: function() {
        console.log("beforeSend");
      },
      success: function(data) {
        var detail_ca = JSON.parse(data) || {};
        setCustomerDetail(detail_ca);
      },
      error: function(error) {
        console.log("error");
      },
      done: function() {
        console.log("done");
      }
    });
  });
  
  console.log($("#hidden_cate_id").val());