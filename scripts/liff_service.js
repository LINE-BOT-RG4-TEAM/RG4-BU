function render_cate_card(obj) {
  var get_param = getUrlVars();
  var href= "";
  if('purchase_id' in get_param) {
    // console.log(get_param["purchase_id"]);
    href = '&purchase_id=' + get_param["purchase_id"];
  }
  var i = 0;
  var card = "";
  while(obj[i]) {
    card = card + '<div class="col-sm-12 col-md-6 col-lg-4 mt-3"><div class="card h-100"><img class="card-img-top" src="images/'+ obj[i].picture_name +'.jpg" alt="Card image"><div class="card-body"><h4 class="card-title text-primary text-center font-weight-bold">' +obj[i].cate_name + '</h4><p class="card-text jumbotron text-center">'+obj[i].short_description+'</p></div><div class="card-footer"><a  href="?action=liff_construc&cate_id='+obj[i].cate_id+href+'" class="btn btn-primary nav-link">รายละเอียด</a></div></div></div>';
    // console.log(obj[i].cate_name);
    i++;
  }
  return card;
}

function select_cate_product() {
  $.ajax({
    url: './api/liff_service_api.php',
    method: 'POST',
    async: true,
    cache: false,
    processData: false,
    contentType: false,
    success: function(response) {
      var obj = JSON.parse(response) || {};
      var html_text = render_cate_card(obj);
      $("#card-area").html(html_text);
    }				
  }); 
}
select_cate_product();

$(function(){
  liff.init(function(data){
    var userId = data.context.userId;
    // append userId 
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "userId");
    input.setAttribute("id", "userId");
    input.setAttribute("value", userId);
    document.getElementsByTagName("body")[0].append(input);

    // fetch data
    check_lineitem();
    quantity_service();
    
    $.ajax({
      url: "./api/check_existing_user_id.php",
      method: "POST",
      data: {
        userId: userId
      },
      beforeSend: function(){
        $.blockUI({message: "กรุณารอสักครู่ค่ะ..."});
      },
      success: function(response){
        // continue select service
      },
      error: function(error){
        Swal.fire(
          "กรุณาลงทะเบียนการใช้งานค่ะ...",
          "",
          "question"
        ).then(function(){
          Swal.fire(
            "ระบบกำลังนำท่านไปยังหน้าลงทะเบียนค่ะ :)",
            "",
            "info"
          ).then(function(){
            window.location.href = "customer.php?action=cust_register";
          });
        });
      },
      complete: function(){
        $.unblockUI();
      }
    });
  });
});