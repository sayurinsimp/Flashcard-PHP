<?php
    $host = 'localhost';
    $user = 'root';
    $password = 'cELrzWbzad3dAHot';
    $dbname = 'flashcards';

    // Set DSN (Data Source Name)
    $dsn = 'mysql:host='. $host . ';dbname='. $dbname;

    // PDO Instance
    $pdo = new PDO($dsn, $user, $password);
?>