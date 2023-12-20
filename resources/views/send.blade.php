<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send | Receive Messages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 append-message mt-5 mx-3 p-3" style="border: 1px solid orange; border-radius: 10px;">
                <h4>Your messages will be shown here</h4>
            </div>
        </div>
        <form action="" method="post">
            <div class="row mt-5">
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                @endif
                <div class="col-12">
                    <h4>Send a message to <b>Rami</b></h4>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <textarea name="message" class="form-control message"></textarea>
                        <i class="typing" style="display: none;"></i>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-success send">Send</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        $(document).ready(function() {
            // Enable pusher logging - don't include this in production
            var name = "pankaj"; 
            console.log(name);       
            Pusher.logToConsole = false;

            var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
                cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
            });

            var socketId = null;
            pusher.connection.bind('connected', function() {
                socketId = pusher.connection.socket_id;
            });
            var channel = pusher.subscribe('message-channel');
            channel.bind('receive-event', function(data) {
                console.log(data);
                $('.append-message').append(`<p><b>${data.from}: </b>${data.message}</p>`)
            });
            
            // Typing
            var textarea = $('.message');
            var typingStatus = $('.typing');
            var lastTypedTime = new Date(0); // it's 01/01/1970
            var typingDelayMillis = 500; // how long user can "think about his spelling" before we show "No one is typing -blank space." message
            var isTyping = false;
            
            function refreshTypingStatus() {
                if (!textarea.is(':focus') || textarea.val() == '' || new Date().getTime() - lastTypedTime.getTime() > typingDelayMillis) {
                    if (isTyping) { 
                        startStopTypingAJAX('end');
                        isTyping = false;
                        console.log(isTyping);
                    }
                } else {
                    if (!isTyping) { 
                        startStopTypingAJAX('start')
                        isTyping = true;
                        console.log(isTyping);
                    }
                }
            }
            function updateLastTypedTime() {
                lastTypedTime = new Date();
            }
            
            setInterval(refreshTypingStatus, 2000);
            textarea.keypress(updateLastTypedTime);
            textarea.blur(refreshTypingStatus);
            
            
            channel.bind('start-end-typing', function(data) {
                if (data.typing == 'end') {
                    $('.typing').html('').hide(100);
                } else {
                    $('.typing').html(`<p><b>${data.from}</b> is typing...</p>`).show(100);
                }
            });
            
            /**
             *
             * @param string typing start|end
             */
            function startStopTypingAJAX(typing) {
                $.ajax({
                    url: '{{ route("typing.ajax") }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        from: name,
                        typing: typing,
                        _token: '{{ csrf_token() }}',
                        socket_id: socketId,
                    }
                });
            }

            $('.send').click(function() {
                const message = $('.message').val();
                if (message != '') {
                    $.ajax({
                        url: '{{ route("send.ajax") }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            from: name,
                            message: message,
                            _token: '{{ csrf_token() }}',
                            socket_id: socketId,
                        }
                    })
                    .done(result => {
                        if (result.result) {
                            $('.append-message').append(`<p><b>You: </b>${message}</p>`);
                            $('.message').val('');
                        } else {
                            alert(result.error.message);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
