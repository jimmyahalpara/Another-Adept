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
            Your request to create organization with name "{{ $organization -> name }}" has been rejected due to "{{ $reason }}". You can again request organization creation with updated details. If you want to discuss more, then mail us at {{ config('appconfig.help_email') }}.`
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
