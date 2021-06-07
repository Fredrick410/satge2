function buttonc() {

  var submit = document.getElementById('subbt').value;
  document.getElementById('subbt').type = "submit";
  document.getElementById('subbt').value = submit;

  var hidden = document.getElementById('button_save').value;
  document.getElementById('button_save').type = "hidden";
  document.getElementById('button_save').value = hidden;

}
