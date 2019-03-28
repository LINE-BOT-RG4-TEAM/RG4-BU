window.onload = function(e) {
  liff.init(function(data) {
    initializeApp(data);
  });
};

function initializeApp(data) {
  liff
    .getProfile()
    .then(function(profile) {
      $("#uIdInput").val(profile.userId);
      $("#profileImage").attr("src", profile.pictureUrl);
      $("#uNameInput").text(profile.displayName);
    })
    .catch(function(error) {
      window.alert("Error getting profile: " + error);
    });
}

$(function() {
  $("form").submit(function(event) {
    event.preventDefault();
    window.alert("submiting form");
    $.ajax({
      url: "api/update_line_infomation.php",
      method: "POST",
      data: $(this).serializeArray(),
      beforeSend: function() {
        window.alert("beforeSend alert");
      },
      success: function(response) {
        window.alert(JSON.stringify(response));
      },
      error: function() {
        window.alert("error");
      },
      complete: function() {
        window.alert("endding form");
      }
    });
  });
});
