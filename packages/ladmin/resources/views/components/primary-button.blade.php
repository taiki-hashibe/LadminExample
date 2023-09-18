<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white p-2 bg-blue-400 rounded-sm']) }}>
    {{ $slot }}
</button>
