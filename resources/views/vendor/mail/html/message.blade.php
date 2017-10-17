@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header')
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
@endcomponent
@endslot
@endcomponent
