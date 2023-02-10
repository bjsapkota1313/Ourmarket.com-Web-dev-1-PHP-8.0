
function disableLoginButton() {
    const loginLink = document.getElementById("loginLink");
    const p = document.createElement("p");
    p.className = "dropdown-item";
    p.innerHTML = "Logged";
    const loginLinkId = loginLink.getAttribute("id");

    // Set the id of the p element to be the same as the loginLink element
    p.setAttribute("id", loginLinkId);
    loginLink.parentNode.replaceChild(p, loginLink);
    document.getElementById("signOut").disabled = false;
}

function enableLogin() {
    document.getElementById("signOut").disabled = true;
    const p = document.getElementById("loginLink");
    const a = document.createElement("a");
    a.className = "dropdown-item";
    a.innerHTML = "Log In";
    a.href = "/home/login";
    const loginLinkId = p.getAttribute("id");
    a.setAttribute("id", loginLinkId);
    p.parentNode.replaceChild(a, p);

}

function resetPostNewAddForm() {
    // Reset form elements
    document.querySelector('#postNewAddForm').reset();
}

function hidePostNewAd() {
    document.getElementById("buttonPostNewAd").hidden = true;
    const divCol = document.getElementById("buttonHolder");
    const a = document.createElement("a");
    a.href = "login";
    a.className = "btn btn-success btn-lg px-4 gap-3";
    a.innerHTML = "Log In";
    divCol.appendChild(a);

}

function showPostNewAd() {
    document.getElementById("buttonPostNewAd").hidden = false;
}

function postNewAdd() {
    const inputLoggedUserId = document.getElementById("hiddenLoggedUserId").value;
    const inputLoggedUserName = document.getElementById("loggedUserName").value;
    const inputProductName = document.getElementById("productName").value;
    const inputPrice = document.getElementById("price").value;
    const inputProductDescription = document.getElementById("productDescription").value;
    const imageInput = document.getElementById("image").files[0];

    // Validate the form
    if (!validateForm(inputProductName, inputPrice, inputProductDescription, imageInput)) {
        return;
    }
    const data = {
        productName: inputProductName,
        price: inputPrice,
        productDescription: inputProductDescription,
        loggedUserId: inputLoggedUserId,
        loggedUserName: inputLoggedUserName
    };
    let formData = new FormData();
    formData.append("image", imageInput);
    formData.append("adDetails", JSON.stringify(data));
    sendRequestForInsertingAd(formData);
}

