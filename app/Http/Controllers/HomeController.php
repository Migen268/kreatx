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
        $user = Auth::user();
        $admin = Auth::user()->get();//merr te gjithe recordet e userave nga databaza
        //nqs useri aktual qe po logohet e ka isAdmin 1 ath coje te admin.blade.php
        if($user->isAdmin==1){
        return view('admin')->with('admin',$admin);
        }
            
        else{
        return view('home')->with('user',$user);
        }
    }
 
    public function store(Request $request){
         
         $this->validate($request,[
             'emri' => 'required' ,
             'email' => 'required',
            // 'foto' => 'max:1999|required',//pra me e vogel se 2MB
            'kalo'=> 'required'
      ]);
        
         $post = Auth::user();
      
         if($request ->hasFile('foto') ){
           
            $a=$request ->file('foto')->getClientOriginalName();
            $foto =pathinfo($a,PATHINFO_FILENAME);
            
            $prapashtesa = $request ->file('foto')->getClientOriginalExtension();
            
            $filenametoStore=$foto.'_'.time().'_'.$prapashtesa ;
            
            //i ruaj fotot ne nje folder te config,,upload image
            $path = $request ->file('foto')->storeAs('/public/foto_profili',$filenametoStore);
            
            $post->fotoProfili = $filenametoStore;
           
        }
        else{
            $filenametoStore='blabslabla.jpg';
        }
        
        $post->name = $request->emri;
        $post->email = $request ->email;
        $post->password =Hash::make( $request ->kalo);
        // $post->fotoProfili = $filenametoStore;
         $post->save();

         return redirect('/home')->with('success','Data updated');
    
    }

public function delete(Request $request){
  $id = $request->id;
    $fshi=Auth::user()->find($id);//i gjith rekordi me id qe ka te rreshti i tabeles
        $fshi->delete();

 return redirect('/admin')->with('success','Data deleted');
        
 
}



public function edit(Request $request){

    $edit=Auth::user()->find($request->id);//merr vetem nje rekord

    return view('edit')->with('edit',$edit);


}


public function update(Request $request){
         
    $this->validate($request,[
        'emri' => 'required' ,
        'email' => 'required',
       // 'foto' => 'max:1999|required',//pra me e vogel se 2MB
       'kalo'=> 'required'
 ]);
   
    $post = Auth::user()->find($request->id);
 
   $post->name = $request->emri;
   $post->email = $request->email;
   $post->password =Hash::make( $request->kalo);
   // $post->fotoProfili = $filenametoStore;
   $post->departID = $request->dept;
    $post->save();

    return redirect('/admin/edit')->with('success','Data updated');

}




}
