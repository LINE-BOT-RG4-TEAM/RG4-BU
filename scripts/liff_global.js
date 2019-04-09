window.onload = function(e) {
  liff.init(function(data) {
    initializeUserId(data);
  });
};

function initializeUserId(data) {
  var input = document.createElement("input");
  input.setAttribute("type", "hidden");
  input.setAttribute("name", "userId");
  input.setAttribute("id", "userId");
  input.setAttribute("value", data.context.userId);
  document.getElementsByTagName("body")[0].append(input);
  window.alert("created element successfully: " + $("#userId").val());
  // document.getElementById("languagefield").textContent = data.language;
  // document.getElementById("viewtypefield").textContent = data.context.viewType;
  // document.getElementById("useridfield").textContent = data.context.userId;
  // document.getElementById("utouidfield").textContent = data.context.utouId;
  // document.getElementById("roomidfield").textContent = data.context.roomId;
  // document.getElementById("groupidfield").textContent = data.context.groupId;
  quantity_service();
}

