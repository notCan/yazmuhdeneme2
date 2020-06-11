<?php
date_default_timezone_set('Europe/Istanbul');
ini_set('session.gc_maxlifetime', 7200);
session_start();
ob_start();
define("izin", TRUE);

error_reporting(E_ALL);

require_once 'inc/urlConfiguration.php';
require_once 'inc/dbConnect.php';
require_once 'inc/functions.php';

$_pages = [
    null => ["title" => "Anasayfa", "Login" => true, "includes" => ["header", "home", "footer"]],
    "profile" => ["title" => "Profil", "Login" => true, "includes" => ["header", "profile", "footer"]],
    "view" => ["title" => "PostDetay", "Login" => true, "includes" => ["header", "view", "footer"]],
    "deleteAccount" => ["title" => "Hesap sil", "Login" => true, "includes" => ["header", "deleteAccount", "footer"]],
    "newPost" => ["title" => "Post oluştur", "Login" => true, "includes" => ["header", "newPost", "footer"]],
    "myPosts" => ["title" => "Postlarım", "Login" => true, "includes" => ["header", "myPosts", "footer"]],
    "edit" => ["title" => "Post düzenle", "Login" => true, "includes" => ["header", "edit", "footer"]],
    "logOut" => ["title" => "Profil", "Login" => true, "includes" => ["logOut"]],
    "home" => ["title" => "Kategoriler", "Login" => false, "includes" => ["header", "profile", "footer"]],
    "api" => ["title" => "Api instance", "Login" => false, "includes" => ["api/index"]],
    "kategoriler" => ["title" => "Kategoriler", "Login" => true, "includes" => ["header", "kategoriler", "footer"]],
    "destek" => ["title" => "Destek", "Login" => false, "includes" => ["header", "destek", "footer"]],
    "katekle" => ["title" => "Kategori Ekle", "Login" => true, "includes" => ["header", "katekle", "footer"]],
    "kayit" => ["title" => "Giris/Kayit", "Login" => false, "includes" => ["kayit"]],
    "postDelete" => ["title" => "Giris/Kayit", "Login" => false, "includes" => ["header","postDelete","footer"]],
];

if (array_key_exists(@__param[0], $_pages)) {

    if (!$_pages[@__param[0]]["Login"] or $_pages[@__param[0]]["Login"] and @$_SESSION["loggedin"]) {

        define("__page_detalis", $_pages[@__param[0]]);
        foreach ($_pages[@__param[0]]["includes"] as $include) {
            include "pages/" . $include . ".php";
        }

    } else {
        header("HTTP/1.0 404 Not found");

        include "pages/header.php";
        include "pages/loginRequired.php";
        include "pages/footer.php";


    }

} else {

    header("HTTP/1.0 404 Not found");
    exit(json_encode(['status_code' => '404', 'message' => 'Not found'], JSON_UNESCAPED_UNICODE));

}
