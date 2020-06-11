<?php
$user = $db->prepare("SELECT * FROM users WHERE userid=:userid  ");
$user->execute(['userid' => $_SESSION["uid"]]);
$user = $user->fetch();

?>


<div class="container">

    <div class="row">

        <div class="col-lg-3 my-5 text-center">

        </div>
        <div class="col-lg-6 my-5">

            <h1 class="my-4">Yeni gönderi</h1>


            <?php


            if (isset($_POST["gonder"])) {

                if (strlen(trim($_POST["baslik"])) > 4) {
                    if (strlen(trim($_POST["icerik"])) > 20) {
                        if (isset($_POST["kategori"])) {

                            $query = $db->prepare("INSERT INTO posts SET
userid = ?,
catid = ?,
postTitle = ?,
posttext = ?");
                            $insert = $query->execute(array(
                                $_SESSION["uid"], $_POST["kategori"], trim($_POST["baslik"]), trim($_POST["icerik"])
                            ));
                            if ($insert) {
                                $last_id = $db->lastInsertId();
                                echo '<div class="alert alert-success" role="alert">Post yayınlandı <a href="/view/' . $last_id . '"> (görüntüle)</a></div>';

                                unset($_POST);

                            }

                        } else {
                            echo '<div class="alert alert-danger" role="alert">Kategori seçimi yapmadınız</div>';

                        }

                    } else {
                        echo '<div class="alert alert-danger" role="alert">İçerik çok kısa</div>';
                    }

                } else {
                    echo '<div class="alert alert-danger" role="alert">Başlık çok kısa</div>';
                }

            }


            ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Başlık</label>
                    <input type="text" name="baslik" value="<?= @$_POST["baslik"] ?>" class="form-control"
                           placeholder="Başlık">
                </div>


                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                        <option disabled selected>Lütfen seçim yapınız</option>
                        <?php

                        $query = $db->query("SELECT * FROM categories", PDO::FETCH_ASSOC);
                        if ($query->rowCount()) {
                            foreach ($query as $row) {

                                if ($_POST["kategori"] == $row["catid"]) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }

                                echo '<option value="' . $row["catid"] . '"  ' . $select . '>' . $row["cattitle"] . '</option>';
                            }
                        }


                        ?>
                    </select>


                </div>


                <div class="form-group">
                    <label>İçerik</label>
                    <textarea name="icerik" class="form-control"><?= @$_POST["icerik"] ?></textarea>

                </div>


                <button type="submit" name="gonder" class="btn btn-success">Paylaş</button>
            </form>


        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-3 my-5">

        </div>
        <!-- /.col-lg-3 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->