<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Ads</title>
    <link rel="icon" type="image/x-icon" href="/img/logoooooIcon.svg">
    <link rel="stylesheet" href="/CSS/ShoppingCart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/22097c36aa.js" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-info p-3">
            <div class="container-fluid">
                <a class="navbar-brand"><img src="/img/Logo.svg" alt="BusinessLogo" width="200" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto ">
                        <li class="nav-item">
                            <a class="nav-link mx-2" aria-current="page" href="/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2 active" href="">My Ads</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto  d-lg-inline-flex">
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="/home/shoppingCart">
                                <i class="fa badge fa-lg" style="font-size:1.5em" value="<?= $_SESSION['countShoppingCartItems'] ?>">&#xf07a;</i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="White" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a id="loginLink" class="dropdown-item" href="/home/login">Login</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST">
                                        <button class="dropdown-item" name="btnSignOut" id="signOut" type="submit" value="Sign Out" disabled="true">Sign out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid px-3 py-2 my-2 text-center" style="background-color: aliceblue;">
        <h1 id="displayMessage" class="display-6 fw-semibold"><?= $displayMessage ?></h1>
        <div class="col-lg-6 mx-auto">
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center" id="buttonHolder">
                <!-- Button to Open the Modal -->
                <button id="buttonPostNewAd" type="button" class="btn btn-success btn-lg px-4 gap-3" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="fa-solid fa-pen-to-square"></i> Post New Ad
                </button>
            </div>
        </div>
    </div>

    <div>
        <?php if (!is_null($this->loggedUser)) { ?>
            <input type="hidden" id="hiddenLoggedUserId" value="<?= $this->loggedUser->getId() ?>">
            <input type="hidden" id="loggedUserName" value="<?= $this->loggedUser->getFirstName() ?>">
        <?php } ?>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="postNewAddForm">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Post</h4>
                        <button id="close" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="productName"><strong>Product Name</strong></label>
                            <input type="text" class="form-control" id="productName" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="image"><strong>Image</strong></label><br>
                            <input type="file" class="form-control-file" id="image" accept="image/png, image/jpeg,image/jpg" ondragover="allowDrop(event)" ondrop="dropFile(event)" required style="   .dragover {border: 2px dashed #000;}">
                        </div>
                        <div class="form-group">
                            <label for="price"><strong>Price</strong></label>
                            <input type="number" class="form-control" id="price" placeholder="Set Your Product Price" required>
                        </div>
                        <div class="form-group">
                            <label for="productDescription"><strong>Product Description</strong></label>
                            <textarea class="form-control" id="productDescription" rows="3" placeholder="Describe about your product like how long it is used for,what's the brand of the product" required></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetPostNewAddForm()">Cancel
                        </button>
                        <button type="submit" class="btn btn-success" id="btnPostNewAdd" onclick="postNewAdd()">Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>