@component('mail::message')
# Konto aktivieren

Willkommen beim Login Bereich!

Aktivieren Sie den Zugang zu ihrem persönlichen Bereich.

Zur Freischaltung Ihres Kontos folgen Sie diesem Link:


@component('mail::button', ['url' => url('/user/activation', $token)])
Konto aktivieren
@endcomponent

Ihr Passwort lautet <strong>{{ $password }}</strong><br>
Bitte ändern Sie es umgehend!

<br>
Ihr Servite Team

@endcomponent