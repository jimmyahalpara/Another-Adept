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
            Dear, {{ $order -> user -> name }},
        </td>
    </tr>
    <tr>
        <td width="100%" height="10"></td>
    </tr>
    <tr>
        <td class="paragraph">
            Order for service {{ $order -> service -> name }} has been assigned to {{ $order  -> order_member -> user_organization_membership -> user -> name }}
        </td>
    </tr>
    {{-- <tr>
        <td width="100%" height="25"></td>
    </tr> --}}
    <tr>
        <td class="paragraph">
            <table>
                <tr>

                    <th>Order ID</th>
                    <th>Service ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Area</th>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Ordered At</th>
                    <th>Status</th>
                    <th>Comment</th>
                </tr>
                <tr>
                    <td>{{ $order -> id }}</td>
                    <td>{{ $order -> service -> id }}</td>
                    <td>{{ $order -> user -> name }}</td>
                    <td>{{ $order -> user -> email }}</td>
                    <td>{{ $order -> user -> area -> name }}</td>
                    <td>{{ $order -> service -> name }}</td>
                    <td>{{ $order -> service -> price }} / {{ $order -> service -> price_type -> name }}</td>
                    <td>{{ $order -> created_at }}</td>
                    <td>{{ $order -> order_state -> name }}</td>
                    <td>{{ $order -> comment }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr>
        <td>
            @include('beautymail::templates.minty.button', [
                'text' => 'View All Orders',
                'link' => route('home.orders'),
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
        th,td{
            padding: 1vh 1vw;
        }
    </style>
    @include('beautymail::templates.minty.contentEnd')

@stop
