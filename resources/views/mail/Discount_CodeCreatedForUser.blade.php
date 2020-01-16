@component('mail::message')
    # Introduction
    Hi {{ $user->pseudo  }}

    Your code is valid until the date {{ $date }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent