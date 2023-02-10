<?php

class Router
{
    public function route($uri)
    {
        $uri = $this->stripParameters($uri);

        switch ($uri) {
            case '':
            case 'home':
                require __DIR__ . "/../controllers/HomeController.php";
                $controller = new HomeController();
                $controller->displayHomePage();
                break;
            case 'home/login':
                require __DIR__ . '/../controllers/LoginController.php';
                $controller = new LoginController();
                $controller->displayLoginPage();
                break;
            case 'home/login/signup':
                require __DIR__ . '/../controllers/SignUpController.php';
                $controller=new SignUpController();
                $controller->displaySignupPage();
                break;
            case 'home/myAds':
                require __DIR__ . '/../controllers/MyAdsController.php';
                $controller = new MyAdsController();
                $controller->displayMyAdsPage();
                break;
            case 'home/shoppingCart':
                require __DIR__ . '/../controllers/ShoppingCartController.php';
                $controller = new ShoppingCartController();
                $controller->displayShoppingCartPage();
                break;
            case 'home/shoppingCart/payment':
                require __DIR__ . '/../controllers/PaymentController.php';
                $controller = new PaymentController();
                $controller->displayPaymentPage();
                break;

                // local hosts apis
            case 'api/adsapi';
                require __DIR__ . '/../API/Controllers/AdsController.php';
                $controller = new AdsController();
                $controller->postNewAdRequest();
                break;
            case 'api/adsbyloggeduser';
                require __DIR__ . '/../API/Controllers/AdsController.php';
                $controller = new AdsController();
                $controller->sendAdsByLoggedUser();
                break;
            case 'api/updateAd';
                require __DIR__ . '/../API/Controllers/AdsController.php';
                $controller = new AdsController();
                $controller->operateAdRequest();
                break;
            case 'api/editAd';
                require __DIR__ . '/../API/Controllers/AdsController.php';
                $controller = new AdsController();
                $controller->handleAdEditRequest();
                break;
            case 'api/searchproducts':
                require __DIR__ . '/../API/Controllers/AdsController.php';
                $controller = new AdsController();
                $controller->handleSearchRequest();
                break;
            default:
                http_response_code(404);
                break;
        }
    }

    private function stripParameters($uri)
    {
        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }
}
