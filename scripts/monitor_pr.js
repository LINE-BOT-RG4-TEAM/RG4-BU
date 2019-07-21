function textCenterFormatter(value, row, index){
    return [
        "<div class='text-center'>",
        value,
        "</div>"
    ].join("");
}

function textCenterAndWorkSuffixFormatter(value, row, index){
    return [
        "<div class='text-center'>",
        value,
        " บริการ",
        "</div>"
    ].join("");
}

function LINEProfileDisplayFormatter(userId, row, index){
    $.ajax({
        url: 'https://api.line.me/v2/bot/profile/'+userId,
        method: "get",
        headers: {
            "Authorization": 'Bearer <?=getenv("LINE_CHANNEL_ACCESS_TOKEN")?>'
        },
        success: function(response){
            console.log('response', response);
        },
        error: function(error){
            console.log('error', error);
        }
    });
}

$(function(){
    // trigger when data table load success
    $("table").on("load-success.bs.table", function(){
        $("tr.groupBy")
        .css({
            "font-wegiht": "bold",
            "font-size": "24px"
        })
        .addClass("p-2 animated fadeInUp bg-light text-primary font-weight-bold");
    })
});