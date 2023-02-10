function validate(input){
    let regex = /[^a-zA-Z\s]/;
    if(regex.test(input.value)) {
        input.classList.add("invalid");
        document.getElementById("btnRegister").disabled=true;
    } else {
        input.classList.remove("invalid");
        document.getElementById("btnRegister").disabled=false;
    }
}
function confirmRepeatedPassword(inputField){
    if(inputField.value.length>=8 | inputField.value.length>0){
        if(inputField.value!==document.getElementById("password").value)
        {
            document.getElementById("feedback-invalid").innerText="Your repeated password must same";
            document.getElementById("feedback-invalid").style.color="red";
            document.getElementById("btnRegister").disabled=true;
            inputField.classList.add("invalid");
        }else{
            inputField.classList.remove("invalid");
            document.getElementById("feedback-invalid").innerText="";
            document.getElementById("btnRegister").disabled=false;
        }
    }
    else{
        inputField.classList.remove("invalid");
        document.getElementById("feedback-invalid").innerText="";
        document.getElementById("btnRegister").disabled=false;
    }
}
function verifyPasswordLength(inputField){
    if(inputField.value.length<=8 && inputField.value.length>0) {
        document.getElementById("feedback-invalid-pass").innerText = "You must enter 8 character long password";
        document.getElementById("feedback-invalid-pass").style.color = "red";
        inputField.classList.add("invalid");
        document.getElementById("btnRegister").disabled=true;
    }
    else{
        inputField.classList.remove("invalid");
        document.getElementById("feedback-invalid-pass").innerText="";
        document.getElementById("btnRegister").disabled=false;
    }
}
function displayModalForSignUp(title,message){

    let buttonName,href;
    if(title=="ooooooops!")
    {
         buttonName ='Try again';
         href="/home/login/signup";
    }
    else{
         buttonName ='Login';
         href="/home/login";
    }
// Create the modal
    let modal = document.createElement("div");
    modal.classList.add("modal", "fade");
    modal.id = "myModal";
    modal.setAttribute("tabindex", "-1");
    modal.setAttribute("role", "dialog");
    modal.setAttribute("aria-labelledby", "myModalLabel");
    modal.setAttribute("aria-hidden", "true");
    document.body.appendChild(modal);

// Create the modal dialog
    let modalDialog = document.createElement("div");
    modalDialog.classList.add("modal-dialog");
    modalDialog.setAttribute("role", "document");
    modal.appendChild(modalDialog);

// Create the modal content
    let modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");
    modalDialog.appendChild(modalContent);

// Create the modal header
    let modalHeader = document.createElement("div");
    modalHeader.classList.add("modal-header");
    modalContent.appendChild(modalHeader);

// Create the modal title
    let modalTitle = document.createElement("h5");
    modalTitle.classList.add("modal-title");
    modalTitle.innerText = title;
    modalTitle.id = "myModalLabel";
    modalHeader.appendChild(modalTitle);

// Create the modal close button
    let modalCloseBtn = document.createElement("button");
    modalCloseBtn.type = "button";
    modalCloseBtn.classList.add("btn-close");
    modalCloseBtn.setAttribute("data-bs-dismiss", "modal");
    modalCloseBtn.setAttribute("aria-label", "Close");
    modalCloseBtn.addEventListener("click", function() {
        window.location.href = href;
    });
    modalHeader.appendChild(modalCloseBtn);

// Create the modal body
    let modalBody = document.createElement("div");
    modalBody.classList.add("modal-body");
    modalBody.innerText = message;
    modalContent.appendChild(modalBody);

// Create the modal footer
    let modalFooter = document.createElement("div");
    modalFooter.classList.add("modal-footer");
    modalContent.appendChild(modalFooter);

// Create the modal close button
    let modalCloseBtn2 = document.createElement("button");
    modalCloseBtn2.type = "button";
    modalCloseBtn2.classList.add("btn", "btn-primary");
    modalCloseBtn2.innerText = buttonName;
    modalCloseBtn2.setAttribute("data-bs-dismiss", "modal");
    modalFooter.appendChild(modalCloseBtn2);
    modalCloseBtn2.addEventListener("click", function() {
        window.location.href = href;
    });

    let modalBtn = document.createElement("button");
    modalBtn.type = "button";
    modalBtn.hidden=true;
    modalBtn.classList.add("btn", "btn-primary");
    modalBtn.innerText = "Open Modal";
    modalBtn.setAttribute("data-bs-toggle", "modal");
    modalBtn.setAttribute("data-bs-target", "#myModal");
    document.body.appendChild(modalBtn);
    modalBtn.click();

    
}