@component('mail::message')
# InstaLaravel

This is a test app with Laravel framework and you are one of the QAs. Welcome.

And here you can visit our site:
@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
To InstaLaravel
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
