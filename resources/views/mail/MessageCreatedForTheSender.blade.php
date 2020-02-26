@component('mail::message')
    # Introduction
    Hi {{ $sender->user_name }}
    Your have send a message to {{ $receiver->user_name }}
    about the announce {{ $announce->announce_name }}

    The content is:
    {{ $message['message_content'] }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
