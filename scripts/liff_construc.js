function render_card(obj)
{
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
          var button_label = "เพิ่มในตะกร้า";
          var href = "";
          var add2cart = "onclick='add2cart()'";
          var text_area = '<div class="form-group mt-3"><textarea class="form-control" rows="5" id="comment" placeholder="แจ้งรายละเอียดเพิ่ม(ถ้ามี)"></textarea></div>';
        }
        else if (obj[i].is_product == 'N')
        {
          var button_label = "รายละเอียด";
          var href = "?action=liff_construc&cate_id=" + obj[i].cate_id;
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
        card = card + '<div class="col-sm-12 col-md-6 col-lg-4 mt-3"><div class="card h-100"><img class="card-img-top" src="images/'+ picture_name +'.jpg" alt="Card image"><div class="card-body"><h5 class="card-title">' +obj[i].cate_name + '</h5><p class="card-text">'+short_des+'</p><p class="card-text">' + warranty + '</p><img class="card-img-top" src="images/pea-price.jpg" alt="Card image">' + text_area + '</div><div class="card-footer"><a href="' + href + '" class="btn btn-primary" ' + add2cart + '>'+button_label+'</a></div></div></div>';
        console.log(obj[i].cate_name);
        i++;
    }
    return card;
}
function add2cart()
{
  console.log('add complete');
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