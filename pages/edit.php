<?php


$post = $db->prepare("SELECT * FROM posts WHERE postid=:postid  ");
$post->execute(['postid' => __param[1]]);
$post = $post->fetch();


if ($post) {


    if ($post["userid"] != $_SESSION["uid"]) {
        $hata = "Size ait olmayan postları düzenleyemezsiniz";

    }

} else {

    $hata = "Aradığınız post bulunamadı";

}


if (isset($hata)) {


    ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-12 my-5">

                <h1 class="my-4"><?= @$hata ?></h1>


            </div>
            <!-- /.col-lg-3 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <?php


} else {


    ?>


    <div class="container">

        <div class="row">

            <div class="col-lg-3 my-5 text-center">

            </div>
            <div class="col-lg-6 my-5">

                <h1 class="my-4">Gönderi düzenle</h1>


                <?php


                if (isset($_POST["guncelle"])) {

                    if (strlen(trim($_POST["baslik"])) > 4) {
                        if (strlen(trim($_POST["icerik"])) > 20) {
                            if (isset($_POST["kategori"])) {


                                $query = $db->prepare("UPDATE posts SET
posttext = :posttext,
postTitle = :postTitle,
catid = :catid
WHERE postid = :postid");
                                $update = $query->execute(array(
                                    "posttext" => trim($_POST["icerik"]),
                                    "postTitle" => trim($_POST["baslik"]),
                                    "catid" => $_POST["kategori"],
                                    "postid" => __param[1]
                                ));


                                if ($update) {
                                    $last_id = $post["postid"];
                                    echo '<div class="alert alert-success" role="alert">Post Güncellendi <a href="/view/' . $last_id . '"> (görüntüle)</a></div>';
                                    unset($_POST);

                                    $post = $db->prepare("SELECT * FROM posts WHERE postid=:postid  ");
                                    $post->execute(['postid' => __param[1]]);
                                    $post = $post->fetch();


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
                        <input type="text" name="baslik" value="<?= @$post["postTitle"] ?>" class="form-control"
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

                                    if ($post["catid"] == $row["catid"]) {
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
                        <textarea name="icerik" class="form-control"><?= @$post["posttext"] ?></textarea>

                    </div>


                    <button type="submit" name="guncelle" class="btn btn-success">Güncelle</button>
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


    <?php


}


?>
