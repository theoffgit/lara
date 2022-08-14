<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('One News') }}
        </h2>
    </x-slot>
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <!-- Title -->
            <div>
                <b>
                  {{ $title }}
                </b>
            </div>

            <!-- Text -->
            <div class="mt-4">
                {{ $text }}
            </div>

            <!-- Created -->
            <div class="mt-4">
                {{ $date }}
            </div>
    </x-auth-card>
</x-guest-layout>
</x-app-layout>