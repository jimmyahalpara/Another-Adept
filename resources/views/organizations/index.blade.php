@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/background (3).jpg') }}'); background-position: 0% 65%">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(255, 255, 255, 0);">
                <h1 style="color: white; text-shadow: 0px 0px 10px black">Organizations</h1>
            </div>
        </div>
    </section>
    <main class="p-3 px-5 d-flex justify-content-center align-items-center flex-column">
        @if (!$errors->isEmpty())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span><br>
                @endforeach
            </div>
        @endif
        {{-- list all organizations --}}

        <table id="organization-table" class="w-100 table p-2">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($organizations as $organization)
                    <tr>
                        <td>
                            <div class="">
                                <h5>
                                    <a class="link-heading organization-tile" href="{{ route('organizations.details', $organization->id) }}">
                                        {{ $organization->name }}
                                    </a>
                                </h5>
                            </div>
                        </td>
                    </tr>
                @empty
                    <span class="p-1 m-1">No Organization Available</span>
                @endforelse
            </tbody>
        </table>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script>
        $(document).ready(function() {
            $('#organization-table').DataTable({
                "order": [
                    [0, "asc"]
                ]
            });
        });
    </script>
    <style>
        nav, .nav-link {
            font-size: 1em !important;
        }
    </style>
@endsection
