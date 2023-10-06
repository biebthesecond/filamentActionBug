<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ url('images/logo-dark.png') }}" class="logo" alt="Safesent Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
