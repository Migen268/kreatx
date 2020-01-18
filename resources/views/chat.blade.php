@extends('layouts.app')

@section('content')
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
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('23c09879699330f8a11c', {
            cluster: 'eu',
            forceTLS: true
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            // alert(JSON.stringify(data));
            if (my_id == data.from) {
                $('#' + data.to).click();
            } else if (my_id == data.to) {
                if (receiver_id == data.from) {
                    // if receiver is selected, reload the selected user ...
                    $('#' + data.from).click();
                } else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.from).find('.pending').html());
                    if (pending) {
                        $('#' + data.from).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.from).append('<span class="pending">1</span>');
                    }
                }
            }
        });
        $('.user').click(function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();
            receiver_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "message/" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data);
                    scrollToBottomFunc();
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
                    url: "message", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
            }
        });
    });
    // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
</script>



@endsection