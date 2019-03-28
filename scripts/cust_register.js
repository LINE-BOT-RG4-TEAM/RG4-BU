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
      $("#uNameInput").val(profile.displayName);
    })
    .catch(function(error) {
      window.alert("Error getting profile: " + error);
    });
}
