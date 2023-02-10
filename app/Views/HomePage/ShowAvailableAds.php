<div class="container">
    <div class="row py-3 text-center" id="containerRowContainerAvailableAds">
        <?php
        foreach ($ads
            as $ad) {
        ?>
            <div class="col-md-4 col-sm-12 col-xl-3 my-3">
                <div class="card h-100 shadow">
                    <img src="<?= $ad->getImageUri() ?>" class="img-fluid card-img-top" alt="<?= $ad->getProductName() ?>" style="width:300px; height:300px">
                    <div class="card-body">
                        <h3 class="card-title"><?= $ad->getProductName() ?></h3>
                        <p class="card-text"><?= $ad->getDescription() ?></p>
                        <button id="AddToCart" class="btn btn-primary position-relative" type="submit" onclick="addToCartClicked(<?= $ad->getId() ?>)"><i class="fa-solid fa-cart-plus"></i>
                            €<?= number_format($ad->getPrice(), 2, '.') ?> </button>
                    </div>
                    <div class="card-footer ">
                        <p class="card-text"><small class="text-muted"><?= $ad->getPostedDate() ?> posted by
                            </small> <strong><?= $ad->getUser()->getFirstName() ?></strong></p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>