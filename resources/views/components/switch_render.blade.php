<div class="custom-control custom-switch">
    <input class="custom-control-input {{ $class ?? '' }}" id="{{ $id ?? '' }}" 
        type="checkbox" value="{{ $value ?? '' }}" {{ $status ?? '' }}>
        <label class="custom-control-label" for="{{ $id ?? '' }}">
            {{ $title ?? '' }}
        </label>
    </input>
</div>