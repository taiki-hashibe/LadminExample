<div class="mb-3">
    <label for="{{ $name }}">
        @if ($field->isRequired())
            <span class="text-danger">*</span>
        @endif{{ $label }}
    </label>
    <input class="form-control @error($name) is-invalid @enderror" type="{{ isset($type) ? $type : 'text' }}"
        id="{{ $name }}" name="{{ $name }}" value="{{ old($name) ? old($name) : $value }}">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
