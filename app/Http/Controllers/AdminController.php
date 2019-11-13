<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends AdminBaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
      return view('admin.index');
  }
}
