<script type="text/javascript">
function openProfil() {
  document.getElementById("overlay_profil").classList.toggle("show");
  document.getElementById("overlay_login").classList.remove("show");
}
function quitProfil() {
  document.getElementById("overlay_profil").classList.remove("show");
}
function openCart() {
  document.getElementById("overlay_cart").classList.toggle("show");
  document.getElementById("overlay_login").classList.remove("show");
  document.getElementById("overlay_signup").classList.remove("show");
}
function quitCart() {
  document.getElementById("overlay_cart").classList.remove("show");
}
function openLog() {
  document.getElementById("overlay_login").classList.toggle("show");
  document.getElementById("overlay_signup").classList.remove("show");
  document.getElementById("overlay_cart").classList.remove("show");
}
function quitLog() {
  document.getElementById("overlay_login").classList.remove("show");
}
function openSignup() {
  document.getElementById("overlay_signup").classList.toggle("show");
  document.getElementById("overlay_login").classList.remove("show");
  document.getElementById("overlay_cart").classList.remove("show");
}
function quitSignup() {
  document.getElementById("overlay_signup").classList.remove("show");
}
</script>
<script src="https://kit.fontawesome.com/d9a2e4a111.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
