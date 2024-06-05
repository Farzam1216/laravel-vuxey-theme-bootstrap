<x-mail::message>
    Hi {{ $name }}

    Your Password is {{ $password }}.

    {{-- <x-mail::button :url="''">
        Button Text
    </x-mail::button> --}}

    Thanks
    {{-- , --}}
    {{-- {{ config('app.name') }} --}}
</x-mail::message>
