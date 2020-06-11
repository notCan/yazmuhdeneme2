<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=hardreza_MainData", "root", "");
    $db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
} catch (PDOException $e) {
    print $e->getMessage();
}
