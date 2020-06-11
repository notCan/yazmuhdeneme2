<!-- Page Content -->
<div class="container my-4">

    <div class="row ">
        <div class="col-lg-12">


            <?php


            $user_id = $_SESSION["uid"];
            $sorguPost = $query = $db->query("SELECT *  FROM posts where userid=$user_id order by postid desc");

            ?>

            <div class="row my-5">

                <?php


                if ($sorguPost->rowCount()) {
                    foreach ($sorguPost as $row) {

                        echo '<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">' . $row["postTitle"] . '</a>
                            </h4>
                            <p class="card-text">' . substr($row["posttext"], 0, 90) . '...</p>
                        </div>
                        <div class="card-footer">
                            <a href="/edit/' . $row["postid"] . '" class="btn btn-primary text-white">Düzenle</a>
                            <a href="/postDelete/' . $row["postid"] . '" class="btn btn-danger text-white">Sil</a>
                        </div>
                    </div>
                </div>';
                    }
                } else {
                    echo '<div class="alert alert-warning" role="alert">Bu kategoride henüz paylaşım yapılmamıştır.</div>';
                }


                ?>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->