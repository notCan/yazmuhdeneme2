<?php
$allowed_methods = ["GET"]; // kabul edilen methodlar
$response = "";
$_code = 200;


if (in_array($_method, $allowed_methods)) {

    if ($_method == "GET") {

        if(isset($_GET["username"])){
            if(isset($_GET["password"])){

                $stmt = $db->prepare("SELECT * FROM users WHERE userNick=? and  userPass=?  ");
                $stmt->execute([$_GET["username"],$_GET["password"]]);
                $user = $stmt->fetch();
                if($user){
                    $data = [];

                    $query = $db->query("SELECT * FROM categories", PDO::FETCH_ASSOC);
                    if ( $query->rowCount() ){
                        foreach( $query as $row ){
                            $veri = [$row['catid']=>["cattitle"=>$row['cattitle'],"cattext"=>$row['cattext']]];

                            array_push($data,$veri);
                        }
                    }

                    $jsonArray["success"] = TRUE;

                    $response = ["data"=>$data];

                }else{
                    $response = "Kullanıcı adı veya şifre hatalı ";
                }


            }else{
                $response = "Şifre girilmedi ({password} is required)";
            }

        }else{
            $response = "Kullanıcı adı girilmedi ({username} is required)";
        }




    }


} else {
    $jsonArray["error"] = TRUE; // bir hata olduğu bildirilsin.
    $jsonArray["errorMessage"] = "Geçersiz method." . '(' . $_method . ')'; // Hatanın neden kaynaklı olduğu belirtilsin.
}