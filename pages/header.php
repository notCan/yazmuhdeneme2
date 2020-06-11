<!DOCTYPE html>
<html lang="tr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Meslek Bul</title>

    <meta name="description" content="">
    <meta name="author" content="powerrangers">

    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
    <link href="css/app.css" rel="stylesheet">

    <style>

        .custom-file-label::after {
            content: "";
            padding: 0px;
        }

    </style>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Meslek Bul</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if(@__param[0]==""){echo "active";}?>">
                    <a class="nav-link" href="/">Anasayfa
                    </a>
                </li>
                <li class="nav-item <?php if(@__param[0]=="kategoriler"){echo "active";}?>">
                    <a class="nav-link" href="/kategoriler">Kategoriler</a>
                </li>

                <li class="nav-item <?php if(@__param[0]=="destek"){echo "active";}?>">
                    <a class="nav-link" href="/destek">Destek</a>
                </li>

                <?php


                if (isset($_SESSION["loggedin"])) { // giriş yapmışsa

                    ?>
                    <li class="nav-item <?php if(@__param[0]=="katekle"){echo "active";}?>">
                        <a class="nav-link" href="/katekle">Kategori Ekle</a>
                    </li>
                    <li class="nav-item <?php if(@__param[0]=="newPost"){echo "active";}?>">
                        <a class="nav-link" href="/newPost">Post oluştur</a>
                    </li>

                    <li class="nav-item <?php if(@__param[0]=="myPosts"){echo "active";}?>">
                        <a class="nav-link" href="/myPosts">Postlarım</a>
                    </li>

                    <li class="nav-item <?php if(@__param[0]=="profile"){echo "active";}?>">
                        <a class="nav-link" href="/profile">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logOut">Çıkış yap</a>
                    </li>

                    <?php
                } else { // giriş yapmamışsa

                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/kayit">Kayıt Ol/Giriş Yap</a>
                </li>

                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>
