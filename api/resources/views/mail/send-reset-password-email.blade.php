<x-mail::message>
# Hello, {{$userName}}

Click in the button to continue the password-reset steps.

<x-mail::button :url="'{{$token}}'">
Reset password
</x-mail::button>

If you didn't ask for this, you can ignore this message.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
