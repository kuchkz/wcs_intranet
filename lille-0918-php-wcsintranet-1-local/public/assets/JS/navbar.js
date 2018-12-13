// Get the container element
var container = document.getElementById("navBarre");

// Get all buttons with class="btn" inside the container
var lis = container.getElementsByClassName("nav-item");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < lis.length; i++) {
    lis[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");

        // If there's no active class
        if (current.length > 0) {
            current[0].className = current[0].className.replace(" active", "");
        }

        // Add the active class to the current/clicked button
        this.className += " active";
    });
}
// Add Timer header function.
let date = document.querySelector(".date");
setInterval(function(){
    let d = new Date();

    d=d.toLocaleDateString()+'  '+d.toLocaleTimeString()+'';
    date.textContent=d;

}, 1000);

