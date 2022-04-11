@extends('voyager::master')


@section('content')
    <div style="padding: 5vh; display: flex; justify-content: center; align-items: center; flex-direction: column">
        <form action="{{ route('organizations.active.confirmation.post', ['organization' => $organization->id]) }}"
            method="post" class="d-flex justify-content-center align-items-center">
            @csrf
            <h1>Do You want to activate this organization ?</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="text" placeholder="Enter Reason if you select No below." name="reason"
                style="width: 100%; padding: 2vh">
            <div style="display: flex; justify-content: center; align-items: center; flex-direction: row">
                <button name="submit" type="submit" class="btn btn-success" value="accept">
                    Yes
                </button>
                <button name="submit" type="submit" style="margin-left: 2vw" class="btn btn-danger" value="reject">
                    No
                </button>
            </div>

        </form>
        <iframe style="width: 100%; height: 100vh" src="{{ $document_path }}" frameborder="0"></iframe>
    </div>

@endsection
