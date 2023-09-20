<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="text" name="{{ $name }}" value="{{ old($name, isset($value) ? $value : '') }}">
</div>
