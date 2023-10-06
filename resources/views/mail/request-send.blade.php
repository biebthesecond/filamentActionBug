@component('mail::message')
{{ $requestClass->sender->name }} ({{ $requestClass->sender->email }}) verzoekt je documenten te versturen

@component('mail::button', ['url' => route('request.landing-page.open', $requestClass->uuid)])
Bekijk bestanden
@endcomponent

<p class="sub" style="font-weight: 500; text-align: center; margin-bottom: 34px;">Dit verzoek verloopt op {{ date_format(date_create($requestClass->end_date),"d-m-Y") }}.<br>Vanaf de verloopdatum kunnen de bestanden niet meer verzonden worden.</p>

@if ($requestClass->sender->signature)
@if ($requestClass->sender->signature->logo_url)
<img src="{{ $requestClass->sender->signature->logo_url }}"/>
@endif
<p style="line-height: 1.4; margin-top: 10px;" class="sub">
{!! nl2br($requestClass->sender->signature->signature) !!}
</p>
<hr style="margin: 20px 0;" />
@endif

<p class="sub">
Uitleg
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
