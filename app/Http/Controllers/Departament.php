<?php

namespace App\Http\Controllers;
use DB;
use App\departament as Dep;
use Illuminate\Http\Request;

class Departament extends Controller
{
    public function index()
    {   
    
        $dept = DB::table('departaments')->get();//merr te gjithe recordet e departamenteve nga databaza
        
       
        return view('depart')->with('dept',$dept);
     
            
    
    }



    public function fshidepart(Request $request){
        $id = $request->id;
//fshi recordin me id e rreshtit perkates te tabeles
          $fshi=DB::table('departaments')->where('id',$id)->delete();
              
      
       return redirect('/depart')->with('success','Data deleted');
              
      
      }

      public function edit(Request $request){

        $edit=DB::table('departaments')->find($request->id);//merr vetem nje rekord
    
        return view('editdep')->with('edit',$edit);
    
    
    }

    public function update(Request $request){
         
        $this->validate($request,[
            'emri' => 'required' 
     ]);
       
     $update=DB::table('departaments')->where('id', $request->id)->update(['name'=>$request->emri]);
     
    
        return redirect('/depart')->with('success','Data updated');
    
    }


    public function create()
    {   
    
      
        
       
        return view('createdep');//->with('dept',$dept);
     
            
    
    }

    public function add(Request $request)
    {    
         $this->validate($request,[
        'emri' => 'required' 
                ]);

        $user = new Dep;

        $user->name = $request->emri;
        
        $user->save();
        
       
        return redirect('/depart')->with('success','Data Added Successfully');
     
            
    
    }



 
}
