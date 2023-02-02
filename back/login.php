<?php
    require 'main.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
    $stmt->execute([
        'email' => $email, 
        'password' => $password
    ]);

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (sizeof($data) == 0) {
        http_response_code(401);
        exit();
    }

    $user = $data[0];
    $_SESSION['user'] = $user;
    http_response_code(200);
?>