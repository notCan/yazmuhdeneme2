<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class deneme extends Controller
{
    //
    public function index()
    {
      $curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost/AdminPanel%202/public/api/product",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    	// Set Here Your Requesred Headers
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$array = json_decode($response, true);
echo $array[1]['postid'];
// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     print_r(json_decode($response));
// }
    }
}
