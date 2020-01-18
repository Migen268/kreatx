@extends('layouts.app')

@section('content')
    <div class="page-header float-right">
    <img class="img-responsive" src="/storage/foto_profili/{{$user->fotoProfili}}"  alt="no  profile picutre choosen"  height="150" width="150" style="position:relative;top:-3em;" >
  
    </div>
 <div class="text-success">
    
    <h1>Welcome Employee</h1> 

 </div>
 <hr>


<div class="container">

    <h2 class="text text-info text-center">Here you can Edit your Profile Data</h2>
    
    <form action="/home" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="form-group"> 
            <label for="k">Name</label>
            <input type="text" value="{{$user->name}}"  id="k" class="form-control" name="emri">     
       </div>
    
       <div class="form-group">
        <label for="ko" class="mr-sm-2">Email</label>
            <input type="email"  id="ko" value="{{$user->email}}"  class="form-control" name="email"> 
       </div>

       <div class="form-group">
        <label for="so" class="mr-sm-2">Profile Picture</label>
            <input type="file"  id="so"  class="form-control" name="foto"> 
       </div>

       <div class="form-group">
        <label for="lo" class="mr-sm-2">Password</label>
            <input type="password"  id="lo"  class="form-control" name="kalo"> 
       </div>
    
        <input type="submit" value="Save Changes" class="btn btn-outline-primary ">
    </form>
</div> 

<br><br>
<div>
  <footer  class="py-2 bg-dark text-white-50">
    <div class="container text-center">
        <a  href="/chat">Goo Chat</a>
    </div>
  </footer>
</div>



@endsection
