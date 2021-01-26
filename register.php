<?php 
session_start();
require_once 'functions.php';

$email = $_POST['email'];
$password = $_POST['password'];



if (!empty(get_user_by_email($email))) {
    $_SESSION['danger'] = '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.';
    header('Location: /page_register.php');
    exit;
} elseif (add_user($email, $password)) {
    $_SESSION['success'] = 'Регистрация успешна';
    header('Location: /page_login.php');
    exit;
}

?>