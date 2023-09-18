<div class="mb-3">
    <label for="{{ $name }}">{{ $label }}</label>
    <input class="form-control @error($name) is-invalid @enderror" type="text" id="{{ $name }}"
        name="{{ $name }}" value="{{ old($name) ? old($name) : $value }}">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
