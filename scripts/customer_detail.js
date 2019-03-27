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

function setCustomerDetail(detail_ca) {
  $("[id^=bp]").val(detail_ca.BP);
  $("[id^=ca]").val(detail_ca.CA);
  $("[id^=business_type]").val(detail_ca.BUSINESS_TYPE);
  $("[id^=customer_name]").val(detail_ca.CUSTOMER_NAME);
  $("[id^=address]").val(detail_ca.ADDRESS);
  $("[id^=max_bill]").val(detail_ca.MAX_BILL);
  $("[id^=hml_type]").val(detail_ca["HML_Type"]);
  $("[id^=4S]").val(detail_ca["4S"]);
  $("[id^=kamr]").val(detail_ca.KAMR);
}
