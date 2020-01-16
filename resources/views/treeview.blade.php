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


{{-- punon deri me tre cikle --}}
<ul>
@foreach ($tree as $item )
  @if($item->hierarki==0)
    <li>{{$item->Name}}
       @foreach($tree as $fmi)
        @if($item->id == $fmi->hierarki)
    <ul><li> 
    {{$fmi->Name}}
    @foreach($tree as $fmi1)
  
    @if($fmi->id == $fmi1->hierarki)
   <ul> <li> 
    {{$fmi1->Name}}
 </li></ul>
    @endif
    @endforeach  
  </li></ul>
    @endif
    @endforeach 
  </li> 
    @endif
@endforeach
</ul> 



 {{-- new solution --}}
 {{-- <ul>
@foreach ($tree as $item )
   @if($item->hierarki==0)
   <li>{{$item->Name}}
    @include('treeview1')
    
  
@endif
@endforeach
</li></ul>  --}}


@endsection