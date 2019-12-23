@component('mail::message')
    # Introduction
    Hi {{ $user->user_name }}

    @isset($user)
        The user {{ $user->user_name }} has sent you a message,
        his email adress is {{ $user->email }}
    @endisset
    @isset($email)
        The Anonymous User {{ $email }} has sent you a message,
    @endisset
    The subject of the contact is
    {{ $contact->contact_subject }}
    The content of the contact is
    {{ $cntact->contact_content }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
