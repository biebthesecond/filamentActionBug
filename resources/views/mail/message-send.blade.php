@component('mail::message')
Je hebt een beveiligd bericht ontvangen van {{ $messageClass->sender->name }} ({{ $messageClass->sender->email }})

@component('mail::button', ['url' => $messageClass->signedUrl()])
Bekijk bestanden
@endcomponent

@if ($messageClass->sender->signature)
@if ($messageClass->sender->signature->logo_url)
<img src="{{ $messageClass->sender->signature->logo_url }}"/>
@endif
<p style="line-height: 1.4; margin-top: 10px;" class="sub">
{!! nl2br($messageClass->sender->signature->signature) !!}
</p>
<hr style="margin: 20px 0;" />
@endif

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

<p class="sub">

</p>

<p class="sub">Safesent is een initiatief van <a href="https://uteq.nl">Uteq</a></p>

@endcomponent

