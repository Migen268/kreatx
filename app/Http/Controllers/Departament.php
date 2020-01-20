<?php

namespace App\Http\Controllers;
use DB;
use App\departament as Dep;
use Illuminate\Http\Request;
use App\User;
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
    
        return view('createdep');        
    
    }

    public function add(Request $request)
    {    
         $this->validate($request,[
        'emri' => 'required' 
                ]);

        $user = new Dep;

        $user->name = $request->emri;
        $user->hierarki =0;
        
        $user->save();
        
       
        return redirect('/depart')->with('success','Data Added Successfully');
     
            
    
    }



public function nendep($id){
$a['id']=$id;
return view('addchild')->with('a',$a);

}

public function ruajnendep(Request $request)
{    
     $this->validate($request,[
    'emri' => 'required' 
            ]);

    $user = new Dep;

    $user->name = $request->emri;
    $user->hierarki =$request->idparent;
    
    $user->save();
    
   
    return redirect('/depart')->with('success','Child Added Successfully');
        }



        public function gjejfmi($id){
    $b['id']=$id;
    $f = Dep::where('id',$id)->with(['users'])->get();
return view('gjejfmi',compact(['b','f']));

}




    public function tree_viewe($tree,$root_id){
            $child = "<ul>";
            foreach($tree as $item ){
                if($item->hierarki== $root_id ){
                    $content =  $this->tree_viewe($tree,$item->id);
                    if(strlen($content)>9){
                        $child .= "<li><a href='/gjejfmi/".$item->id."'>" . $item->Name."</a>"  . $content . "</li>";
                    }
                    else {
                        $child .= "<li><a href='/gjejfmi/".$item->id."'>" . $item->Name ."</a></li>";
                    }
                   
                }
            } $child .="</ul>";
            return $child ;
    }
         


public function displaytree(){

    $tree = Dep::get();
 
 $value = $this->tree_viewe($tree,0);

 
 return view('treeview')->with('value',$value);

}





 
}