<div class="mb-3">
    <label for="{{ $name }}">{{ $label }}
    </label>
    <input name="{{ $name }}" type="{{ isset($type) ? $type : 'text' }}"
        class="block mt-1 px-2 py-2 w-full border focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm border-gray-300 @error($name) border-red-600 @enderror"
        @if (isset($value)) value="{{ old($name) ? old($name) : $value }}" @endif>
    @error($name)
        <p class="text-sm text-red-600 space-y-1">
            {{ $message }}
        </p>
    @enderror
</div>
