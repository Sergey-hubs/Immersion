<?php 

session_start();
require_once 'functions.php';

$email = $_POST['email'];
$password = $_POST['password'];
$user = login($email, $password);
$users = get_all_users();
$_SESSION['email'] = $email;

if ($user['email'] == $email && password_verify($password, $user['password']) && $user['role'] == 'admin') {
    $_SESSION['role'] = 'admin';
    redirect_to('/users.php');
} elseif ($user['email'] == $email && password_verify($password, $user['password']) && $user['role'] == 'user') {
    $_SESSION['role'] = 'user';
    redirect_to('/users.php'); 
} else {
    set_flash_message('success', 'Вы неверно ввели логин или пароль!');
    redirect_to("/page_login.php");
}


?>
