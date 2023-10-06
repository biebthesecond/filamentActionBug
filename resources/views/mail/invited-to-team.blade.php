@component('mail::message')
Je bent uitgenodigd voor de administratie van {{ $administrationAdmin->name }} ({{ $administrationAdmin->email }})

<p style="text-align: center">Klik hieronder om een wachtwoord aan te maken</p>

@component('mail::button', ['url' => route('login')])
    Login
@endcomponent


<p class="sub">
Safesent versleutelt jouw bestanden en verstuurt de ontvanger een e-mail met een link, waar de bestanden na het gebruik van het door hem toegewezen code kan openen.
</p>

<p class="sub">
Safesent maakt het eenvoudig om gratis en veilig privacygevoelige bestanden te delen.
</p>

<p class="sub">Safesent is een initiatief van <a href="https://uteq.nl">Uteq</a></p>

@endcomponent

