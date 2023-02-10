<?php
require __DIR__ . "/../Models/User.php";
require __DIR__ . "/../Models/Ad.php";
require __DIR__ . "/../Services/AdService.php";
require  __DIR__ . "/../Logic/LoggingInAndOut.php";

class HomeController
{
    private $adService;

    public function __construct()
    {
        $this->adService = new AdService();
    }
    public function displayHomePage()
    {
        $ads = $this->adService->getAllAvailableAds(); // only showing available ads
        require __DIR__ . "/../Views/HomePage/Home.php";
        $this->showAvailableAds($ads);
        require __DIR__ . '/../Views/Footer.php';
        $this->loginAndSignout();
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
    private function showAvailableAds($ads): void
    {
        if (is_null($ads)) {
            require __DIR__ . '/../Views/HomePage/NoAdsAvailableToBeSold.html';
        } else {
            require __DIR__ . '/../Views/HomePage/ShowAvailableAds.php';
        }
    }
}
