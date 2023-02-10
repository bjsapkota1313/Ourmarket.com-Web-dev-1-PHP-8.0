<?php
require_once __DIR__ . '/../Models/User.php';

function logOutFromApp(): void
{
    unset($_SESSION["loggedUser"]);
}
function getLoggedUser()
{
    if (isset($_SESSION["loggedUser"])) {
        return unserialize(serialize($_SESSION["loggedUser"]));
    } else {
        return null;
    }
}
function assignLoggedUserToSession($verifiedUser): void
{
    $_SESSION["loggedUser"] = $verifiedUser;
}
