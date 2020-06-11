<!-- Page Content -->
<div class="container my-4">

    <div class="row ">
        <div class="col-lg-3">

            <h1 class="my-4">Kategoriler</h1>
            <div class="list-group">
                <a href="/kategoriler" class="list-group-item">Tüm kategoriler</a>

                <?php


                $query = $db->query("SELECT * FROM categories ", PDO::FETCH_ASSOC);
                if ($query->rowCount()) {
                    foreach ($query as $row) {
                        echo '<a href="/?cat=' . $row["catid"] . '" class="list-group-item">' . $row["cattitle"] . '</a>';

                    }
                }

                ?>
            </div>

        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">


            <?php


            $sorguPost = $query = $db->query("SELECT *  FROM posts order by postid desc");


            if (isset($_GET["cat"])) {
                $cat = $db->prepare("SELECT * FROM categories WHERE catid=:catid  ");
                $cat->execute(['catid' => @$_GET["cat"]]);
                $cat = $cat->fetch();
                if ($cat) {
                    $catId = $cat["catid"];
                    $sorguPost = $query = $db->query("SELECT *  FROM posts where catid=$catId order by postid desc");

                    echo '<h3 class="my-4">' . $cat["cattitle"] . '</h3>';
                    echo '<p class="my-4">' . $cat["cattext"] . '</p>';
                } else {

                }
            }

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
                            <a href="/view/' . $row["postid"] . '" class="btn btn-primary text-white">Devamını oku</a>
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