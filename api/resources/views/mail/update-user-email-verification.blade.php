<x-mail::message>
# Hello, {{$userName}}.

Click in the button to continue the email-update steps (You will be redirected back to the app).

**Attention**: the link will expire in 1 hour.

<x-mail::button :url="'{{$token}}'">
    Update email
</x-mail::button>

<x-mail::panel>
    If you didn't ask for this, you can ignore this message.
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
