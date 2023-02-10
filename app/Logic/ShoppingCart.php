<?php
require_once __DIR__ . '/../Models/Ad.php';
function addItemToShoppingCart($item): void
{
     $_SESSION['cartItems'][] = $item;
     updateCountOfItemsInCart();
}

function removeItemFromCart($item): void
{
     $cartItems = unserialize(serialize($_SESSION['cartItems']));
     $_SESSION['cartItems'] = array_filter($cartItems, function ($shoppingCartItem) use ($item) {
          return !$item->__equals($shoppingCartItem);
     });
     updateCountOfItemsInCart();
}
function updateCountOfItemsInCart(): void
{
     $_SESSION['countShoppingCartItems'] = count($_SESSION['cartItems']);
}
function getTotalAmountOfItemsInShoppingCart(): float
{
     $items = unserialize(serialize($_SESSION['cartItems']));
     $total = 0;
     foreach ($items as $ad) {
          $total = $total + $ad->getPrice();
     }
     return $total;
}
function checkTheExistenceOfItemInCart($item): bool
{
     $cartItems = unserialize(serialize($_SESSION['cartItems']));
     return in_array($item, $cartItems);
}
function getItemsInShoppingCart()
{
     return unserialize(serialize($_SESSION['cartItems']));
}
function clearShoppingCart(): void
{
     unset($_SESSION['cartItems']);
}
