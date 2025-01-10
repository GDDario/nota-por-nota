<x-mail::message>
# Hello, {{$userName}}, this is now your email linked to the Nota por Nota app.

This operation has succeeded succesfully today ({{$dateTime}}).
Also, this is just notification email.

<x-mail::panel>
    If it wasn't you, we recommend to call our the support immediately.
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
