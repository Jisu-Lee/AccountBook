var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];
var category = document.getElementById('category');
var modal_date = document.getElementById('date');

function add(day) {
  modal.style.display = "block";
  modal_date.value = getFormattedDate(day);
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

function getFormattedDate(day){
  var today = new Date();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();
  var dd = day.toString();

  if(dd<10) { dd = '0'+dd }
  if(mm<10) { mm = '0'+mm }
  return yyyy + "-" + mm + '-' + dd;
}
