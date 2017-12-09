var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];
var category = document.getElementById('category');
var modal_date = document.getElementById('date');

function add() {
  modal.style.display = "block";
  modal_date.value = getCurrentDate();
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

function getCurrentDate(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  if(dd<10) { dd = '0'+dd }
  if(mm<10) { mm = '0'+mm }
  return yyyy + "-" + mm + '-' + dd;
}
