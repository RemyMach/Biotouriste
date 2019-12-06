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
function openLogin() {
  document.getElementById("overlay_login").classList.toggle("show");
  document.getElementById("overlay_signup").classList.remove("show");
  document.getElementById("overlay_cart").classList.remove("show");
}
function quitLogin() {
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
