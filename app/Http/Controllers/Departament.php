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

//     public function treeview()
//     {   
//        // $pema =DB::table('departaments')->get();
// //$pema = Dep::get(); ose me eloquent,,behet dhe me all() pervec get()
    
//     // $treeView =Dep::with(['users'])->get();//behet join me tabelen users

//     // return view('treeview')->with('treeView',$treeView);        
    
//     $departament =Dep::where('hierarki', '=', 0)->get();

//     $tree='<ul id="browser" class="filetree">';
//     foreach ($departament as $Category) {
//          $tree .='<li class="tree-view closed"<a class="tree-name">'.$Category->Name.'</a>';
//          if($Category->users != null) {
//             $tree .=$this->childView($Category);
//         }
//     }
//     $tree .='<ul>';
//     // return $tree; 
//     return view('treeview',compact('tree'));

//     }

//     public function childView($Category){                 
//         $html ='<ul>';
//         foreach ($Category->users as $arr) {
//             if($arr->users != null){
//             $html .='<li class="tree-view closed"><a class="tree-name">'.$arr->name.'</a>';                  
//                     $html.= $this->childView($arr);
//                 }else{
//                     $html .='<li class="tree-view"><a class="tree-name">'.$arr->name.'</a>';                                 
//                     $html .="</li>";
//                 }
                               
//         }
        
//         $html .="</ul>";
//         return $html;
// }  

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




public function displaytree(){

 $tree = Dep::get();

return view('treeview')->with('tree',$tree);

}


 
}