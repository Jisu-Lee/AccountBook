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


function hide_and_show_func(){
  var x = document.getElementById("hide_and_show_budget");
    if (x.style.display === "none") {
        x.style.display = "block";
        x.style.display = "inline-block";
    } else {
        x.style.display = "none";
    }
}
