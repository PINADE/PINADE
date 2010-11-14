function loaded() {    
  updateOnlineStatus("load", false);
  document.body.addEventListener("offline", function () { updateOnlineStatus("offline", true) }, false);
  document.body.addEventListener("online", function () { updateOnlineStatus("online", true) }, false);
}


function updateOnlineStatus(msg, allowUpdate) {
  var status = document.getElementById("status");
  status.innerHTML = (navigator.onLine ? "[online]" : "[offline]");
}