<?php
    require 'main.php';

    $q = $conn->prepare('INSERT INTO users VALUES (null, :username, :email, :password)');
    $q->bindValue(':username', $_POST['username']);
    $q->bindValue(':email', $_POST['email']);
    $q->bindValue(':password', $_POST['password']);
    $q->execute();
    $userId = $conn->lastInsertId();

    http_response_code(201);
?>