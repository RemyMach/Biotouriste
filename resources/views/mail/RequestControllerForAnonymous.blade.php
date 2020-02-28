@component('mail::message')
    # Introduction
    @isset($user)
        Hi {{ $user->user_name }}
    @endisset
    Your request to become a Controller has been register, we will answer after its study

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
