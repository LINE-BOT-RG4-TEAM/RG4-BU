function dateThaiFormatter(value, row) {
  var now = new Date(Date.parse(value));
  var thmonth = new Array ("มกราคม","กุมภาพันธ์","มีนาคม",
                "เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
                "ตุลาคม","พฤศจิกายน","ธันวาคม"); 

  var str_thai = now.getDate()+ " " 
                + thmonth[now.getMonth()]+ " " + (0+now.getFullYear()+543);

  return str_thai;
}

window.onload = function(){
  var userId = getUrlVars()["userId"];
  alert(userId);
  var callback = fetchDataByCa(20018553633);
  callback.done(function(data){
    var array_data = JSON.parse(data) || [];
    $("table").bootstrapTable('load', array_data);
  });
  callback.fail(function(response){
    console.log('fail ', response);
  });
};

$("input#userId").on('DOMNodeInserted', function(e) {
  alert(JSON.stringify(e));
});

function fetchDataByCa(ca){
  return $.ajax({
    url: './api/datatable/fetch_history_bu.php?ca='+ca,
    method: 'POST',
    async: true,
    cache: false,
    processData: false,
    contentType: false			
  });
}