function render_card(obj)
{
  var i = 1;
    var card = "";

    while(obj[i])
    {
        if(obj[i].picture_name == 'null')
        {
          var picture_name = 'pea';
        }
        else 
        {
          var picture_name = obj[i].picture_name;
        }
        card = card + '<div class="col-sm-12 col-md-6 col-lg-4 mt-3"><div class="card h-100"><img class="card-img-top" src="images/'+ picture_name +'.jpg" alt="Card image"><div class="card-body"><h5 class="card-title">' +obj[i].cate_name + '</h5><p class="card-text">'+obj[i].short_description+'</p></div><div class="card-footer"><a href="?action=liff_construc&cate_id='+obj[i].cate_id+'" class="btn btn-primary">รายละเอียด</a></div></div></div>';
        console.log(obj[i].cate_name);
        i++;
    }
    return card;
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
        //var html_text = render_card(obj);
        $("#content_header").html('<i class="fas fa-table"></i>' +' '+ obj[0].level.cate_name);
        $("#content_body").html(obj[0].level.content_body);
        //$("#card-area").html(html_text);
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