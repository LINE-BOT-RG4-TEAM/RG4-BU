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

function viewPRFormatter(value, row, index) {
    return [
        '<div class="text-center">',
        '<a href="javascript:void(0);" class="btn btn-sm btn-outline-primary view-pr-detail">',
        '<i class="far fa-eye"></i> รายละเอียด<br/>ใบเสนอความต้องการ',
        '</a>',
        '</div>'
    ].join("");
}

function LINEProfileDisplayFormatter(userId, row, index){
    return [
        "<div class='text-center'>",
        "<img class='w-75 rounded-circle' alt='"+row['displayName']+"' src='"+row['pictureUrl']+"' />",
        "<p class='font-weight-bold'>"+row['displayName']+"</p>",
        "</div>"
    ].join("");
}

window.viewPRDetailEvents = {
    'click .view-pr-detail': function (e, value, row, index) {
        // alert('You click like action, row: ' + JSON.stringify(row));
        window.location.href = "?action=monitor_pr_detail&purchase_id="+row["PURCHASE_ID"]+"&pictureUrl="+row["pictureUrl"]+"&displayName="+row["displayName"];
    }
};

$(function(){
    // trigger when data table load success
    $("table").on("load-success.bs.table", function(){
        $("tr.groupBy")
        .css({
            "font-wegiht": "bold",
            "font-size": "24px"
        })
        .addClass("p-2 bg-light text-primary font-weight-bold");
        $("tr.groupBy > td").addClass("animated fadeInLeft");
    })
});