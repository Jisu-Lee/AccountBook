var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];
var category = document.getElementById('category');


function add() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

function setCategory(val){
  category.value = val;
}
