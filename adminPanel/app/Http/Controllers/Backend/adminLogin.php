<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class adminLogin extends Controller{


  public function index()
  {
    return view('Backend.adminPanel.auth');
  }
  public function login(Request $request)
  {
     $lStatus=DB::table('admins')->where('adminNick', $request->adminNick)->where('adminPass',$request->adminPass)->get();
     if($lStatus == '[]'){
        return back()->with('status', 'erorr');
     }
     else {
       return view('Backend.adminPanel.index');
     }
  }
}
