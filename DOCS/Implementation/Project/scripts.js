function openForm() {
    document.getElementById("signIn").style.display = "block";
}
function openForm2() {
    document.getElementById("restSignUp").style.display = "block";
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
function closeBookingForm() { // close booking form pop up
    document.getElementById("bookingForm").style.display = "none";
}
function openBookingForm() { // booking form pop up
    document.getElementById("bookingForm").style.display = "block";
}
function bookingComplete() { //booking complete alert
    alert("YOUR RESERVATION IS COMPLETED. ENJOY YOUR MEAL :)");
}

function checkAll(checkId) { // check all checkboxes when checked ALL
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type === "checkbox" && inputs[i].id === checkId) {
            if (inputs[i].checked === true) {
                inputs[i].checked = false;
            } else if (inputs[i].checked === false) {
                inputs[i].checked = true;
            }
        }
    }
}

function dateConstraint() {
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("date")[0].setAttribute('min', today);
}

function openWindow() {
    header("location:returnHP.php");
}