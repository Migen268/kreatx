<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = Auth :: user();
        //nqs useri aktual qe po logohet e ka isAdmin 1 ath coje te admin.blade.php
        if($user->isAdmin==1){
        return view('admin');
        }
        
        else{
        return view('home');
        }
    }
}
