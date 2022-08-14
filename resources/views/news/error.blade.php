<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News List') }}
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
        <ul>
        @foreach ($news as $item)
           <li>
            <a href="/news/read/{{$item->id}}">{{ $item->title }}</a> :: 
            <a href="/news/update/{{$item->id}}">edit</a> :: 
            <a href="/news/delete/{{$item->id}}">delete</a>
           </li>
        @endforeach
        </ul>
    </x-auth-card>
</x-guest-layout>
</x-app-layout>