@component('mail::message')
Safesent doet er alles aan om uw bestanden veilig te versturen, daarom hebben we de bestanden die gisteren geopend zijn zonet verwijderd van onze server. Veiligheid voorop!

Alle bestanden van bericht "{{$messageClass->subject}}" zijn van onze servers verwijderd

<p class="sub">
Safesent versleutelt jouw bestanden en verstuurt de ontvanger een e-mail met een link, na het openen van de link vraagt de ontvangende partij een code op waarmee hij de bestanden kan ontgrendelen.
</p>

<p class="sub">
Ook gratis beveiligde bestanden versturen?
Ga naar <a href="{{ config('app.url') }}">{{ config('app.url') }}</a> of <a href="">Maak een account aan</a> en verstuur vanaf nu al jouw privacygevoelige bestanden veilig.
</p>

<p class="sub">Safesent is een initiatief van <a href="https://uteq.nl">Uteq</a></p>
@endcomponent

