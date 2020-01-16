
 @foreach($tree as $fmi)
 
 @if($item->id == $fmi->hierarki)
    <ul><li> 
    {{$fmi->Name}}

     @endif
    
 {{-- @include('treeview1') --}}
    @endforeach
         </li>   </ul>