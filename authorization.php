<?php 

session_start();
require_once 'functions.php';

$email = $_POST['email'];
$password = $_POST['password'];
$user = login($email, $password, $access);
$users = get_all_users();
$_SESSION['email'] = $email;

if ($user['email'] == $email && password_verify($password, $user['password']) && $user['access'] !== NULL) {
    set_button('button', '<a class="btn btn-success" href="create_user.html">Добавить</a>');
    $_SESSION['admin'] = 'admin';
    redirect_to('/users.php');
} elseif ($user['email'] == $email && password_verify($password, $user['password']) && $user['access'] == NULL) {
    set_button('button', '');
    redirect_to('/users.php'); 
} else {
    set_flash_message('success', 'Вы неверно ввели логин или пароль!');
    redirect_to("/page_login.php");
}


?>














<!-- $_SESSION['settings'] = '<a class="dropdown-item" href="edit.html">
    <i class="fa fa-edit"></i>
    Редактировать</a>
<a class="dropdown-item" href="security.html">
    <i class="fa fa-lock"></i>
    Безопасность</a>
<a class="dropdown-item" href="status.html">
    <i class="fa fa-sun"></i>
    Установить статус</a>
<a class="dropdown-item" href="media.html">
    <i class="fa fa-camera"></i>
    Загрузить аватар
</a>
<a href="#" class="dropdown-item" onclick="return confirm("are you sure?");">
    <i class="fa fa-window-close"></i>
    Удалить
</a>'; -->