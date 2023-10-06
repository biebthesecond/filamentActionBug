@component('mail::message')
Je beveiligde bericht is succesvol verzonden naar: {{ implode(', ', $receivers) }}.

@if ($messageClass->sender->setting('acknowledgment_of_receipt_show_subject'))
<p>
Onderwerp: <br />{{ $messageClass->subject }}
</p>
@endif

@if ($messageClass->sender->setting('acknowledgment_of_receipt_show_content'))
<p>
Bericht: <br />{{ $messageClass->content }}
</p>
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

