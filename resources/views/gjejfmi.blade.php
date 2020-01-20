@extends('layouts.app')


  
  
@section('content') 
@foreach($f as $category)
  
      <div class="container">
        {{ csrf_field() }}
        <table class=" display table table-striped table-bordered" id="fmi">
            <thead>
                <tr> <th>ID</th>  <th>Name</th> <th>Email</th></tr>
            </thead><tbody>

     @foreach($category->users as $subcategory)
      <tr><td>{{$subcategory->id}}</td><td>{{$subcategory->name}}</td><td>{{$subcategory->email}}</td></tr>
      @endforeach
      
        </tbody>
        </table></div>
@endforeach




<div>
    <footer  class="py-2 bg-dark text-white-50">
      <div class="container text-center">
          <a  href="/treeview">Goo Back</a>
      </div>
    </footer>
  </div>

  <script>
 
 $(document).ready(function() {
             
             $('#fmi').DataTable();
         
         } );  
               
    </script> 

@endsection