function sendRequestForInsertingAd(formData) {
    //  e.preventDefault to see the differences
    event.preventDefault()
    // Send a POST request to the server with the form data
    fetch('http://localhost/api/adsapi', {
        method: 'POST',
        body: formData,
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (responseData) {
            if (responseData.success) {
                document.getElementById("close").click();
                resetPostNewAddForm();  // clearing the fields of the form
                loadAdsOfLoggedUser();
            } else {
                alert(responseData.message);
            }
         }) .catch(err => console.error(err));
}
function createHorizontalAdCard(ad) {
    // Create the main card element
    let card = document.createElement("div");
    card.classList.add("card", "mb-3");
    card.style.maxWidth = "900px";
    card.style.position = "relative";

    // Create the inner row element
    let row = document.createElement("div");
    row.classList.add("row", "g-0");
    card.appendChild(row);

    // Create the image column element
    let imageCol = document.createElement("div");
    imageCol.classList.add("col-md-4", "col-xl-4");
    row.appendChild(imageCol);

    // Create the image element
    let image = document.createElement("img");
    image.src = ad.imageUri;
    image.classList.add("img-fluid", "rounded-start");
    imageCol.appendChild(image);

    // Create the details column element
    let detailsCol = document.createElement("div");
    detailsCol.classList.add("col-md-8", "col-xl-8", "d-flex", "flex-column", "justify-content-around");
    row.appendChild(detailsCol);

    // Create the details body element
    let detailsBody = document.createElement("div");
    detailsBody.classList.add("card-body");
    detailsCol.appendChild(detailsBody);

    // Create the product name element
    let productName = document.createElement("h5");
    productName.classList.add("card-title");
    productName.textContent = ad.productName;
    detailsBody.appendChild(productName);

    // Create the product description element
    let productDescription = document.createElement("p");
    productDescription.classList.add("card-text");
    productDescription.textContent = ad.description;
    detailsBody.appendChild(productDescription);

    // Create the list group element
    let listGroup = document.createElement("ul");
    listGroup.classList.add("list-group", "list-group-flush");
    detailsBody.appendChild(listGroup);

    // Create the price list item element
    let priceListItem = document.createElement("li");
    priceListItem.classList.add("list-group-item");
    priceListItem.innerHTML = '<strong>Price:</strong> €' + formatPricesInDecimal(ad.price);
    listGroup.appendChild(priceListItem);

    // Create the status list item element
    let statusListItem = document.createElement("li");
    statusListItem.classList.add("list-group-item");
    statusListItem.innerHTML = '<strong>Status:</strong> ' + ad.status;
    listGroup.appendChild(statusListItem);

    // Create the posted date list item element
    let postedDateListItem = document.createElement("li");
    postedDateListItem.classList.add("list-group-item");
    postedDateListItem.innerHTML = '<strong>Posted at: </strong>' + ad.postedDate;
    listGroup.appendChild(postedDateListItem);

    // Create the button container element
    let buttonContainer = document.createElement("div");
    buttonContainer.classList.add("d-flex", "justify-content-end", "mb-2");
    detailsCol.appendChild(buttonContainer);

    return [card, buttonContainer];
}
function loadAdsOfLoggedUser() {
    const inputLoggedUserId = document.getElementById("hiddenLoggedUserId").value;
    let data = { loggedUserId: inputLoggedUserId }
    // Send a POST request to the server with logged user and promising the ads as response of logged user
    fetch('http://localhost/api/adsbyloggeduser', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
        .then(ads => {
            clearScreen();// clearing screen
            // Handling the ads data here
            ads.forEach(function (ad) {
                if (ad.status === "Available") {
                    displayAvailableAds(ad);
                } else {
                    displayOtherStatusAds(ad);
                }
            })
        }).catch(err => console.error(err));
}

function validateForm(productName, price, description, image) {
    if (!productName) {
        alert('Please enter a product name');
        return false;
    }

    if (!price) {
        alert('Please enter a price');
        return false;
    }

    if (!description) {
        alert('Please enter a product description');
        return false;
    }

    if (!image) {
        alert('Please select an image');
        return false;
    }
    else if (!checkUploadedFile(image)) {
        return false;
    }
    return true;
}
function checkUploadedFile(image) {
    var fileType = image.type;
    var validImageTypes = ["image/jpg", "image/jpeg", "image/png"];

    if (validImageTypes.indexOf(fileType) < 0) {
        alert("Invalid file type. Please select an image file (jpg, jpeg, png)");
        return false;
    }
    return true;
}
function allowDrop(event) {
    // Prevent default behavior of the event (prevent the file from being opened)
    event.preventDefault();
}

function dropFile(event) {
    // Get the file object that was dropped
    const file = event.dataTransfer.files[0];
    // Set the file object as the value of the file input element
    document.getElementById("image").files[0] = file;
}

function displayOtherStatusAds(ad) {
    const myAdsContainer = document.getElementById("myAdsContainer");
    let requireElements = createHorizontalAdCard(ad);
    let card = requireElements[0];
    let buttonContainer = requireElements[1];

    // Create the "Mark As Sold" button element
    const markAsSoldButton = document.createElement("button");
    markAsSoldButton.classList.add("btn", "btn-primary", "mx-2");
    markAsSoldButton.disabled = true;
    markAsSoldButton.textContent = "Mark As Sold";
    buttonContainer.appendChild(markAsSoldButton);

    // Create the "Edit" button element
    const editButton = document.createElement("button");
    editButton.classList.add("btn", "btn-secondary", "mx-2");
    editButton.disabled = true;
    editButton.innerHTML = '<i class="fa-solid fa-file-pen"></i> Edit';
    buttonContainer.appendChild(editButton);

    // Create the "Delete" button element
    const deleteButton = document.createElement("button");
    deleteButton.classList.add("btn", "btn-danger", "mx-2");
    deleteButton.disabled = true;
    deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i> Delete';
    buttonContainer.appendChild(deleteButton);

    // Create the overlay element
    const overlay = document.createElement("div");
    overlay.classList.add("overlay");
    overlay.style.position = "absolute";
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.right = 0;
    overlay.style.bottom = 0;
    overlay.style.backgroundColor = "rgba(0,0,0,0.5)";
    overlay.style.display = "flex";
    overlay.style.alignItems = "center";
    overlay.style.justifyContent = "center";
    card.appendChild(overlay);


    // Create the status element
    let status = document.createElement("h2");
    status.style.color = "white";
    status.textContent = ad.status;
    overlay.appendChild(status);
    myAdsContainer.appendChild(card);
}

function displayAvailableAds(ad) {
    const myAdsContainer = document.getElementById("myAdsContainer");
    let requireElements = createHorizontalAdCard(ad);
    let card = requireElements[0];
    let buttonContainer = requireElements[1];

    // button Mark as Sold
    let btnMarkAsSold = document.createElement('button');
    btnMarkAsSold.className = "btn btn-primary mx-2";
    btnMarkAsSold.innerHTML = "Mark As Sold";
    btnMarkAsSold.addEventListener('click', function () {
        btnMarkAsSoldClicked(ad.id);
    });
    buttonContainer.appendChild(btnMarkAsSold);

    // button Edit
    const editButton = document.createElement('button');
    editButton.classList.add('btn', 'btn-secondary', 'mx-2');
    editButton.setAttribute('data-bs-toggle', 'modal');
    editButton.setAttribute('data-bs-target', '#editModal');
    editButton.addEventListener('click', () => {
        editAdButtonClicked(
            ad.id, ad.imageUri, ad.productName, ad.description, ad.price,
        );
    });
    const icon = document.createElement('i');
    icon.classList.add('fa-solid', 'fa-file-pen');
    editButton.appendChild(icon);
    editButton.appendChild(document.createTextNode(' Edit'));

    buttonContainer.appendChild(editButton);

    //button Delete
    let btnDeleteAd = document.createElement('button');
    btnDeleteAd.className = "btn btn-danger mx-2";
    btnDeleteAd.innerHTML = '<i class="fa-solid fa-trash"></i> Delete';
    btnDeleteAd.addEventListener('click', function () {
        btnDeleteAdClicked(ad.id, ad.imageUri);
    });
    buttonContainer.appendChild(btnDeleteAd);
    myAdsContainer.appendChild(card);

}

function btnMarkAsSoldClicked(adId) {
    event.preventDefault();
    sendUpdateRequestToAPi("ChangeStatusOfAd", adId, "");
}

function btnDeleteAdClicked(adId, image) {
    event.preventDefault();
    sendUpdateRequestToAPi("DeleteAd", adId, image,);

}

function sendUpdateRequestToAPi(typeOfOperation, adID, image) {
    let data = { OperationType: typeOfOperation, adID: adID, imageURI: image };

    // Send a POST request to the server with logged user and promising the response message
    fetch('http://localhost/api/updateAd', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
        .then(response => {
            if (response.success) {
                loadAdsOfLoggedUser(); /// when ever ads are deleted or marked as sold ads are loaded
            } else {
                alert(response.message);
            }
        }).catch(err => console.error(err));
}

function clearScreen() {
    document.getElementById("myAdsContainer").innerHTML = ""; // clearing screen
}

function loginMessageForSignOut() {
    document.getElementById("displayMessage").innerText = "Please,login in order to view,edit or post an Ad"; // changing the message when logged in
}
function editAdButtonClicked(adID, adImage, adProductName, adDescription, adPrice) {
    clearEveryInputInEditModel();
    setValuesForEditModel(adID, adImage, adProductName, adDescription.replace(/\\/g, ""), adPrice); // removing slash sent by php addslashesMethod
}

function clearEveryInputInEditModel() {
    document.getElementById("hiddenAdIdEditAdModal").value = "";
    document.getElementById("AdEditProductName").value = "";
    document.getElementById("AdEditPrice").value = "";
    document.getElementById("AdEditDescription").value = "";
    document.getElementById("AdEditImageURI").src = "";
    document.getElementById("AdEditImageInput").value = ""; // resetting the previous value in file select
}

function setValuesForEditModel(adId, adImage, adProductName, adDescription, adPrice) {
    document.getElementById("hiddenAdIdEditAdModal").value = (adId);
    document.getElementById("AdEditProductName").value = adProductName;
    document.getElementById("AdEditPrice").value = adPrice;
    document.getElementById("AdEditDescription").value = adDescription;
    document.getElementById("AdEditImageURI").src = adImage;
}

function previewImage(input) {
    if (!checkUploadedFile(input.files[0])) {
        return;
    }
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('AdEditImageURI').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

async function editAdModalSaveChangeButtonClicked() {
    let adId =document.getElementById("hiddenAdIdEditAdModal").value;
    let adProductName = document.getElementById("AdEditProductName").value;
    let adProductPrice = document.getElementById("AdEditPrice").value;
    let adDescription = document.getElementById("AdEditDescription").value;
    let inputImageElement = document.getElementById("AdEditImageInput");
    let inputImage = inputImageElement.files[0];
    if (!inputImage) {
        inputImage = await getImageFileUsingPath();
    }
    if (!validateForm(adProductName, adProductPrice, adDescription, inputImage)) {
        return;
    }

    const data = {
        productName: adProductName,
        price: adProductPrice,
        productDescription: adDescription,
        adId: adId,
    };
    let formData = new FormData();
    formData.append("inputImage", inputImage);
    formData.append("editedAdDetails", JSON.stringify(data))
    sendEditRequestToAPI(formData);

}

function sendEditRequestToAPI(formData) {
    fetch('http://localhost/api/editAd', {
        method: 'POST',
        body: formData,
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (responseData) {
            if (responseData.success) {
                document.getElementById("buttonCloseEditModal").click();
                loadAdsOfLoggedUser();
            } else {
                alert(responseData.message);
            }
        }).catch(err => console.error(err));
}

function getImageFileUsingPath() {
    let imgElement = document.getElementById('AdEditImageURI');
    let imgSrc = imgElement.src;
    // taking the current previewing image src and sending this data if user does not select image
    return fetch(imgSrc)
        .then(response => response.blob())
        .then(blob => {
            let fileName = imgSrc.substring(imgSrc.lastIndexOf('/') + 1);
            let fileType = blob.type;
            // taking the file type from blob and passing filetype as argument while creating File
            // Create a new File object
            let file = new File([blob], fileName, { type: fileType });
            return file;
        }).catch(err => console.error(err));

}

function onInputValueChangeForSearch(input) {
    let productName = input.value;
    fetch("http://localhost/api/searchproducts?name=" + productName)
        .then(response => response.json())
        .then(ads => {
            document.getElementById("containerRowContainerAvailableAds").innerHTML = ""; // clearing first
            if (Object.keys(ads).length !== 0) {
                ads.forEach(function (ad) {
                    showAvailableAdsForHomePage(ad);
                })
            }
            else {
                resultNotFoundForSearchMessage(input.value);
            }
        });

}
function resultNotFoundForSearchMessage(inputValue) {
    let errorMessage = document.createElement("h2");
    errorMessage.innerHTML = "🤷 Sorry, no search result found for " + '"' + inputValue + '"' + " 🙁";
    document.getElementById("containerRowContainerAvailableAds").appendChild(errorMessage);

}
function showAvailableAdsForHomePage(ad) {
    let col = document.createElement("div");
    col.classList.add("col-md-4", "col-sm-12", "col-xl-3", "my-3");

    let card = document.createElement("div");
    card.classList.add("card", "h-100", "shadow");

    let img = document.createElement("img");
    img.src = ad.imageUri;
    img.classList.add("img-fluid", "card-img-top");
    img.alt = ad.productName;
    img.style.width = "300px";
    img.style.height = "300px";

    let cardBody = document.createElement("div");
    cardBody.classList.add("card-body");

    let h3 = document.createElement("h3");
    h3.classList.add("card-title");
    h3.textContent = ad.productName;

    let p = document.createElement("p");
    p.classList.add("card-text");
    p.textContent = ad.description;

    let button = document.createElement("button");
    button.classList.add("btn", "btn-primary", "position-relative");
    button.type = "submit";
    button.innerHTML = "<i class='fa-solid fa-cart-plus'></i> €" + formatPricesInDecimal(ad.price);
    // add event listener to button
    button.addEventListener("click", function () {
        addToCartClicked(ad.id);
    });

    let cardFooter = document.createElement("div");
    cardFooter.classList.add("card-footer");

    let pFooter = document.createElement("p");
    pFooter.classList.add("card-text");

    let small = document.createElement("small");
    small.classList.add("text-muted");
    small.textContent = ad.postedDate + " posted by";

    let strong = document.createElement("strong");
    strong.textContent = ad.user.firstName;

    pFooter.appendChild(small);
    small.appendChild(strong);
    cardBody.appendChild(h3);
    cardBody.appendChild(p);
    cardBody.appendChild(button);
    cardFooter.appendChild(pFooter);
    card.appendChild(img);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);
    col.appendChild(card);

    // Append col to the parent element
    document.getElementById("containerRowContainerAvailableAds").appendChild(col);

}
function addToCartClicked(adID) {
    // Create a form element
    let form = document.createElement("form");
    form.method = "post";
    form.action = "/home/shoppingCart";
    // Create a hidden input field to store the data

    let input = document.createElement("input");
    input.type = "hidden";
    input.name = "AdID";
    input.value = adID;
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}
function formatPricesInDecimal(price){
    let formattedPrice = new Intl.NumberFormat('en-US', {
        style: 'decimal',
        useGrouping: true,
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(price);
    return formattedPrice;
}
