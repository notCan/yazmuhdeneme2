<div class="container">

    <div class="row">


        <div class="col-lg-6 my-5 text-center">


            <h1 class="my-4">Hesap sil</h1>

            <?php
            $user = $db->prepare("SELECT * FROM users WHERE userid=:userid  ");
            $user->execute(['userid' => $_SESSION["uid"]]);
            $user = $user->fetch();

            if (isset($_POST["hesapSil"])) {

                if ($_POST["sifre"] == $_POST["sifreOnay"]) {
                    if ($_POST["sifre"] == $user["userPass"]) {

                        $query = $db->prepare("DELETE FROM users WHERE userid = :userid");
                        $delete = $query->execute(array(
                            'userid' => $_SESSION["uid"]
                        ));

                        if ($delete) {
                            session_destroy();

                            echo '<div class="alert alert-warning" role="alert">Hesabınız başarıyla silindi.Oturumunuz sonlandırıldı.</div>';

                        }

                    } else {
                        echo '<div class="alert alert-danger" role="alert">Şifrenizi hatalı girdiniz.</div>';
                    }

                } else {
                    echo '<div class="alert alert-danger" role="alert">Girdiğiniz şifreler eşleşmiyor.</div>';
                }


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

            <form action="" method="POST">

                <div class="form-group">
                    <label>Şifre</label>
                    <input type="password" name="sifre" autocomplete="no" class="form-control" placeholder="Şifre">

                </div>
                <div class="form-group">
                    <label>Şifre onay</label>
                    <input type="password" name="sifreOnay" autocomplete="no" class="form-control"
                           placeholder="Şifre onay">

                </div>

                <button type="submit" onclick='confirm("Hesabımın silinmesini onaylıyorum");' name="hesapSil" class="btn btn-danger">Hesabımı sil
                </button>
            </form>


        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-6 my-5 text-center">

            <div class="alert alert-danger" role="alert">Bu işlemin geri dönüşü yoktur.</div>

        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->