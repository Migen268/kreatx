@extends('layouts.app')

@section('content')
   
 <div class="text-success">
    <h1 class="text text-info text-center">Admin you can edit department's data here</h1> 
 </div>
 <hr>
<div class="container">
    <form action="/storedep" method="POST" > 
        @csrf
        <div class="form-group">
            <label for="kio">ID</label>
            <input  value="{{$edit->id}}"  id="kio" class="form-control" name="id" readonly>     
       </div>
        <div class="form-group">
            <label for="k">Name</label>
            <input type="text" value="{{$edit->Name}}"  id="k" class="form-control" name="emri">     
       </div>
        <input type="submit" value="Update" class="btn btn-outline-primary ">
    </form>
</div>  

@endsection
