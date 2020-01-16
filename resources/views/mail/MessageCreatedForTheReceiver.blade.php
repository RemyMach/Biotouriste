@component('mail::message')
    # Introduction
    Hi {{ $receiver->user_name }}
    Your have receive a message from {{ $sender->user_name }} {{ $sender->email }}
    about the announce {{ $announce->announce_name }}

    The subject of the message is:
    {{ $message['message_subject'] }}

    The content is:
    {{ $message['message_content'] }}

    And don't forget have a good day
    <br>
    {{ config('app.name') }}
@endcomponent