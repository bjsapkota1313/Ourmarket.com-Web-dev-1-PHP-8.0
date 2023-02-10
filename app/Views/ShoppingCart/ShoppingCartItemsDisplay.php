<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col">
                                <h5 class="mb-3"><a href="/home" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <h3 class="mb-1">Shopping cart</h3>
                                        <p class="mb-0">You have <?= $_SESSION['countShoppingCartItems'] ?> items in
                                            your cart</p>
                                    </div>
                                </div>
                                <?php foreach ($_SESSION['cartItems'] as $result) {
                                    $ad = unserialize(serialize($result)); ?>
                                    <div class="card mb-3 ">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="<?= $ad->getImageUri() ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5> <?= htmlspecialchars_decode($ad->getProductName()) ?></h5>
                                                        <p class="card-text small mb-0"><small class="text-muted"><?= $ad->getPostedDate() ?>
                                                                posted by
                                                            </small>
                                                            <strong><?= $ad->getUser()->getFirstName() ?></strong>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 80px;">
                                                        <p class="mb-0">
                                                            <strong>€<?= htmlspecialchars_decode(number_format($ad->getPrice(), 2, '.')) ?></strong>
                                                        </p>
                                                    </div>
                                                    <form method="POST">
                                                        <input type="hidden" name="hiddenSHoppingCartItemID" value="<?= $ad->getId() ?>>">
                                                        <button name="removeCartItem" type="submit" style=" border:none; background-color: transparent; color: #cecece;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <hr class="my-4">
                                <div class="card-footer">
                                    <div class="d-flex d-md-flex justify-content-between">
                                        <p class="mb-2"><strong>VAT Amount (21%)</strong></p>
                                        <p class="mb-2">
                                            €<?= htmlspecialchars_decode(number_format($this->vatAmount, 2, '.')) ?></p>
                                    </div>
                                    <div class="d-flex d-md-flex justify-content-between">
                                        <p class="mb-2"><strong>Delivery Fee</strong></p>
                                        <p class="mb-2">€0.00</p>
                                    </div>

                                    <div class="d-flex d-md-flex justify-content-between mb-4">
                                        <p class="mb-2"><strong>Total (Incl. taxes)</strong></p>
                                        <p class="mb-2">
                                            €<?= htmlspecialchars_decode(number_format($this->total, 2, '.')) ?></p>
                                    </div>
                                    <form method="POST" action="/home/shoppingCart/payment">
                                        <button name="buttonCheckOut" type="submit" class="btn  btn-block btn-lg d-sm-block float-right" style="float: right !important; background-color:#00ff00;">
                                            <div class="d-flex">
                                                <span>Checkout € <strong><?= htmlspecialchars_decode(number_format($this->total, 2, '.')) ?></strong><i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>