<button {{ $attributes->merge(['type' => 'button', 'class' => 'p-2 border border-gray-300 rounded-sm']) }}>
    {{ $slot }}
</button>
