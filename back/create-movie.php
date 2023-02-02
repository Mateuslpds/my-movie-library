<?php
    include 'main.php';

    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        exit();
    }

    $q = $conn->prepare('INSERT INTO movies VALUES (null, :title, :director, :genre, :release_year, :userid)');
    $q->bindValue(':title', $_POST['title']);
    $q->bindValue(':director', $_POST['director']);
    $q->bindValue(':genre', $_POST['genre']);
    $q->bindValue(':release_year', $_POST['release_year']);
    $q->bindValue(':userid', $_SESSION['user']['id']);
    $q->execute();
    $movieId = $conn->lastInsertId();
?>