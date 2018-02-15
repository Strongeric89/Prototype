function like(el){

  var text = el.innerHTML;

  if(text == 'LIKE'){
      el.innerHTML = 'UNLIKE';
  }else{
      el.innerHTML = 'LIKE';
  }
  alert('you clicked like, the like count will be incremented and profile pic added');

}


function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    //alert("dropped");
    ev.target.appendChild(document.getElementById(data));

}
