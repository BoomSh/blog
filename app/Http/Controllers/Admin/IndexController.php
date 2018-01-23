<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('admin.index.index',['user'=>$user]);
    }
    
}
