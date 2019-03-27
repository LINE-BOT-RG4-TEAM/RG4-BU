function home_data() 
{
  $.ajax({
    url: './api/home_data.php',
    method: 'POST',
    async: true,
    cache: false,
    processData: false,
    contentType: false,
    success: function(response) 
              {
                
                var obj = JSON.parse(response) || {};
                $("#high_value_card").html('จำนวน ' + obj.high_value + ' ราย');
                $("#bu_card").html('จำนวน ' + obj.bu + ' ราย');
                $("#not_bu_card").html('จำนวน ' + obj.not_bu + ' ราย');
                console.log(obj);
              }				
    }); 
}
home_data();
