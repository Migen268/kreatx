@extends('layouts.app')

@section('content')
<div class="text-info">
    
    <h3 class="text-center ">Welcome Admin,Here You Can CRUD Departments</h3>
</div>

<div class="container">
    {{ csrf_field() }}
    <table class=" display table table-striped table-bordered" id="dep">
        <thead>
            <tr> <th>ID</th>  <th>Department Name</th> <th>Action</th></tr>
        </thead>
  
    <tbody>
     
        @foreach ($dept as $item)
    
    
        <tr>	<td>{{$item->id}}</td> 	<td>{{$item->Name}}</td>	
            <td>
                <form  method="POST">
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="id">
                <button type="submit" class="btn btn-outline-primary" name="edit" value="edito" onclick="javascript: form.action='/editodep';"><span>&#9998;
                    </span>Edit</button>
            
            <button  type="submit" class=" btn btn-outline-danger" name="delete" value="fshi" onclick="javascript: form.action='/rdepart';"><span>&#128465;
                </span> Delete
            </button>  
        
        </form>
        <a class="btn btn-outline-primary" name="edit" href="/nendepartament/{{$item->id}}" >Add Child Departament  </a>
        </td>
         
        </tr>
       
       
        @endforeach
             
   
    
    
     </tbody>
    
    </table>
    <a href="/createdep" role="button" class="btn btn-outline-info "> Add new Department </a>  
    </div> 
 <script>
 
 $(document).ready(function() {
             
             $('#dep').DataTable();
         
         } ); 
               
    </script> 

@endsection
