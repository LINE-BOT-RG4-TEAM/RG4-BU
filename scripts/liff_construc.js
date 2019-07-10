function render_card(obj)
{
  var get_param = getUrlVars();
  var href_purchase_id= "";
  if('purchase_id' in get_param)
    {
        console.log(get_param["purchase_id"]);
        var href_purchase_id = '&purchase_id=' + get_param["purchase_id"];
    }  
  var i = 1;
    var card = "";

    while(obj[i])
    {
      //ดูรูปภาพว่ามีหรือไม่  
      if(obj[i].picture_name == null)
        {
          var picture_name = 'pea';
        }
        else 
        {
          var picture_name = obj[i].picture_name;
        }
        //ดู short_des 
        if(obj[i].short_description == null)
        {
          var short_des = "";
          console.log('short is n');
        }
        else
        {
          var short_des = obj[i].short_description;
        }
        if(obj[i].is_product == 'Y')
        {
          var button_label = "<i class=\"fas fa-cart-arrow-down\"></i> เพิ่มในตะกร้า";
          var href = "href=\"javascript:void(0);\"";
          var add2cart = 'onclick="add2cart(' + "'" + obj[i].cate_id + "'" +')"';
          if('purchase_id' in get_param)
          {
            var add2cart = 'onclick="add2pending(' + "'" + obj[i].cate_id + "'" +')"';
          }
          var text_area = '<div class="form-group mt-3"><textarea class="form-control" rows="5" id="comment' + obj[i].cate_id + '" placeholder="แจ้งรายละเอียดเพิ่ม(ถ้ามี)"></textarea></div>';
        }
        else if (obj[i].is_product == 'N')
        {
          var button_label = "<i class=\"fas fa-align-left\"></i> รายละเอียด";
          var href = "href='?action=liff_construc&cate_id=" + obj[i].cate_id + href_purchase_id + "'";
          var text_area = "";
        }
        if(obj[i].warranty == null)
        {
          var warranty =  '' ;
        }
        else
        {
          var warranty =  'การรับประกัน :' + obj[i].warranty ;
        }
        card = card + '<div class="col-sm-12 col-md-6 col-lg-4 mt-3"><div class="card h-100"><img class="card-img-top" src="images/'+ picture_name +'.jpg" alt="Card image"><div class="card-body"><h5 class="card-title">' +obj[i].cate_name + '</h5><p class="card-text">'+short_des+'</p><p class="card-text">' + warranty + '</p><img class="card-img-top" src="images/pea-price.jpg" alt="Card image">' + text_area + '</div><div class="card-footer"><a ' + href + ' class="btn btn-primary nav-link" ' + add2cart + '>'+button_label+'</a></div><div class="ribbon"><span>' + obj[i].cate_id + '</span></div></div></div>';
        console.log(obj[i].cate_name);
        i++;
    }
    return card;
}
function add2cart(product_data)
{
  var comment = document.getElementById('comment' + product_data).value;
  var UserID = document.getElementById('userId').value;
  //alert(comment + UserID + product_data);
  var formData = new FormData();
	formData.append('userid',UserID);
	formData.append('comment',comment);
  formData.append('cate_id',product_data);
	$.ajax({
			url: './api/add_2_cart.php',
			method: 'POST',
			data: formData,
			async: true,
			cache: false,
			processData: false,
      contentType: false,
      beforeSend : function()
            {
                //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
                console.log("beforesend.....");
                $.blockUI({
                    message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                    overlayCSS : { 
                      backgroundColor: '#ffffff',
                      opacity: 0.8
                    },
                    css : {
                      opacity: 1,
                      border: 'none',
                    }
                  });
            },
			success: function(response) {
                        //alert(response);
                        if(response == 'already')
                        {
                            //$.notify("มีรายการนี้อยู่ในตะกร้าแล้ว", "warn", { position:"top" });
                            Swal.fire({
                              title: 'แจ้งเตือน !',
                              html: 'มีรายการนี้อยู่ในตะกร้าแล้ว...<br/> ',
                              type: 'warning',
                              timer: 5000
                          });
                        }
                        else if(response == 'inserted')
                        { 
                          //$.notify("เพิ่มรายการเข้าตะกร้าเรียบร้อย", "success", { position:"top" });
                          Swal.fire({
                            title: 'สำเร็จ !',
                            html: 'เพิ่มรายการเข้าตะกร้าเรียบร้อย...<br/> ',
                            type: 'success',
                            timer: 5000
                        });
                        }
                        
                        quantity_service();
                    },
        complete :function(){
            $.unblockUI();
        		}	
			});
  console.log('add complete'+ product_data + 'with comment :' + comment.value);
}

function add2pending(product_data)
{
  var comment = document.getElementById('comment' + product_data).value;
  var purchase_id = getUrlVars()["purchase_id"];
  console.log(comment + purchase_id);
  var formData = new FormData();
	formData.append('purchase_id',purchase_id);
	formData.append('comment',comment);
  formData.append('cate_id',product_data);
  $.ajax({
    url: './api/add_2_pending.php',
    method: 'POST',
    data: formData,
    async: true,
    cache: false,
    processData: false,
    contentType: false,
    beforeSend : function()
          {
              //$.blockUI({message : '<h1>กำลังเข้าสู่ระบบ</h1>'});
              console.log("beforesend.....");
              $.blockUI({
                  message: '<div class="spinner-grow text-primary display-4" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div>',
                  overlayCSS : { 
                    backgroundColor: '#ffffff',
                    opacity: 0.8
                  },
                  css : {
                    opacity: 1,
                    border: 'none',
                  }
                });
          },
    success: function(response) {
                      //alert(response);
                      if(response == 'already')
                      {
                          //$.notify("มีรายการนี้อยู่ในตะกร้าแล้ว", "warn", { position:"top" });
                          Swal.fire({
                            title: 'แจ้งเตือน !',
                            html: 'มีรายการนี้อยู่ในตะกร้าแล้ว...<br/> ',
                            type: 'warning',
                            timer: 5000
                        });
                      }
                      else if(response == 'inserted')
                      { 
                        //$.notify("เพิ่มรายการเข้าตะกร้าเรียบร้อย", "success", { position:"top" });
                        Swal.fire({
                          title: 'สำเร็จ !',
                          html: 'เพิ่มรายการเข้าตะกร้าเรียบร้อย...<br/> ',
                          type: 'success',
                          timer: 5000
                      });
                        $.unblockUI();
                        window.location.href = '?action=purchase_detail&edit=true&purchase_id=' + purchase_id
                      }
                  },
      complete :function(){
          $.unblockUI();
          
          }	
    });
}

$(function() {
    $.ajax({
      method: "GET",
      url: "./api/liff_construc_api.php",
      data: "cate_id=" + $("#hidden_cate_id").val(),
      beforeSend: function() {
        console.log("beforeSend");
      },
      success: function(data) {
        var obj = JSON.parse(data) || {};
        var html_text = render_card(obj);
        $("#content_header").html('<i class="fas fa-table"></i>' +' '+ obj[0].level.cate_name);
        $("#content_body").html(obj[0].level.content_body);
        $("#card-area").html(html_text);
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