<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class adminPanel extends Controller{


  public function index()
  {
    return view('Backend.adminPanel.index');
  }

}
