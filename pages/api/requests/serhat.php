<?php
$allowed_methods = ["DELETE"]; // kabul edilen methodlar
$response = "";


if (in_array($_method, $allowed_methods)) {

   if ($_method == "DELETE") {

        $response = "gönderi silindi";
        //  bilgisi listeleme burada olacak. GET işlemi

    }


} else {
    $jsonArray["error"] = TRUE; // bir hata olduğu bildirilsin.
    $jsonArray["errorMessage"] = "Geçersiz method." . '(' . $_method . ')'; // Hatanın neden kaynaklı olduğu belirtilsin.
}