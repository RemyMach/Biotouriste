@component('mail::message')
    # Introduction
    Hi {{ $sender->user_name }}
    Your have send a message to {{ $receiver->user_name }} {{ $sender->email }}
    about the announce {{ $announce->announce_name }}

    The subject of the message is:
    {{ $message['message_subject'] }}

    The content is:
    {{ $message['message_content'] }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
