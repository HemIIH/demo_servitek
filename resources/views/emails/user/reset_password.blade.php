@component('mail::message')
# Passwort zurücksetzen


@component('mail::button', ['url' => url('password/reset', $token)])
Passwort zurücksetzen
@endcomponent

<br>
Ihr Servite Team
@endcomponent