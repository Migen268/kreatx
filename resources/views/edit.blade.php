@extends('layouts.app')

@section('content')
   
 <div class="text-success">
    
    <h1 class="text text-info text-center">Admin you can edit user's data here</h1> 

 </div>
 <hr>


<div class="container">

    
    <form action="/admin/edit/store" method="POST" > 
        @csrf
        <div class="form-group">
            <label for="kio">ID</label>
            <input  value="{{$edit->id}}"  id="kio" class="form-control" name="id" readonly>     
       </div>
        <div class="form-group">
            <label for="k">Name</label>
            <input type="text" value="{{$edit->name}}"  id="k" class="form-control" name="emri">     
       </div>
    
       <div class="form-group">
        <label for="ko" class="mr-sm-2">Email</label>
            <input type="email"  id="ko" value="{{$edit->email}}"  class="form-control" name="email"> 
       </div>
       <div class="form-group">
        <label for="kos" class="mr-sm-2">Department</label>
            <input type="number"  id="kos" value="{{$edit->departID}}"  class="form-control" name="dept"> 
       </div>

       <div class="form-group">
        <label for="lo" class="mr-sm-2">Password</label>
            <input type="password"  id="lo" value="{{$edit->password}}" class="form-control" name="kalo" > 
       </div>
    
        <input type="submit" value="Update" class="btn btn-outline-primary ">
    </form>
</div> 










@endsection
