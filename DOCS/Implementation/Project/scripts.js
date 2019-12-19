function openForm() {
    document.getElementById("signIn").style.display = "block";
}
function openForm2() {
    document.getElementById("restSignUp").style.display = "block";
}
function openForm3() {
    document.getElementById("signxp").style.display = "block";
}
function openForm4() {
    document.getElementById("forgotpsw").style.display = "block";
    document.getElementById("signIn").style.display = "none";
}
function openAdminSearch() {
    closeForm();
    document.getElementById("adminsearch").style.display = "block";
}
function openViewTickets() {
    closeForm();
    document.getElementById("viewTickets").style.display = "block";
}
function openBookings(){
    closeForm2();
    document.getElementById("viewBookings").style.display = "block";
}
function openRestSignUps(){
    closeForm3();
    document.getElementById("viewRestSignUps").style.display = "block";
}



function searchFilterFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("adminsearchinput");
    filter = input.value.toUpperCase();
    table = document.getElementById("adminSearchTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
function closeForm() {
    
    document.getElementById("adminsearch").style.display = "none";
    document.getElementById("viewTickets").style.display = "none";
}
function closeForm2(){
    document.getElementById("viewBookings").style.display = "none";
}

function closeForm3(){
    document.getElementById("viewRestSignUps").style.display = "none";
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

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}