<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use GuzzleHttp\Client;
class postSilController extends Controller
{
    //
    public function index()
    {
      return view('backend.adminPanel.postSil');
    }

    public function showPosts()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://localhost/adminPanel/public/api/apiController');
        $response = $request->getBody()->getContents();
        $status = $request->getStatusCode();
        $posts = json_decode($response, true);
// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     print_r(json_decode($response));
// }
      //$posts=DB::table('posts')->get();
       return view('backend.adminPanel.postSil',compact('posts'));
    }



    public function deletePost(Request $request)
      {
        $postid = $request->input('post-id');

        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://localhost/adminPanel/public/api/apiController/'.$postid);
        $response = $request->getBody()->getContents();
        if (json_decode($response, true) == null) {
           return back()->with('status', 'warning');
        }
        else{
        $request = $client->delete('http://localhost/adminPanel/public/api/apiController/'.$postid);
        // verinin silinip silinmedigini kontrol ediyorum.
       $request = $client->get('http://localhost/adminPanel/public/api/apiController/'.$postid);
       $response = $request->getBody()->getContents();
       if (json_decode($response, true) == null) {
          return back()->with('status', 'succes');
       }
       else {
         return back()->with('status', 'erorr');
       }
       return back();
     }
     }
}
