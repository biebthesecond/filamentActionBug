<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center shadow bg-teal-500 ring-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-semibold py-2 px-4 rounded transition ring-offset-2 focus:ring-2 flex']) }}>
    {{ $slot }}
</button>
