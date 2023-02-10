<?php
require __DIR__ . '/../Services/AdService.php';
require __DIR__ . '/../Logic/ShoppingCart.php';
require __DIR__ . '/../Logic/LoggingInAndOut.php';
class ShoppingCartController
{
    private $adService;
    private $total;
    private $vatAmount;
    const Vat_Rate = 0.21;

    public function __construct()
    {
        $this->adService = new AdService();
    }

    public function displayShoppingCartPage(): void
    {
        $this->addItemToCart();
        $this->removeItemFromCart();
        require __DIR__ . '/../Views/ShoppingCart/shoppingCartHeader.php';
        $this->checkCartItemsAndDisplayAccordingly();
        require __DIR__ . '/../Views/Footer.php';
        $this->loginAndSignout();
    }
    private function checkCartItemsAndDisplayAccordingly(): void
    {
        if ($_SESSION['countShoppingCartItems'] === 0) {
            require __DIR__ . '/../Views/ShoppingCart/ShoppingCartEmpty.htm';
        } else {
            $this->total = getTotalAmountOfItemsInShoppingCart();
            $this->vatAmount = $this->total * self::Vat_Rate;
            require __DIR__ . '/../Views/ShoppingCart/ShoppingCartItemsDisplay.php';
        }
    }
    private function addItemToCart(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST["AdID"])) {
                try {
                    $dbAd = $this->adService->getAdByID(htmlspecialchars($_POST["AdID"]));
                    if ( ! $dbAd->getStatus()->equals(Status::Available()) ) {
                        echo "<script>alert('This product is already sold')</script>";
                        echo "<script>location.href = '/home'</script>";
                        exit();
                    } else {
                        if (!checkTheExistenceOfItemInCart($dbAd)) { // this is only one product so cannot be bought more than 1 quantity
                            addItemToShoppingCart($dbAd);
                        }
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        }
    }
    private function removeItemFromCart(): void
    {
        if (isset($_POST["removeCartItem"])) {
            $ad = $this->adService->getAdByID(htmlspecialchars($_POST['hiddenSHoppingCartItemID']));
            if (checkTheExistenceOfItemInCart($ad)) {
                removeItemFromCart($ad);
            }
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
}
