<?php
    $dsn = 'mysql:host=localhost;port=3307;dbname=cms';
    $username = 'root';
    $password = '';
    $db = new PDO($dsn, $username, $password);
    $development_mode = true;
?>