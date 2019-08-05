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
  console.log("quantity...");
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
                /*if(response == 0 )
                {
                  $("#notify_total").hide();
                  $("#notify_cart").hide();
                }
                else if (response > 0 )
                {
                  $("#notify_total").text(response);
                  $("#notify_cart").text(response);
                  if($("#circularMenu").hasClass('active'))
                  {
                    $("#notify_cart").show();
                    $("#notify_total").hide();
                  }
                  else
                  {
                    $("#notify_cart").hide();
                    $("#notify_total").show();
                  } 
                }*/
                show_num_service(response);
                
              }				
    });
}
function toggle_menu()
{
  document.getElementById('circularMenu').classList.toggle('active');
  quantity_service();
}

function show_num_service(num)
{
  if(num == 0)
  {
    $("#notify_total").hide();
    $("#notify_cart").hide();
  }
  else if (num > 0)
  {
    $("#notify_total").text(num);
    $("#notify_cart").text(num);
    if($("#circularMenu").hasClass('active'))
    {
      $("#notify_cart").show();
      $("#notify_total").hide();
    }
    else
    {
      $("#notify_cart").hide();
      $("#notify_total").show();
    }
  }
}

function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
  });
  return vars;
}

function updateQuantityOfPR(){
  $.ajax({
    url: "./api/fetch_quantity_of_pr.php",
    method: "POST",
    beforeSend: function(){

    },
    success: function(response){
      response = response || "{}";
      var object = JSON.parse(response) || {};
      $(".pr-quantity").text(object.quantity+" ใบสรุป");
    },
    error: function(error){
      console.log('Not allowed show quantity of PR');
    },
    complete: function(){
      $(".pr-quantity").fadeIn();
    }
  });
}

$(function(){
  // autofetch quantity of pr 
  updateQuantityOfPR();
  include_ga();
});

// add ga
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-144567539-1']);
_gaq.push(['_trackPageview']);
var include_ga = (function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  alert('alert from ga');
});
