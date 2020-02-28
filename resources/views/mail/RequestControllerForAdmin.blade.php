@component('mail::message')
    # Introduction

    @isset($user)
        The user  {{ $user->user_name }} has sent you a request to become a Controller,
        his email adress is {{ $user->email }}
    @endisset

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
