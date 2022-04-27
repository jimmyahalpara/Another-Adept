<main class="p-3 px-5">
    <div class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>All Help Threads</h3>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newThread">Create New</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                        <th>Last Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($threads as $thread)
                                        <tr>
                                            <td>{{ $thread->id }}</td>
                                            <td>{{ Str::of($thread->message)->limit(100) }}</td>
                                            <td>
                                                <a href="{{ route('threads.show', $thread->id) }}"
                                                    class="btn btn-primary">View</a>
                                            </td>
                                            <td>
                                                @if ($thread->thread_replies()->count() > 0)
                                                    {{  $thread -> thread_replies() -> latest() -> first() -> created_at -> diffForHumans() }}
                                                @else
                                                    No Activity
                                                @endif

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
                <form action="{{ route('threads.store') }}" method="post" id="create_new_thread_form">
                    @csrf
                    <div class="form-group">
                        <label for="message_id">Message</label>
                        <textarea placeholder="Please Enter the message" name="message" id="message_id" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#create_new_thread_form').submit()">Submit</button>
            </div>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#create_new_thread_form").validate({
        rules: {
            message: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            message: {
                required: "Please enter a message",
                minlength: "Your message must be at least 10 characters long"
            }
        },
        errorClass: 'text-danger'
    });
</script>