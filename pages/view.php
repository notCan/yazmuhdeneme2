<!-- Page Content -->
<div class="container my-4 mt-5">
    <div class="row ">
        <div class="col-lg-3">

            <h1 class="my-4">Kategoriler</h1>
            <div class="list-group">
                <a href="/kategoriler" class="list-group-item">Tüm kategoriler</a>

                <?php


                $query = $db->query("SELECT * FROM categories", PDO::FETCH_ASSOC);
                if ($query->rowCount()) {
                    foreach ($query as $row) {
                        echo '<a href="/?cat=' . $row["catid"] . '" class="list-group-item">' . $row["cattitle"] . '</a>';

                    }
                }

                ?>
            </div>

        </div>
        <!-- /.col-lg-3 -->


        <?php


        $post = $db->prepare("SELECT * FROM posts WHERE postid=:postid  ");
        $post->execute(['postid' => __param[1]]);
        $post = $post->fetch();


        if (!$post) {

            ?>

            <div class="col-lg-9 mt-5">


                <h1 class="my-4">Aradığınız gönderi bulunamadı.</h1>


                <!-- /.row -->

            </div>

            <?php


        } else {
            ?>
            <div class="col-lg-9">


                <h3 class="my-4"><?= $post["postTitle"] ?></h3>
                <p class="my-4"><?= $post["posttext"] ?></p>

                <div class="col-lg-4 col-md-6 mb-4">
                    <?php
                    //LİKE DİSLİKE İŞLEMLERİ
                        $ratpostid= __param[1];
                        $ratuser= $_SESSION['uid'];
                        $returnurl = htmlspecialchars($_SERVER['HTTP_REFERER']);
                        //like sayısını çeken sorgu
                        $sorgu = $db->prepare("SELECT * FROM rating WHERE postid=".$ratpostid." and rating_action= 'like'");
                        $sorgu->execute();
                            while ($row = $sorgu->fetch() ) {
                             $say[] = $row["userid"];
                             $uzun = count($say);
                     }
                     if(empty($uzun)){
                         $uzun = 0 ;
                     }
                     //dislike sayısını çeken sorgu
                      $sorgu_1 = $db->prepare("SELECT * FROM rating WHERE postid=".$ratpostid." and rating_action= 'dislike'");
                        $sorgu_1->execute();
                            while ($row = $sorgu_1->fetch() ) {
                             $say_1[] = $row["userid"];
                             $uzun_1 = count($say_1);
                     }
                     if(empty($uzun_1)){
                         $uzun_1 = 0 ;
                     }
                     //like-dislike action
                     if(isset($_GET["like"])){
                         $status = $_GET["like"];
                         switch ($status) {
                             //like
                              case '1':
                            $sorgu_3 = $db->prepare("SELECT * FROM rating WHERE postid=".$ratpostid." and userid=".$ratuser);
                            $sorgu_3->execute();
                            while ($row = $sorgu_3->fetch() ) {
                             $controllike_id = $row["userid"];
                            }
                            if(empty($controllike_id)){
                                $controllike_id=0;
                            }else{
                                $controllike_id=1;
                            }
                            if($controllike_id == 0){
                                 $likesorgu = $db->prepare("INSERT INTO rating (userid,postid,rating_action) VALUES ('$ratuser','$ratpostid','like')");
                                 $likesorgu->execute();
                                 header('Location: '.$returnurl);
                            }elseif($controllike_id == 1){
                                $update_1 = $db->prepare("UPDATE rating SET rating_action= 'like' WHERE postid=".$ratpostid." and userid=".$ratuser);
	                            $update_1->execute();
	                            header('Location: '.$returnurl);
                            }
                         break;
                         //dislike
                         case '0':
                            $sorgu_2 = $db->prepare("SELECT * FROM rating WHERE postid=".$ratpostid." and userid=".$ratuser);
                            $sorgu_2->execute();
                            while ($row = $sorgu_2->fetch() ) {
                             $controldis_id = $row["userid"];
                            }
                            if(empty($controldis_id)){
                                $controldis_id=0;
                            }else{
                                $controldis_id=1;
                            }
                            if($controldis_id == 0){
                                $dislikesorgu = $db->prepare("INSERT INTO rating (userid,postid,rating_action) VALUES ('$ratuser','$ratpostid','dislike')");
                                $dislikesorgu->execute();
                                header('Location: '.$returnurl);
                            }elseif($controldis_id == 1){
                                $update = $db->prepare("UPDATE rating SET rating_action= ? WHERE postid=".$ratpostid." and userid=".$ratuser);
	                            $update->execute(array('dislike'));
	                            header('Location: '.$returnurl);
                            }
                         break;
                         
                          default:

                          break;
                    }
                     }
                     //like-dislike disabled or enabled
                     $disabled = $db->prepare("SELECT * FROM rating WHERE postid=".$ratpostid." and userid=".$ratuser);
                     $disabled->execute();
                            while ($row = $disabled->fetch() ) {
                            $rating_action = $row["rating_action"];
                     }
                    ?>
                    <div class="row">
                        <a href="?like=1" class=
                        <?php 
                        if(empty($rating_action)){
                            echo '"btn btn-success text-white "';
                        }else{
                            if($rating_action == 'like'){
                              echo '"btn btn-success text-white disabled"';
                            }else{
                             echo '"btn btn-success text-white "';
                            }
                        }
                        ?>
                        > <i class="fa fa-thumbs-up  " aria-hidden="true"></i> <?php echo $uzun; ?></a>
                        <a href="?like=0" class=
                        <?php 
                        if(empty($rating_action)){
                            echo '"btn btn-danger text-white "';
                        }else{
                            if($rating_action == 'dislike'){
                              echo '"btn btn-danger text-white disabled"';
                            }else{
                             echo '"btn btn-danger text-white "';
                            }
                        }
                        ?>
                        > <i class="fa fa-thumbs-down  " aria-hidden="true"></i> <?php echo $uzun_1; ?></a>
                    </div>
                </div>


                <div class="col-lg-4">
                </div>
                <!-- /.row -->

            </div>
            
            <?php


        }


        ?>


    </div>
    <!-- /.row -->

</div>
<!-- /.container -->