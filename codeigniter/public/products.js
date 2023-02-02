//products
document.getElementById("gasClick").onclick = function(){
  if(document.getElementById("gasClick").checked == true){
    document.getElementById("gasSubCategorie").setAttribute("style","display:block");
    var gasItems = document.getElementsByClassName('gas');
    for(i = 0; i < gasItems.length; i++){
        gasItems[i].checked = true;
    }
  } else {
    var gasItems = document.getElementsByClassName('gas');
    for(i = 0; i < gasItems.length; i++){
        gasItems[i].checked = false;
    }
    document.getElementById("gasSubCategorie").setAttribute("style","display:none");
  }
}

document.getElementById("woodClick").onclick = function(){
  if(document.getElementById("woodClick").checked == true){
    var gasItems = document.getElementsByClassName('wood');
    for(i = 0; i < gasItems.length; i++){
        gasItems[i].checked = true;
    }
    document.getElementById("woodSubCategorie").setAttribute("style","display:block");
  } else {
    var gasItems = document.getElementsByClassName('wood');
    for(i = 0; i < gasItems.length; i++){
        gasItems[i].checked = false;
    }
    document.getElementById("woodSubCategorie").setAttribute("style","display:none");
  }
}

document.getElementById("oilClick").onclick = function(){
  if(document.getElementById("oilClick").checked == true){
    var gasItems = document.getElementsByClassName('oil');
    for(i = 0; i < gasItems.length; i++){
        gasItems[i].checked = true;
    }
    document.getElementById("oilSubCategorie").setAttribute("style","display:block");
  } else {
    var gasItems = document.getElementsByClassName('oil');
    for(i = 0; i < gasItems.length; i++){
        gasItems[i].checked = false;
    }
    document.getElementById("oilSubCategorie").setAttribute("style","display:none");
  }
}

