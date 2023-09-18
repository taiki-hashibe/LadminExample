<div class="mb-3">
    <label for="{{ $name }}">{{ __($label) }}</label>
    <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">{{ old($name) ? old($name) : $value }}</textarea>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
