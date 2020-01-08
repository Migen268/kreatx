@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
{{-- kodi qe kam shtuar  vete --}}
<div>
    <hr>
</div>
<div class="text text-info text-center" >
<h2>Here you can Edit your Profile Data</h2>
</div>

<div class="container">
    <form action="{{ action('HomeController@store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="k">Name</label>
            <input type="text"  id="k" class="form-control" name="emri">     
       </div>
    
       <div class="form-group">
        <label for="ko" class="mr-sm-2">Email</label>
            <input type="email"  id="ko"  class="form-control" name="email"> 
       </div>

       <div class="form-group">
        <label for="ko" class="mr-sm-2">Password</label>
            <input type="password"  id="ko"  class="form-control" name="kalo"> 
       </div>
    
        <input type="submit" value="Save Changes" class="btn btn-outline-primary ">
    </form>
    </div>









@endsection
