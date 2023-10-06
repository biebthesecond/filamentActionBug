@component('mail::message')
{{ $request->sender->name }} ({{ $request->sender->email }}) heeft je op {{ date_format(date_create($request->start_date),"d-m-Y") }} verzocht documenten te versturen. Vergeet dit verzoek niet!

@component('mail::button', ['url' => route('request.landing-page.open', $requestClass->uuid)])
Bekijk bestanden
@endcomponent

<p class="sub" style="font-weight: 500; text-align: center; margin-bottom: 34px;">Dit verzoek verloopt op {{ date_format(date_create($request->end_date),"d-m-Y") }}.<br>Vanaf de verloopdatum kunnen de bestanden niet meer verzonden worden.</p>

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
