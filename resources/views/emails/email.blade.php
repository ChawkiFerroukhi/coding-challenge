@component('mail::message')

<h2>Hello {{$data['name']}},</h2>

<h3> {{$data['message']}} </h3>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
