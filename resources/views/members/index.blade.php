@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="
                                                                                                background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>All Memberss</h1>
                <h3>{{ Auth::user()->get_organization()->name }}</h3>
            </div>
        </div>
    </section>
    <main class="p-3 px-5">
        <div class="links m-1 d-flex align-items-center justify-content-between">
            <div>
                {{ $members->links() }}
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <select name="num_rows" id="num_rows" class="form-control m-1 w-25">
                    <option value="10" @if ($num_rows == 10) selected @endif>10</option>
                    <option value="20" @if ($num_rows == 20) selected @endif>20</option>
                    <option value="50" @if ($num_rows == 50) selected @endif>50</option>
                    <option value="100" @if ($num_rows == 100) selected @endif>100</option>
                    <option value="200" @if ($num_rows == 200) selected @endif>200</option>
                </select>
                <a class="btn btn-success" href="{{ route('members.create') }}">Add New member</a>
            </div>

        </div>
        <table class="table table-striped">
            <tr>

                <th>@sortablelink('user.id')</th>
                <th>@sortablelink('user.name')</th>
                <th>@sortablelink('user.email')</th>
                <th>@sortablelink('user.email_verified_at', 'Verified At')</th>
                <th>@sortablelink('user.phone_number', 'Phone Number')</th>
                <th>@sortablelink('user.address')</th>
                <th>@sortablelink('user.user_state', 'User State')</th>
                <th>@sortablelink('user.area_id', 'Area')</th>
                <th>Role</th>
                <th>Role Action</th>
                <th>Created at</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            @forelse ($members as $member)
                @php 
                    $user = $member -> user;
                    if (!$user){
                        continue;
                    }
                @endphp
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <a href="{{ route('members.show', ['member' => $user->id]) }}">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->user_state -> name }}</td>
                    <td>{{ $user->area -> city -> name }} - {{ $user -> area -> name}} </td>
                    <td>{{ $user -> user_role() -> name }}</td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center flex-column">

                            <form action="{{ route('members.promote', ['member' => $member -> id]) }}" method="post">
                                @csrf
                                <button class="btn btn-success btn-block m-1 p-1" @if($user -> user_role() -> id <= 1) disabled  @endif>Promote</button>
                            </form>
                            <form action="{{ route('members.demote', ['member' => $member -> id]) }}" method="post">
                                @csrf
                                <button class="btn btn-danger btn-m-1 p-1 " @if($user -> user_role() -> id >= 3) disabled  @endif>Demote</button>
                            </form>
                        </div>
                    </td>
                    <td>
                        {{ $user -> created_at }}
                    </td>
                    <td>
                        {{ $user -> updated_at }}
                    </td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Do you really want to delete {{ $user -> name }} member ?')" action="{{ route('members.destroy', ['member' => $user -> id ]) }}" id="delete-form-{{ $user -> id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a onclick="$('#delete-form-{{ $user -> id }}').submit()" class="m-1">

                            
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <a href="{{ route('members.show', ['member' => $user->id]) }}" class="m-1">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                    </td>

                </tr>
            @empty
                <tr>
                    <td>No members Available</td>
                </tr>
            @endforelse
        </table>

    </main>


    <div class="modal fade" id="viewModel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModelTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        td {
            font-size: 0.9em;
        }
    </style>

    <script>
        $("#num_rows").on('change', function(e) {
            value = this.value;

            url = new URL(window.location.href);
            url.searchParams.set('num_rows', value);
            url.searchParams.set('page', 1);
            document.location = url.href;
        });
    </script>
@endsection
