@component('mail::message')
    # Introduction
    Hi {{ $receiver->user_name }}
    Your have receive a message from {{ $sender->user_name }}
    about the announce {{ $announce->announce_name }}


    The content is:
    {{ $message['message_content'] }}

    And don't forget have a good day
    <br>
    {{ config('app.name') }}
@endcomponent