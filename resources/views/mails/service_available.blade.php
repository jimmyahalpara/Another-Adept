@extends('beautymail::templates.minty')

@section('heading')
    Service Adept
@endsection

@section('content')

    @include('beautymail::templates.minty.contentStart', [
        'text' => 'Service Adept',
    ])
    <tr>
        <td class="title">
            Hello, {{ $user->name }}
        </td>
    </tr>
    <tr>
        <td width="100%" height="10"></td>
    </tr>
    <tr>
        <td class="paragraph">
            Service {{ $service->name }} which you liked is now available in your area. Order it now.
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr>
        <td>
            @include('beautymail::templates.minty.button', [
                'text' => 'Order Now',
                'link' => route('search.show', ['service' => $service -> id]),
            ])
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr>
        <td class="paragraph">
            <small>
                Regards,<br>
                Service Adept Help Desk.
            </small>
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr>
        <td class="paragraph">
            <small>
                Need Help ? <a href="{{ config('appconfig.help_email') }}"> Mail Us.</a>
            </small>
        </td>
    </tr>
    <style>
        th,
        td {
            padding: 1vh 1vw;

        }

        #table-container-row {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        #table-container-row td,
        #table-container-row th {
            border: 1px solid #ddd;
            padding: 1vh 1vw;
        }

        #detail-table {
            width: 100%;
            border-collapse: collapse;
        }

    </style>
    @include('beautymail::templates.minty.contentEnd')

@stop
