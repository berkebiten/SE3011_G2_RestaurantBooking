function openForm() {
    document.getElementById("signIn").style.display = "block";
}
function openForm2() {
    document.getElementById("adminsearch").style.display = "block";
}
function openForm3() {
    document.getElementById("signUp").style.display = "block";
}
function openForm4() {
    document.getElementById("forgotpsw").style.display = "block";
    document.getElementById("signIn").style.display = "none";
}
function openAdminSearch() {
    document.getElementById("adminsearch").style.display = "block";
}
function closeAdminSearch() {
    document.getElementById("adminsearch").style.display = "none";
}

function closeForm() {
    document.getElementById("signIn").style.display = "none";
    document.getElementById("restSignUp").style.display = "none";
    document.getElementById("signUp").style.display = "none";
    document.getElementById("forgotpsw").style.display = "none";
    document.getElementById("adminsearch").style.display = "none";
}

var today = new Date().toISOString().split('T')[0];
document.getElementsByName("date")[0].setAttribute('min', today);

function openWindow() {
    header("location:returnHP.php");
}