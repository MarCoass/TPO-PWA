@props(['url'])
<tr>
<td class="header">
<a href="http://localhost:8000/images/World_Taekwondo.webp" style="display: inline-block; ">
@if (trim($slot) === 'NeuPoom')
<img src="http://localhost:8000/images/World_Taekwondo.webp" class="logo" alt="logo NeuPoom">
{{-- <img src="localhost:8000/public/images/World_Taekwondo2.png" class="logo" alt="logo NeuPoom"> --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
