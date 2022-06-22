var modal1 = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var button = document.getElementsByClassName("close-modal-message")[0];
btn.onclick = function() {
modal1.style.display = "block";
}
span.onclick = function() {
  modal1.style.display = "none";
}
button.onclick = function() {
  modal1.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal1.style.display = "none";
  }
}