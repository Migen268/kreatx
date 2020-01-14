@extends('layouts.app')

@section('content')
   
 <div class="text-success">
    <h3 class="text text-info text-center">Admin you can add a child for department  here</h3> 
 </div>
 <hr>
<div class="container">
    <form action="/addchild" method="POST" >  
        @csrf
        
        <div class="form-group">
            <label for="k">Name</label>
            <input type="text" value=""  id="k" class="form-control" name="emri"> 
            <input type="hidden" value="{{$a['id']}}"    name="idparent">     
       </div>
        <input type="submit" value="Add" class="btn btn-outline-primary ">
    </form>
</div>  
 
@endsection
