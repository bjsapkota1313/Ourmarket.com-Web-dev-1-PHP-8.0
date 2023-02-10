<?php
require __DIR__.'/../Models/User.php';
require __DIR__.'/../Services/UserService.php';
class SignUpController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    public function displaySignupPage():void{
        require __DIR__.'/../Views/SignUpNewUser/SignUp.html';
        $this->createUser();
    }
    private function createUser() :void{
        if(isset($_POST["btnRegister"])){
            if($this->userService->CheckUserExistenceByEmail(htmlspecialchars($_POST["email"]))){
                echo"<script>displayModalForSignUp('ooooooops!','The email address you entered is already taken, Please choose another email address')</script>";
                return;
            }
           $userDetails= array(
               "firstName" =>htmlspecialchars($_POST["FirstName"]),
               "lastName" =>htmlspecialchars($_POST["LastName"]),
               "email" => htmlspecialchars($_POST["email"]),
               "password" =>htmlspecialchars($_POST["password"])
            );
           if($this->userService->createNewUser($userDetails)){
              echo"<script>displayModalForSignUp('Congrats !',' Your account has been created successfully. You can now log in and start selling your items.')</script>";
           }
           else{
               echo"<script>displayModalForSignUp('ooooooops!','Something went wrong while creating your account TRY Again')</script>";
           }
        }
    }


}