@component('mail::message')
{{ $request->contact->name }} ({{ $request->contact->email }}) Heeft alle documenten ge-upload voor aanvraag: {{ $request->name }}

@component('mail::button', ['url' => route('requests.details', $request->uuid)])
Bekijk bestanden
@endcomponent

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
