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
            Hello, {{ $user -> name }}
        </td>
    </tr>
    <tr>
        <td width="100%" height="10"></td>
    </tr>

    <tr>
        <td class="paragraph">
            We have recieved your request to create new organization. We'll verify your documents and let your know the
            results within 7 working days.
            <br>
            Thank You.
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
    @include('beautymail::templates.minty.contentEnd')

@stop
