<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="text" name="{{ $name }}" value="{{ old($name, $value) }}">
</div>
