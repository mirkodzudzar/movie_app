<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index()
  {
      return view('admin.index');
  }

  public function administrator($id)
  {
      echo 'admin '.$id;
  }

  public function subscriber($id)
  {
      echo 'subscriber '.$id;
  }
}
