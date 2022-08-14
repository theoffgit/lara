<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delete News') }}
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

        <form method="POST" action="{{ route('news.delete') }}">
            @csrf

            <div class="flex items-center justify-end mt-4">
                News {{ $id }}
            </div>
            <x-input id="id" class="block mt-1 w-full" type="hidden" name="id" :value="old('id', $id)" required />

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Delete') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
</x-app-layout>