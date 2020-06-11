<?php


$post = $db->prepare("SELECT * FROM posts WHERE postid=:postid  ");
$post->execute(['postid' => __param[1]]);
$post = $post->fetch();


if ($post) {


    if ($post["userid"] != $_SESSION["uid"]) {
        $hata = "Size ait olmayan postları silemezsiniz";

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

                <h1 class="my-4">Gönderi Sil</h1>


                <?php


                if (isset($_POST["sil"])) {

                    $query = $db->prepare("DELETE FROM posts WHERE postid = :postid");
                    $delete = $query->execute(array(
                        'postid' => __param[1]
                    ));


                    if($delete){
                        header('Location: /myPosts');

                    }

                }


                ?>

                <form action="" method="POST">

                    <label>Bu işlemin geri dönüşü yoktur.Postu silmek istediğine emin misin?</label>

                    </br>

                    <input type="submit" value="Postu sil" name="sil" class="btn btn-danger">


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
