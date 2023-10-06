@component('mail::message')
Je beveiligde bericht van {{ $messageClass->created_at->isoFormat('DD MMMM YYYY') }} om {{ $messageClass->created_at->format('H:i:s') }}
is om {{ now()->format('H:i:s') }} volledig gedownload door {{ $messageClass->email_receiver }}.

<p class="sub">
Safesent versleutelt jouw bestanden en verstuurt de ontvanger een e-mail met een link, na het openen van de link vraagt de ontvangende partij een code op waarmee hij de bestanden kan ontgrendelen.
</p>

<p class="sub">
Safesent maakt het eenvoudig om gratis en veilig privacygevoelige bestanden te delen.
</p>

<p class="sub">
Ook gratis beveiligde bestanden versturen?
Ga naar <a href="{{ config('app.url') }}">{{ config('app.url') }}</a> of <a href="">Maak een account aan</a> en verstuur vanaf nu al jouw privacygevoelige bestanden veilig.
</p>

<p class="sub">Safesent is een initiatief van <a href="https://uteq.nl">Uteq</a></p>
@endcomponent

