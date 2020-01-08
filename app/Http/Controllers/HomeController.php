<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
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

    public function store(Request $request){
        
        $this->validate($request,[
            'emri' => 'required' ,
            'email' => 'required',
            'kalo' => 'required'
         ]);
        
         $post = Auth :: user();
       // if(!empty($request ->input('emri'))){
         $post->name = $request ->input('emri');
        //}   
         //if(!empty($request ->input('emri'))){
         $post->email = $request ->input('email');
        //  }
        //  if(!empty($request ->input('emri'))){
         $post->password =Hash::make( $request ->input('kalo'));
        //  }
         $post->save();

         return redirect('/home')->with('success','Changes were made successfully!');
    


    }



}
