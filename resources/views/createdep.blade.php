@extends('layouts.app')

@section('content')
   
 <div class="text-success">
    <h3 class="text text-info text-center">Admin you can add new department  here</h3> 
 </div>
 <hr>
<div class="container">
    <form action="/adddep" method="POST" >  
        @csrf
        
        <div class="form-group">
            <label for="k">Name</label>
            <input type="text" value=""  id="k" class="form-control" name="emri">     
       </div>
        <input type="submit" value="Add" class="btn btn-outline-primary ">
    </form>
</div>  
 
@endsection
