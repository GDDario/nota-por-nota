<x-mail::message>
# Hello, {{$userName}}.

We inform that your password has been reset today ({{$dateTime}}).

<x-mail::panel>
    If it wasn't you, we recommend to call our the support immediately.
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>