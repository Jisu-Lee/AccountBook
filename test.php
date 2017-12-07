<?php
    $host = 'localhost';
    $user = 'root';
    $pw = 'root';
    $dbName = 'test';
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', 'root', $pdo_options);

    echo 1;
    $get = $db->prepare("SELECT * FROM mytable");
    $get->execute();

    echo 1;
    print_r($get->fetch());
    echo 1;
?>
