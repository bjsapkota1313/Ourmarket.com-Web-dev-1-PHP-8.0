<?php
require __DIR__ . '/../Logic/ShoppingCart.php';
require __DIR__ . '/../Services/AdService.php';
require  __DIR__ . '/../Logic/LoggingInAndOut.php';
class PaymentController
{
    private $adService;

    public function __construct()
    {
        $this->adService = new AdService();
    }

    public function displayPaymentPage(): void
    {
        if ($_SESSION['countShoppingCartItems'] === 0 or !isset($_POST["buttonCheckOut"])) {
            header("Location: /home/shoppingCart");
            exit(); // preventing to open this page when nothing is there in cart
        } else {
            require __DIR__ . '/../Views/Payment/PaymentHeader.php';
            $this->checkOutShoppingCart();
            require __DIR__ . '/../Views/Footer.php';
            $this->loginAndSignout();
        }
    }
    private function checkOutShoppingCart(): void
    {
        if (isset($_POST["buttonCheckOut"])) {
            if ($this->checkShoppingCartItemsAvailabilityInDb()) {
                $total = getTotalAmountOfItemsInShoppingCart();
                $this->updateAdStatusToSold();
                clearShoppingCart(); // after payment
                require __DIR__ . '/../Views/Payment/paymentBody.php';
            } else {
                echo '<script>alert("Some the products in your shopping are not available, please shop again!")</script>';
                clearShoppingCart(); // after the items are not available to buy
                echo '<script>location.href = "/home/myAds"</script>';
            }
        }
    }
    private function updateAdStatusToSold(): void
    {
        $items = getItemsInShoppingCart();
        foreach ($items as $item) {
            $this->adService->markAdAsSold($item->getId());
        }
    }
    private function loginAndSignout(): void
    {
        if (!is_null(getLoggedUser())) {
            echo '<script>disableLoginButton();</script>';
        }
        if (isset($_POST["btnSignOut"])) {
            logOutFromApp();
            echo '<script>enableLogin()</script>';
        }
    }
    private function checkShoppingCartItemsAvailabilityInDb(): bool
    {
        $items = getItemsInShoppingCart(); // making sure that products in shopping cart are available to be sold
        foreach ($items as $item) {
            $dbAd = $this->adService->getAdByID($item->getId());
            if (!$dbAd->getStatus()->equals(Status::Available()) ) {
                return false;
            }
        }
        return true;
    }
}
