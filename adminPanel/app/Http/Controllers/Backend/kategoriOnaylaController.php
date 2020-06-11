<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class kategoriOnaylaController extends Controller
{
    //
    public function index()
    {
       return view('backend.adminPanel.kategorionayla');
    }

    public function showCategories()
    {
      $categories=DB::table('categories')->where('catconfirm', '0')->get();
      return view('backend.adminPanel.kategorionayla',compact('categories'));
    }
    public function confirmCat(Request $request)
    {
      $catid = $request->input('catid');
      $client = new \GuzzleHttp\Client();
      $request = $client->put('http://localhost/adminPanel/public/api/apiController/'.$catid ,[
        'json' => ['catconfirm' => '1']
    ]);
      $response = $request->getBody()->getContents();
      $status = json_decode($response, true);
       if($status['catconfirm'] == 1){
              return back()->with('status', 'succes');
          }else {
            return back()->with('status', 'erorr');
         }
        return back(); //return view('backend.adminPanel.postSil');

    }
}
