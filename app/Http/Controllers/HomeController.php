<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
use App\departament as Dep;
use App\User;
use App\Message;
use Pusher\Pusher;
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
        return view('home',compact(['user']));
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
    $dep=Dep::get();
    return view('edit',compact(['edit','dep']));


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
   $post->departID = $request->depname;
    $post->save();

    return redirect('/admin/edit')->with('success','Data updated');
 
}

public function chat(){
    //$chatuser=User::where('id','!=',Auth::id())->get();
    $chatuser = DB::select("select users.id, users.name, users.fotoProfili, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.name, users.fotoProfili, users.email");


    return view('chat',compact(['chatuser']));
}


public function getMessage($user_id)
{
    $my_id = Auth::id();

    // Make read all unread message
    Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

    // Get all message from selected user
    $messages = Message::where(function ($query) use ($user_id, $my_id) {
        $query->where('from', $user_id)->where('to', $my_id);
    })->oRwhere(function ($query) use ($user_id, $my_id) {
        $query->where('from', $my_id)->where('to', $user_id);
    })->get();


    return view('messages.index', ['messages' => $messages]);
}

public function repMessage($user_id)
{
    $my_id = Auth::id();

    // Get all message from selected user
    $messages = Message::where(function ($query) use ($user_id, $my_id) {
        $query->where('from', $user_id)->where('to', $my_id)->where('is_read',0);
    })->get();

    // Make read all unread message
    Message::where(['from' => $user_id, 'to' => $my_id,'is_read'=>0])->update(['is_read' => 1]);

    return $messages;
}


public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();
       //return back()->with('success','me sukses');
        // pusher
        // $options = array(
        //     'cluster' => 'eu',
        //    'useTLS' => true
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        // $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        // $pusher->trigger('my-channel', 'my-event', $data);
    }




}
