
function LINEProfileDisplayFormatter(userId, row, index){
    return [
        "<div class='text-center'>",
        "<img class='w-75 rounded-circle' alt='"+row['displayName']+"' src='"+row['pictureUrl']+"' />",
        "<p class='font-weight-bold'>"+row['displayName']+"</p>",
        "</div>"
    ].join("");
}