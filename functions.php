<?php 

function add_user($email, $password) {
    $pdo = new PDO('mysql:host=localhost;dbname=my_project', 'root', 'root');
    $sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';
    $query = $pdo->prepare($sql);
    $query->execute(['email'    => $email,
                     'password' => password_hash($password, PASSWORD_DEFAULT)]);
    return $pdo->lastInsertID();
}

function get_user_by_email($email) {
    $pdo = new PDO('mysql:host=localhost;dbname=my_project', 'root', 'root');
    $sql = 'SELECT * FROM users WHERE email=:email';
    $statemant = $pdo->prepare($sql);
    $statemant->execute(['email' => $email]);
    $user = $statemant->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function login($email, $password) {
    $pdo = new PDO('mysql:host=localhost;dbname=my_project', 'root', 'root');
    $sql = 'SELECT * FROM users WHERE email=:email; password=:password; :role';
    $statemant = $pdo->prepare($sql);
    $statemant->execute(['email' => $email,
                         'password' => $password,
                         'role' => 'role']);
    $user = $statemant->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function get_all_users() {
    $pdo = new PDO('mysql:host=localhost;dbname=my_project', 'root', 'root');
    $sql = 'SELECT * FROM users';
    $statemant = $pdo->prepare($sql);
    $statemant->execute();
    $users = $statemant->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function display_flash_message($name) {
    if(isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);  
    }
}

function set_button($name, $message) {
    $_SESSION[$name] = $message;
}

function set_flash_message($name, $message) {
    $_SESSION[$name] = $message;
}

function redirect_to($path) {
    header("Location: {$path}");
    exit;
}

?>