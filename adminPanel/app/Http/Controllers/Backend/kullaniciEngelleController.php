<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class kullaniciEngelleController extends Controller
{
 public function index()
  {
    $users=DB::table('users')->where('userNick', '1')->get();
    return view('backend.adminPanel.kullaniciEngelle',compact('users'));
  }
  public function showUser(Request $request)
  {
    $users=DB::table('users')->where('userNick', $request->input('userName'))->get();
    if($users == '[]')
    {
      return back()->with('status', 'warning');
    }
    return view('backend.adminPanel.kullaniciEngelle',compact('users'));
  }
  public function deleteUser(Request $request)
  {
     $users=DB::table('users')->where('userid', $request->input('userid'))->Delete();
     if ($users) {
         return back()->with('status', 'succes');
     }else {
       return back()->with('status', 'erorr');
     }
     return back();
  }

}
