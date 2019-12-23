@component('mail::message')
    # Introduction
    @isset($user)
        Hi {{ $user->user_name }}
    @endisset
    Your subject is
    {{ $contact->contact_subject }}
    The content is
    {{ $cntact->contact_content }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
