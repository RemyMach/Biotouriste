@component('mail::message')
# Introduction
Hi {{ $password_reset->email  }}

You can click on the button to reset your password


@component('mail::button', ['url' => $url ])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
