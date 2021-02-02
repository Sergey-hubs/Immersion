<?php 

session_start();
require_once 'functions.php';

$email = $_POST['email'];
$password = $_POST['password'];
$user = login($email, $password);


if ($user['email'] == $email && $user['password'] == $password) {
    redirect_to('/users.php');
} else {
    set_flash_message('success', 'Вы неверно ввели логин или пароль!');
    redirect_to("/page_login.php");
}



?>