@extends('layouts.app')

@section('content')
<div class="text-success">
    
    <h1 class="text-center">Welcome Admin</h1>
</div>

<div class="container">
    {{ csrf_field() }}
    <table class=" display table table-striped table-bordered" id="crud">
        <thead>
            <tr> <th>ID</th>  <th>Name</th> <th>Email</th><th>Department</th><th>Action</th></tr>
        </thead>
 
    <tbody>
     
        @foreach ($admin as $item) 
        @if( $item->isAdmin == 0)  
    
        <tr>	<td>{{$item->id}}</td> 	<td>{{$item->name}}</td>	 <td>{{$item->email}}</td>	<td>{{$item->departID}}</td>
            <td>
                <form  method="POST">
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="id">
                <button type="submit" class="btn btn-outline-primary" name="edit" value="edito" onclick="javascript: form.action='/admin/edit';"><span>&#9998;
                    </span>Edit</button>
            
            <button  type="submit" class=" btn btn-outline-danger" name="delete" value="fshi" onclick="javascript: form.action='/admin';"><span>&#128465;
                </span> Delete
            </button>  
        
        </form>
        </td>
        
        </tr>
        @endif
       
        @endforeach
       
   
    
    
    </tbody> 
    
    </table>
    
    </div>
    <a href="/depart" role="button" class="btn btn-outline-info "> CRUD DEPARTAMENTS </a>
    <a href="/treeview" role="button" class="btn btn-outline-info "> Tree View </a>
 <script>
 
 $(document).ready(function() {
             
             $('#crud').DataTable();
         
         } );  
               
    </script> 

@endsection
