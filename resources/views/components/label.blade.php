@props(['value'])
{{-- {{ dd($attributes) }} --}}
<label {{ $attributes }}>
    {{ $value ?? $slot }}
</label>