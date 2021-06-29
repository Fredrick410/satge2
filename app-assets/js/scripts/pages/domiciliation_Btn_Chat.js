function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("icon_chat").style.display = "none";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("icon_chat").style.display = "block";
}

function updateScroll(){
  var element = document.getElementById("historique");
  element.scrollTop = element.scrollHeight;
}

function notif(){
  const notification_crea = '0';
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open('POST', '../../../../html/ltr/coqpix/php/chat_notif.php');
  requeteAjax.send(notification_crea);
}