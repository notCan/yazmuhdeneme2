<?php
$user = $db->prepare("SELECT * FROM users WHERE userid=:userid  ");
$user->execute(['userid' => $_SESSION["uid"]]);
$user = $user->fetch();

if (isset($_GET["kaldir"])) {

    $query = $db->prepare("UPDATE users SET
userimgpath = :userimgpath
WHERE userid = :userid");
    $update = $query->execute(array(
        "userimgpath" => '',
        "userid" => $_SESSION["uid"]
    ));


    $user = $db->prepare("SELECT * FROM users WHERE userid=:userid  ");
    $user->execute(['userid' => $_SESSION["uid"]]);
    $user = $user->fetch();


}

?>


<div class="container">

    <div class="row">


        <div class="col-lg-4 my-5 text-center">

            <?php
            if (isset($_FILES['img'])) {


                $hata = $_FILES['img']['error'];
                if ($hata != 0) {
                    echo '<div class="alert alert-danger" role="alert">Yalnızca JPG ve PNG dosyaları gönderebilirsiniz</div>';

                } else {
                    $boyut = $_FILES['img']['size'];
                    if ($boyut > (1024 * 1024 * 3)) {
                        echo '<div class="alert alert-danger" role="alert">Dosya 3MB den büyük olamaz</div>';

                    } else {
                        $tip = $_FILES['img']['type'];
                        $isim = $_FILES['img']['name'];
                        $uzanti = explode('.', $isim);
                        $uzanti = $uzanti[count($uzanti) - 1];

                        $fileName = md5(time()) . "-" . rand(1, 99) . "." . $uzanti;

                        if ($tip == 'image/jpeg' || $uzanti == 'jpg' or $tip == 'image/png' || $uzanti == 'png') {
                            $dosya = $_FILES['img']['tmp_name'];
                            copy($dosya, 'uploads/' . $fileName);


                            $query = $db->prepare("UPDATE users SET
userimgpath = :userimgpath
WHERE userid = :userid");
                            $update = $query->execute(array(
                                "userimgpath" => '/uploads/' . $fileName,
                                "userid" => $_SESSION["uid"]
                            ));
                            $user = $db->prepare("SELECT * FROM users WHERE userid=:userid  ");
                            $user->execute(['userid' => $_SESSION["uid"]]);
                            $user = $user->fetch();
                            echo '<div class="alert alert-success" role="alert">Profil fotoğrafı başarıyla güncellendi</div>';

                        } else {
                            echo '<div class="alert alert-danger" role="alert">Yalnızca JPG ve PNG dosyaları gönderebilirsiniz</div>';

                        }
                    }
                }
            }


            ?>


            <?php


            if ($user["userimgpath"]) {
                $imgUrl = $user["userimgpath"];
                $kaldir = '<a href="?kaldir" class="btn btn-block btn-danger my-5">Fotoğrafı kaldır</a>';
            } else {
                $imgUrl = "/uploads/eafa02bf65ac491cf12a6e6e6ca599fb-1.png";
                $kaldir = '';

            }

            ?>

            <img src="<?= $imgUrl; ?>"
                 alt="Avatar" class="img-thumbnail mb-3">
            <?= $kaldir; ?>
            <div class="input-group">

                <div class="custom-file">
                    <form enctype="multipart/form-data" method="POST" action="">
                        <input type="file" name="img" class="custom-file-input">
                        <label class="custom-file-label">Fotoğraf seç</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Yükle</button>
                </div>
                </form>
            </div>

            <div class="my-5 mt-5">

                <a href="/deleteAccount" class="btn btn-danger">Hesabımı sil</a>

            </div>


        </div>

        <div class="col-lg-4 my-5">

            <h1 class="my-4">Profil</h1>


            <?php

            if (isset($_POST["guncelle"])) {

                $query = $db->prepare("UPDATE users SET
firstName = :firstName,
lastName = :lastName
WHERE userid = :userid");
                $update = $query->execute(array(
                    "firstName" => $_POST["firstName"],
                    "lastName" => $_POST["lastName"],
                    "userid" => $_SESSION["uid"]
                ));
                if ($update) {
                    echo '<div class="alert alert-success" role="alert">Bilgiler başarıyla güncellendi</div>';
                    $user = $db->prepare("SELECT * FROM users WHERE userid=:userid  ");
                    $user->execute(['userid' => $_SESSION["uid"]]);
                    $user = $user->fetch();

                } else {
                    echo '<div class="alert alert-danger" role="alert">Bilgiler güncellenemedi</div>';
                }

            }

            ?>


            <form action="" method="POST">
                <div class="form-group">
                    <label>Kullanıcı adı</label>
                    <input type="text" name="userNick" value="<?= $user["userNick"] ?>" disabled class="form-control"
                           placeholder="<?= $user["userNick"] ?>">
                </div>
                <div class="form-group">
                    <label>İsim</label>
                    <input type="text" name="firstName" value="<?= $user["firstName"] ?>" autocomplete="no"
                           class="form-control" placeholder="İsim">
                </div>
                <div class="form-group">
                    <label>Soyisim</label>
                    <input type="text" name="lastName" value="<?= $user["lastName"] ?>" autocomplete="no"
                           class="form-control" placeholder="Soyisim">
                </div>
                <div class="form-group">
                    <label>Mail</label>
                    <input type="text" name="email" value="<?= $user["userMail"] ?>" disabled class="form-control"
                           placeholder="<?= $user["userMail"] ?>">
                </div>
                <button type="submit" name="guncelle" class="btn btn-primary">Güncelle</button>
            </form>


        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-4 my-5">

            <h1 class="my-4">Şifre</h1>


            <?php

            if (isset($_POST["sifreGuncelle"])) {


                if ($_POST["newPass2"] == $_POST["newPass"]) {

                    if ($user["userPass"] == $_POST["pass"]) {
                        $query = $db->prepare("UPDATE users SET
userPass = :userPass
WHERE userid = :userid");
                        $update = $query->execute(array(
                            "userPass" => $_POST["newPass"],
                            "userid" => $_SESSION["uid"]
                        ));

                        echo '<div class="alert alert-success" role="alert">Şifreniz başarıyla güncellendi</div>';


                    } else {
                        echo '<div class="alert alert-danger" role="alert">Eski şifrenizi hatalı girdiniz</div>';

                    }

                } else {
                    echo '<div class="alert alert-danger" role="alert">Yeni şifreleriniz uyuşmuyor</div>';

                }


            }

            ?>


            <form action="" method="POST">
                <div class="form-group">
                    <label>Şifre</label>
                    <input type="password" name="pass" class="form-control"
                           placeholder="Şifre">
                </div>
                <div class="form-group">
                    <label>Yeni şifre</label>
                    <input type="password" name="newPass" autocomplete="no"
                           class="form-control" placeholder="Yeni şifre">
                </div>
                <div class="form-group">
                    <label>Yeni şifre onay</label>
                    <input type="password" name="newPass2" autocomplete="no"
                           class="form-control" placeholder="Yeni şifre onay">
                </div>

                <button type="submit" name="sifreGuncelle" class="btn btn-primary">Güncelle</button>
            </form>


        </div>
        <!-- /.col-lg-3 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->