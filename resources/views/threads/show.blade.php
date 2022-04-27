@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceOrders" class="bg-image d-flex justify-content-center align-items-center"
            style="
                                                                                                    background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>Help Center</h1>
            </div>
        </div>
    </section>
    <main class="p-3 px-5">
        <div class="d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Help Thread</h3>
                                <div>
                                    {{ $thread -> message }}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chat-container">
                                        
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row m-0">
                                    <div class="col-md-9">
                                        <input type="text" id="chat-input" class="form-control" placeholder="Type your message here...">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" id="send-button">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    

    <script>
        function sendMessage() {
            var message = $('#chat-input').val();
            var thread_id = {{ $thread->id }};
            $.ajax({
                url: '{{ route('threads.reply', ['thread' => $thread -> id]) }}',
                type: 'POST',
                data: {
                    message: message,
                    thread_id: thread_id
                },
                success: function(data) {
                    // clear input
                    $('#chat-input').val('');
                    // add message to chat
                    $('.chat-container').append(data.response);

                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function fetchAllMessages(){
            // clear chat box 
            // get data-id attribute of last message 
            var last_data_id = $('.chat-message:last').data('id');
            $.ajax({
                url: '{{ route('threads.fetch', ['thread' => $thread -> id]) }}',
                type: 'GET',
                data: {
                    last_data_id: last_data_id
                },
                success: function(data) {
                    // $('.chat-container').html('');
                    $('.chat-container').append(data.response);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        // send message on enter
        $('#chat-input').keypress(function(e) {
            if (e.which == 13) {
                sendMessage();
            }
        });

        // send message on click
        $('#send-button').click(function() {
            sendMessage();
        });

        fetchAllMessages();
        setInterval(() => {
            fetchAllMessages();
        }, {{ config('appconfig.help_chat_update_interval') }});
    </script>
@endsection
