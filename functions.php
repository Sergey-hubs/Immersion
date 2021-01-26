<?php 

function add_user($email, $password) {
    $pdo = new PDO('mysql:host=localhost;dbname=my_project', 'root', 'root');

    $sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';

    $query = $pdo->prepare($sql);

    $query->execute(['email'    => $email,
                     'password' => password_hash($password, PASSWORD_DEFAULT)]);
}

function get_user_by_email($email) {
    $pdo = new PDO('mysql:host=localhost;dbname=my_project', 'root', 'root');

    $sql = 'SELECT * FROM users WHERE email=:email';

    $statemant = $pdo->prepare($sql);

    $statemant->execute(['email' => $email]);

    $user = $statemant->fetch(PDO::FETCH_ASSOC);

    return $user;
}