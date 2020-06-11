<?php
$_code = 404;
$_method = $_SERVER["REQUEST_METHOD"]; // client tarafından bize gelen method

$jsonArray["success"] = false;

if (@__param[1] == "post") {
    $_code = 200;
    include "requests/post.php";
} elseif (@__param[1] == "categories") {
    $_code = 200;
    include "requests/categories.php";
}


if (@$response) {
    $jsonArray["response"] = $response;
}

SetHeader($_code);
$jsonArray[$_code] = HttpStatus($_code);
echo json_encode($jsonArray);