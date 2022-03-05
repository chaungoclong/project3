@props(['id', 'value', 'title'])

<div class="custom-control custom-switch">
    <input {{ $attributes->merge([
        'class' => 'custom-control-input',
        'type' => 'checkbox',
        ]) }} 
        id="{{ $id ?? '' }}" type="checkbox"
        value="{{ $value ?? '' }}">
        <label class="custom-control-label" for="{{ $id ?? '' }}">
            {{ $title ?? '' }}
        </label>
    </input>
</div>