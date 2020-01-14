@extends('layouts.app')


  
  
@section('content')
<div class="text-success">
    
    <h1 class="text-center">Tree View of Departaments </h1>
</div> 

 


   {{-- @foreach($treeView as $dep)
kjo afishon departamentet dhe employee qe ka ..po jo si tree view   
   <ul id="myUL">
    <li><span class="caret">{{ $dep->Name }}</span>
    <ul class="nested">
      @foreach($dep->users as $subcategory)
        <li >{{$subcategory->name}}</li>
      @endforeach
    </ul>
  </li>

@endforeach  --}}

<div id="treeview">      
  {!! $tree !!}
</div> 


<script>
$('#tree').treeview({data:$tree});


</script>



@endsection
