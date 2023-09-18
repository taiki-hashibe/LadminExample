<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white p-2 bg-red-600 rounded-sm']) }}>
    {{ $slot }}
</button>
