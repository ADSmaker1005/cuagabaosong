<x-app-layout>
    <x-slot name="header">
        {{ __('File manager') }}
    </x-slot>
    <iframe src="/filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
</x-app-layout>
