
function showLoginFailed() {
    const currentDiv = document.getElementById("passwordDiv");
    var newDiv = document.createElement("div");
    newDiv.className = "alert-danger pb-3";
    newDiv.style.color = "red";
    newDiv.innerHTML = "Please check you login credentials and Try again!";
    currentDiv.appendChild(newDiv);
}

