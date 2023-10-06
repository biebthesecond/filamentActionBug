@component('mail::message')
Je beveiligde bericht van {{ $messageClass->created_at->isoFormat('DD MMMM YYYY') }} om {{ $messageClass->created_at->format('H:i:s') }}
is om {{ now()->format('H:i:s') }} geopend door {{ $messageClass->email_receiver }}.

<p class="sub">
Safesent bewaart jouw bestanden standaard een dag nadat de ontvangende partij deze heeft gedownload.
</p>

<p class="sub">
Safesent versleutelt jouw bestanden en verstuurt de ontvanger een e-mail met een link waarmee de bestanden
kunnen worden geopend, na invoering van het aan de ontvanger gemailde wachtwoord.
</p>

<p class="sub">
Safesent maakt het eenvoudig om gratis en veilig privacygevoelige bestanden te delen.
</p>

<p class="sub">
Ook gratis beveiligde bestanden versturen?
Ga naar <a href="{{ config('app.url') }}">{{ config('app.url') }}</a> en <a href="{{ config('app.url') }}/register">Maak een account aan</a> en verstuur vanaf nu al jouw privacygevoelige bestanden veilig.
</p>


<p class="sub">Safesent is een initiatief van <a href="https://uteq.nl">Uteq</a></p>

@endcomponent

