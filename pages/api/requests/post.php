<?php
$allowed_methods = ["PUT", "DELETE", "POST"]; // kabul edilen methodlar
$response = "";


if (in_array($_method, $allowed_methods)) {

    if ($_method == "DELETE") {

        parse_str(file_get_contents('php://input'), $_DELETE);

        if (isset($_DELETE["username"])) {
            if (isset($_DELETE["password"])) {
                $stmt = $db->prepare("SELECT * FROM users WHERE userNick=? and  userPass=?  ");
                $stmt->execute([$_DELETE["username"], $_DELETE["password"]]);
                $user = $stmt->fetch();
                if ($user) {
                    if (isset($_DELETE["postid"])) {

                        $data = [];

                        $post = $db->prepare("SELECT * FROM posts WHERE postid=:postid  ");
                        $post->execute(['postid' => $_DELETE["postid"]]);
                        $post = $post->fetch();

                        if ($post) {

                            if ($post["userid"] == $user["userid"]) {

                                $response = ["data" => $data];

                                $query = $db->prepare("DELETE FROM posts WHERE postid = :postid");
                                $delete = $query->execute(array(
                                    'postid' => $post["postid"]
                                ));

                                if ($delete) {
                                    $jsonArray["success"] = TRUE;
                                    $response = "Post silindi ";

                                } else {
                                    $response = "Post silinirken bir hata oluştu ";
                                }


                            } else {

                                $response = "Kendinize ait olmayan postları silemezsiniz ";
                            }


                        } else {
                            $response = "Post bulunamadı ";
                        }


                    } else {
                        $response = "Post ID girilmedi ({postid} is required)";
                    }


                } else {
                    $response = "Kullanıcı adı veya şifre hatalı ";
                }


            } else {
                $response = "Şifre girilmedi ({password} is required)";
            }

        } else {
            $response = "Kullanıcı adı girilmedi ({username} is required)";
        }


    } else if ($_method == "PUT") {


        parse_str(file_get_contents('php://input'), $_PUT);

        if (isset($_PUT["username"])) {
            if (isset($_PUT["password"])) {
                $stmt = $db->prepare("SELECT * FROM users WHERE userNick=? and  userPass=?  ");
                $stmt->execute([$_PUT["username"], $_PUT["password"]]);
                $user = $stmt->fetch();
                if ($user) {
                    if (isset($_PUT["postid"])) {

                        $data = [];

                        $post = $db->prepare("SELECT * FROM posts WHERE postid=:postid  ");
                        $post->execute(['postid' => $_PUT["postid"]]);
                        $post = $post->fetch();

                        if ($post) {

                            if ($post["userid"] == $user["userid"]) {


                                if (isset($_PUT["catid"]) or isset($_PUT["posttext"]) or isset($_PUT["posttitle"])) {

                                    $updates = [];

                                    $devam = true;

                                    if (isset($_PUT["catid"])) {
                                        $cat = $db->prepare("SELECT * FROM categories WHERE catid=:catid  ");
                                        $cat->execute(['catid' => $_PUT["catid"]]);
                                        $cat = $cat->fetch();

                                        if (!$cat) {
                                            $devam = false;
                                            $response = "Geçersiz bir kategori girdiniz. ";
                                        }

                                    }


                                    if ($devam == true) {
                                        if (isset($_PUT["posttext"])) {
                                            if ((strlen(trim($_PUT["posttext"])) < 20)) {
                                                $devam = false;
                                                $response = "Post içeriği çok kısa. ";
                                            }
                                        }
                                    }


                                    if ($devam == true) {
                                        if (isset($_PUT["posttitle"])) {
                                            if ((strlen(trim($_PUT["posttitle"])) < 4)) {
                                                $devam = false;
                                                $response = "Post başlığı çok kısa. ";
                                            }
                                        }
                                    }


                                    if ($devam == true) {
                                        if (isset($_PUT["posttitle"])) {


                                            if (trim($_PUT["posttitle"]) != trim($post["postTitle"])) {

                                                $query = $db->prepare("UPDATE posts SET
postTitle = :postTitle
WHERE postid = :postid");
                                                $update = $query->execute(array(
                                                    "postTitle" => trim($_PUT["posttitle"]),
                                                    "postid" => $post["postid"]
                                                ));

                                                if ($update) {
                                                    array_push($updates, ["title" => ["old" => $post["postTitle"], "new" => trim($_PUT["posttitle"])]]);
                                                    $jsonArray["success"] = TRUE;
                                                }

                                            }


                                        }


                                        if (isset($_PUT["posttext"])) {

                                            if (trim($_PUT["posttext"]) != trim($post["posttext"])) {
                                                $query = $db->prepare("UPDATE posts SET
posttext = :posttext
WHERE postid = :postid");
                                                $update = $query->execute(array(
                                                    "posttext" => trim($_PUT["posttext"]),
                                                    "postid" => $post["postid"]
                                                ));

                                                if ($update) {
                                                    array_push($updates, ["posttext" => ["old" => $post["posttext"], "new" => trim($_PUT["posttext"])]]);
                                                    $jsonArray["success"] = TRUE;
                                                }


                                            }


                                        }


                                        if (isset($_PUT["catid"])) {
                                            if ($_PUT["catid"] != $post["catid"]) {


                                                $query = $db->prepare("UPDATE posts SET
catid = :catid
WHERE postid = :postid");
                                                $update = $query->execute(array(
                                                    "catid" => trim($_PUT["catid"]),
                                                    "postid" => $post["postid"]
                                                ));

                                                if ($update) {


                                                    array_push($updates, ["catid" => ["old" => $post["catid"], "new" => trim($_PUT["catid"])]]);
                                                    $jsonArray["success"] = TRUE;
                                                }


                                            }


                                        }


                                        $response = ["updates" => $updates];
                                    }


                                } else {
                                    $response = "Herhangi bir düzenleme belirtmediniz ";
                                }


                            } else {

                                $response = "Kendinize ait olmayan postları düzenleyemezsiniz ";
                            }


                        } else {
                            $response = "Post bulunamadı ";
                        }


                    } else {
                        $response = "Post ID girilmedi ({postid} is required)";
                    }


                } else {
                    $response = "Kullanıcı adı veya şifre hatalı ";
                }


            } else {
                $response = "Şifre girilmedi ({password} is required)";
            }

        } else {
            $response = "Kullanıcı adı girilmedi ({username} is required)";
        }


    } else if ($_method == "POST") {


        if (isset($_POST["username"])) {
            if (isset($_POST["password"])) {
                $stmt = $db->prepare("SELECT * FROM users WHERE userNick=? and  userPass=?  ");
                $stmt->execute([$_POST["username"], $_POST["password"]]);
                $user = $stmt->fetch();
                if ($user) {


                    if (strlen(trim(@$_POST["posttitle"])) > 4) {
                        if (strlen(trim(@$_POST["posttext"])) > 20) {
                            if (isset($_POST["catid"])) {

                                $cat = $db->prepare("SELECT * FROM categories WHERE catid=:catid  ");
                                $cat->execute(['catid' => $_POST["catid"]]);
                                $cat = $cat->fetch();

                                if ($cat) {
                                    $query = $db->prepare("INSERT INTO posts SET
userid = ?,
catid = ?,
postTitle = ?,
posttext = ?");
                                    $insert = $query->execute(array(
                                        $user["userid"], $_POST["catid"], trim($_POST["posttitle"]), trim($_POST["posttext"])
                                    ));
                                    if ($insert) {
                                        $last_id = $db->lastInsertId();
                                        $response = ["message" => "post yayınlandı","postID"=>$last_id];

                                        $jsonArray["success"] = TRUE;


                                    }


                                } else {
                                    $response = "Geçersiz bir kategori girdiniz. ";
                                }


                            } else {
                                $response = ' Kategori seçimi yapmadınız';

                            }

                        } else {
                            $response = 'İçerik çok kısa';
                        }

                    } else {
                        $response = 'Başlık çok kısa';
                    }


                } else {
                    $response = "Kullanıcı adı veya şifre hatalı ";
                }


            } else {
                $response = "Şifre girilmedi ({password} is required)";
            }

        } else {
            $response = "Kullanıcı adı girilmedi ({username} is required)";
        }


    }
} else {
    $jsonArray["error"] = TRUE; // bir hata olduğu bildirilsin.
    $jsonArray["errorMessage"] = "Geçersiz method." . '(' . $_method . ')'; // Hatanın neden kaynaklı olduğu belirtilsin.
}