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
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3>All Help Threads</h3>
                                <button class="btn btn-success">Create New</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($threads as $thread)
                                        <tr>
                                            <td>{{ $thread->id }}</td>
                                            <td>{{ $thread->message }}</td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                <a href="{{ route('threads.show', $thread->id) }}" class="btn btn-primary">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <div class="modal fade" id="newThread" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModelTitle">New Thread</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="create_new_thread_form">
                        <div class="form-group">
                            <label for="message_id">Message</label>
                            <textarea name="message" id="message_id" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection