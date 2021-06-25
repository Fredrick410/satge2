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