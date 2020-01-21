@extends('layouts.app')

@section('content')
{{-- per chat --}}
<style>
    /* width */
    ::-webkit-scrollbar {
        width: 7px;
    }
    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #a7a7a7;
    }
    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #929292;
    }
    ul {
        margin: 0;
        padding: 0;
    }
    li {
        list-style: none;
    }
    .user-wrapper, .message-wrapper {
        border: 1px solid #dddddd;
        overflow-y: auto;
    }
    .user-wrapper {
        height: 600px;
    }
    .user {
        cursor: pointer;
        padding: 5px 0;
        position: relative;
    }
    .user:hover {
        background: #eeeeee;
    }
    .user:last-child {
        margin-bottom: 0;
    }
    .pending {
        position: absolute;
        left: 13px;
        top: 9px;
        background: #b600ff;
        margin: 0;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        line-height: 18px;
        padding-left: 5px;
        color: #ffffff;
        font-size: 12px;
    }
    .media-left {
        margin: 0 10px;
    }
    .media-left img {
        width: 64px;
        border-radius: 64px;
    }
    .media-body p {
        margin: 6px 0;
    }
    .message-wrapper {
        padding: 10px;
        height: 536px;
        background: #eeeeee;
    }
    .messages .message {
        margin-bottom: 15px;
    }
    .messages .message:last-child {
        margin-bottom: 0;
    }
    .received, .sent {
        width: 45%;
        padding: 3px 10px;
        border-radius: 10px;
    }
    .received {
        background: #ffffff;
    }
    .sent {
        background: #3bebff;
        float: right;
        text-align: right;
    }
    .message p {
        margin: 5px 0;
    }
    .date {
        color: #777777;
        font-size: 12px;
    }
    .active {
        background: #eeeeee;
    }
    input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 15px 0 0 0;
        display: inline-block;
        border-radius: 4px;
        box-sizing: border-box;
        outline: none;
        border: 1px solid #cccccc;
    }
    input[type=text]:focus {
        border: 1px solid #aaaaaa;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">
                    @foreach($chatuser as $user)
                        <li class="user" id="{{ $user->id }}">
                            {{--will show unread count notification--}}
                            @if($user->unread)
                                <span class="pending">{{ $user->unread }}</span>
                            @endif

                           <div class="media">
                                <div class="media-body">
                                    <p class="name">{{ $user->name }}</p>
                                    <p class="email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-8" id="messages">

        </div>
    </div>
</div>

      





<br><br>
<div>
  <footer  class="py-2 bg-dark text-white-50">
    <div class="container text-center">
        <a  href="/home">Goo Back</a>
    </div>
  </footer>
</div>


<script>
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function () {
        // ajax setup form csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $('.user').click(function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();
            receiver_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "message/" + receiver_id, // get route
                data: "",
                cache: false,
                success: function (data) {
                  //setInterval(  $('#messages').html(data),1000);
                  $('#messages').html(data)
            //      console.log("Mesazhe: ",data);
                  scrollToBottomFunc();
                  refresh(receiver_id);
                } 
            });
        });
        $(document).on('keyup', '.input-text input', function (e) {
            var message = $(this).val();
            // check if enter key is pressed and message is not null also receiver is selected
            if (e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val(''); // while pressed enter text box will be empty
                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "post",
                    url: "message", //post route
                    data: datastr, 
                    cache: false,  
                    success: function (data) {
                     
                      scrollToBottomFunc();
                      merrmesazhe_sent(message);
                      
                    }
                    
                }) 
            }
        });
    });
    // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight,
            }, 50);
    }
// function merrmesazhe(){
//     var m = $('.active').attr('id');
//     $.ajax({
//                 type: "get",
//                 url: "message/" + m, // get route
//                 data: "",
//                 cache: false,
//                 success: function (data) {
//                     $('#messages').html(data);
//                     scrollToBottomFunc();
//                 } 
//             });
// }
function merrmesazhe_sent(m){
    $('.messages').append(' <li class="message clearfix">'+
                '<div class="sent">'+
                    '<p> '+m+'</p>'+
                    '<p class="date"></p>'+
                '</div>'+
            '</li>');
         //scrollToBottomFunc();
}

function refresh(receiver_id){
    setInterval(function() {
        $.ajax({
            type: "get",
            url: "chati/" + receiver_id, //post route
            data: "", 
            cache: false,  
            success: function (data) {
              //  console.log(data);
                if(data.length > 0){
                    for(var i =0;i<data.length;i++){
                        $('.messages').append(' <li class="message clearfix">'+
                                            '<div class="received">'+
                                                '<p> '+data[i].message+'</p>'+
                                                '<p class="date"></p>'+
                                            '</div>'+
                                        '</li>');
                    }
                    scrollToBottomFunc();
                    
                }
               

            //   scrollToBottomFunc();
            //   merrmesazhe_sent(message);
                
            }
                    
        })
        },2000); 

}

</script>
 


@endsection